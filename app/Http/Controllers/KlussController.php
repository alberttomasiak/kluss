<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use App\Kluss;
use App\User;
use App\Kluss_applicant;
use App\KlussCategories;
use App\Notifications;
use App\KlussFinished;
use App\KlussPay;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;

class KlussController extends Controller
{
    var $pusher;
    var $user;

    public function __construct(){
        $this->pusher = App::make('pusher');
        $this->middleware('auth');
    }

    public function index(){
        $task_history = Kluss::getUserHistory(\Auth::user()->id);
        $kluss_categories = KlussCategories::getCategories();
        $account_type = User::checkAccountType(\Auth::user()->id);
        return view('kluss/add', compact('kluss_categories', 'account_type', 'task_history'))->with('title', 'Voeg een Kluss toe');
    }

    public function add(Request $request){
        $this->validate($request, [
            'title' => 'required',
            'price' => 'integer',
            'address' => 'required',
            'kluss_image' => 'image',
        ]);

        $title = $request->title;
        $description = $request->description;
        $kluss_image = $request->kluss_image;
        $price = $request->price;
        if($price == null){
            $price = 0;
        }
        $date = Carbon::now()->toDateTimeString();
        $latitude = $request->latitude;
        $longitude = $request->longitude;
        $user_id = \Auth::user()->id;
        $address = $request->address;
        $time = $request->kluss_time;
        $category = $request->kluss_category;
        $categoryName = KlussCategories::IDToName($category);

        if(Input::hasFile('kluss_image')){
            $file = Input::file('kluss_image');
            $extension = Input::file('kluss_image')->getClientOriginalExtension();
            $fileName = "kluss-". \Auth::user()->id . time() . "." . $extension;
            $destinationPath = "/img/klussjes/". $fileName;
            $file->move('assets/img/klussjes', $fileName);
            if($description == ""){
                $description = "Geen beschrijving beschikbaar.";
            }
            $task = Kluss::createTask($title, $description, $destinationPath, $price, $address, $date, $latitude, $longitude, $user_id, $category, $time);
            $id = Kluss::getLatestID($user_id);
            if($categoryName != "Overige"){
                $kluss = [
                    'id' => $id,
                    'title' => $title,
                    'description' => $description,
                    'kluss_image' => $destinationPath,
                    'price' => $price,
                    'address' => $address,
                    'date' => $date,
                    'latitude' => $latitude,
                    'longitude' => $longitude,
                    'user_id' => $user_id
                ];
                $this->pusher->trigger("kluss-map", "new-task", $kluss);
            }
            if($task){
                return redirect('/home');
            }
        }else{
            if($description == ""){
                $description = "Geen beschrijving beschikbaar.";
            }
            $image = "/img/klussjes/geen-image.png";
            $task = Kluss::createTask($title, $description, $image, $price, $address, $date, $latitude, $longitude, $user_id, $category, $time);
            $id = Kluss::getLatestID($user_id);
            if($categoryName != "Overige"){
                $kluss = [
                    'id' => $id,
                    'title' => $title,
                    'description' => $description,
                    'kluss_image' => "/img/klussjes/geen-image.png",
                    'price' => $price,
                    'address' => $address,
                    'date' => $date,
                    'latitude' => $latitude,
                    'longitude' => $longitude,
                    'user_id' => $user_id
                ];
                $this->pusher->trigger("kluss-map", "new-task", $kluss);
            }
            if($task){
                return redirect('/home');
            }
        }
    }

    public function SingleKluss($id){
        $kluss = Kluss::getSingle($id);
        $kluss_applicant = Kluss_applicant::getApplicant($id);
        $kluss_applicants = Kluss_applicant::getAllApplicants($id);
        $accepted_applicant = Kluss_applicant::getAcceptedApplicant($id);
        $paid = KlussPay::getPaidStatus($id);
        return view('kluss.individual', compact('kluss', 'kluss_applicant', 'kluss_applicants', 'accepted_applicant', 'paid'))->with('title', $kluss[0]->title);
    }

    public function acceptUser(Request $request){
        // 1. Gather user information
        $taskID = $request->kluss_id;
        $acceptedID = $request->user_id;
        // 2. Set his status to accepted in kluss_applicants
        $acceptUser = Kluss_applicant::acceptApplicant($taskID, $acceptedID);
        // 3. Delete all other applicants
        $deleteApplicants = Kluss_applicant::deleteNotAcceptedApplicants($taskID);
        // 4. Set the task to accepted in the kluss table
        $applicantTableID = Kluss_applicant::getApplicantTableID($taskID, $acceptedID);
        $taskStatus = Kluss::acceptUser($taskID, $acceptedID);
        // 5. Remove the apply btn on the task
        $accepted_applicant = Kluss_applicant::getAcceptedApplicant($taskID);
        $userImage = $accepted_applicant->profile_pic;
        $userID = $accepted_applicant->id;
        $userName = $accepted_applicant->name;
        // 6. Send the update to our map --> pusher.js implementation
        $selected = [
            'taskID' => $taskID,
            'userName' => $userName,
            'userID' => $userID,
            'userImage' => $userImage
        ];
        $this->pusher->trigger("kluss-map", "applicant-selected-task", $selected);
        // 7. make a notification, send it to the right user + redirect back

        // about ==> denier, for ==> accepted, message = Uw applicatie voor klusje X werd goedgekeurd!, url = /kluss/ID, channel = accepted
        $taskTitle = Kluss::getSingleTitle($taskID);
        $about_user = \Auth::user()->id;
        $for_user = $acceptedID;
        $message = "Uw applicatie voor klusje '".$taskTitle."' werd goedgekeurd!";
        $url = "/kluss/".$taskID;
        $channel = User::getUserNotificationsChannel($acceptedID);
        $type = "task";

        // push notification + save in database
        $this->pusher->trigger($channel, "new-notification", $message);
        $notification = Notifications::createNotification($about_user, $for_user, $message, $url, $channel, $type, $taskID);


        return redirect()->back();
    }

    public function refuseUser(Request $request){
        $taskID = $request->kluss_id;
        $refusedID = $request->user_id;
        $removeApplier = Kluss_applicant::removeApplicant($taskID, $refusedID);

        $taskTitle = Kluss::getSingleTitle($taskID);

        // about ==> denier, for ==> refused, message = Uw applicatie voor klusje X werd geweigerd, url = /kluss/ID, channel = refused
        $about_user = \Auth::user()->id;
        $for_user = $refusedID;
        $message = "Uw applicatie voor klusje '".$taskTitle."' werd geweigerd.";
        $url = "/kluss/".$taskID;
        $channel = User::getUserNotificationsChannel($refusedID);
        $type = "task";
        // push notification + save in database
        $this->pusher->trigger($channel, "new-notification", $message);
        $notification = Notifications::createNotification($about_user, $for_user, $message, $url, $channel, $type, $taskID);

        if($removeApplier == true){
            return redirect()->back();
        }
    }

    public function apply($id){
        $kluss = Kluss::getSingle($id);
        $title = Kluss::getSingleTitle($id);
        $kluss_applicant = Kluss_applicant::getApplicant($id);

        // Notification
        $userID = $kluss[0]->user_id;
        $channel = User::getUserNotificationsChannel($userID);
        $type = "task";

        $applicant = User::getTargetInfo(\Auth::user()->id);
        $applicantName = $applicant[0]->name;
        $applicantID = $applicant[0]->id;

        if($kluss_applicant->first()){
            Kluss_applicant::removeApplication($id);
            $data = $applicantName . " verwijderde net zijn sollicitatie.";
        }else{
            Kluss_applicant::insertApplicant($id);
            $data = $applicantName . " sollicteerde net voor uw klusje!";
        }

        // We are the maker of this task so let's get a notification that someone applied to it!
        $this->pusher->trigger($channel, "new-notification", $data);
        // let's also store the notification in our Database so the user can review it, in case he's not online ;)
        // The fields we need are: user_id, message, url and channel. We'll make the date in our model
        $notification = Notifications::createNotification($applicantID, $userID, $data, "/kluss/".$id, $channel, $type, $id);

        return redirect()->back()->with('title', $title, compact('kluss','kluss_applicant'));
        //return redirect('/kluss/'.$kluss->id);
        //return redirect()->back(compact('kluss','kluss_applicant'))->with('title', $title);
    }

    public function update($id){
        $kluss = Kluss::getSingle($id);
        return view('kluss/bewerken', compact('kluss'))->with('title', 'Kluss bewerken');
    }

    public function edit(Request $request, $id){
        $title = $request->title;
        $description = $request->description;
        $price = $request->price;
        $latitude = $request->latitude;
        $longitude = $request->longitude;
        $user_id = \Auth::user()->id;
        $address = $request->address;

        if($description == ""){
            $description = "Geen beschrijving beschikbaar.";
        }

        $query = DB::table('kluss')->where('id', '=', $id)->update(
            ['title' => $title,
            'description' => $description,
            'price' => $price,
            'latitude' => $latitude,
            'longitude' => $longitude,
            'address' => $address]
        );

        if(Input::hasFile('kluss_image')){
        $file = Input::file('kluss_image');
        if(substr($file->getMimeType(), 0, 5) == 'image'){
            $extension = Input::file('kluss_image')->getClientOriginalExtension();
            $fileName = "kluss-". \Auth::user()->id . time() . "." . $extension;

            $destinationPath = "/img/klussjes/". $fileName;
            $file->move('img/klussjes', $fileName);

            $queryImage = DB::table('kluss')->where('id', '=', $id)->update([
                'kluss_image' => $destinationPath
            ]);

            }
        }
        return redirect()->back();
    }

    public function calculateUserDistance(Request $request){
        $userlat = $request->get('userlat');
        $userlng = $request->get('userlng');
        $tasklat = $request->get('tasklat');
        $tasklng = $request->get('tasklng');
        $userID = $request->get('userID');
        $account_type = User::checkAccountType($userID);

        $theta = $userlng - $tasklng;
        $dist = sin(deg2rad($userlat)) * sin(deg2rad($tasklat)) +  cos(deg2rad($userlat)) * cos(deg2rad($tasklat)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;
        $distance = $miles * 1.609344; // to km conversion
        return response()->json([
            'distance' => $distance,
            'account_type' => $account_type
        ]);
    }

    public function delete($id){
        $delete = Kluss::deleteTask($id);
        $deleted = [
            'taskID' => $id
        ];
        $this->pusher->trigger("kluss-map", "deleted-task", $deleted);
        return redirect('/home');
    }

    // finishing / closing tasks
    public function markFinished($task_id, $user_id){
        $mark = KlussFinished::markAsFinished($user_id, $task_id);
        $marks = KlussFinished::getTaskMarks($task_id);

        $task = Kluss::getSingle($task_id);
        $maker = $task[0]->user_id;
        $fixer = $task[0]->accepted_applicant_id;

        // Data both users for notifications
        // Requirements for a Notification --> $about_user, $for_user, $message, $url, $channel, $type, $kluss_id
        $type = "global";
        $urlMakeMark = "/kluss/".$task_id;
        $urlReview = "/review/".$task_id;
        $klussID = $task_id;
        // Data maker
        $nameMaker = User::get($maker);
        $channelMaker = User::getUserNotificationsChannel($maker);
        // Data fixer
        $nameFixer = User::get($fixer);
        $channelFixer = User::getUserNotificationsChannel($fixer);

        if($marks == 2){
            if($user_id == $maker){
                // notify fixer that the task is closed + /meldingen to both users that the task has been closed correctly.
                $messageForFixer = $nameMaker." heeft het klusje '". $task[0]->title. "' zojuist afgesloten. Je kan hem/haar nu een review geven door naar de meldingen pagina te gaan of door naar de pagina van het klusje te gaan.";
                $this->pusher->trigger($channelFixer, "new-notification", $messageForFixer);
            }else{
                // notify user ...
                $messageForMaker = $nameFixer." heeft het klusje '". $task[0]->title. "' zojuist afgesloten. Je kan hem/haar nu een review geven door naar de meldingen pagina te gaan of door naar de pagina van het klusje te gaan.";
                $this->pusher->trigger($channelMaker, "new-notification", $messageForMaker);
            }
            $messageNotifications = $task[0]->title . " werd door beide gebruikers gemarkeerd als afgesloten. Jullie kunnen elkaar nu reviews geven.";
            $notificationMaker = Notifications::createNotification($maker, $fixer, $messageNotifications, $urlReview, $channelFixer, $type, $klussID);
            $notificationFixer = Notifications::createNotification($fixer, $maker, $messageNotifications, $urlReview, $channelMaker, $type, $klussID);
            $close = Kluss::closeTask($task_id);
            return redirect('/review/'.$task_id);
        }else{
            if($user_id == $maker){
                // notify fixer that the other person marked the task as finished
                $messageForFixer = $nameMaker." heeft het klusje '". $task[0]->title. "' zojuist gemarkeerd als afgesloten. Voordat deze definitief afgesloten kan worden, moet jij deze ook markeren. Je kan dit doen door naar de pagina van het klusje of naar de meldingen pagina te gaan.";
                $this->pusher->trigger($channelFixer, "new-notification", $messageForFixer);
                $notificationMaker = Notifications::createNotification($maker, $fixer, $messageForFixer, $urlMakeMark, $channelFixer, $type, $klussID);
            }else{
                // notify user
                $messageForMaker = $nameFixer." heeft het klusje '". $task[0]->title. "' zojuist gemarkeerd als afgesloten. Voordat deze definitief afgesloten kan worden, moet jij deze ook markeren. Je kan dit doen door naar de pagina van het klusje of naar de meldingen pagina te gaan.";
                $this->pusher->trigger($channelMaker, "new-notification", $messageForMaker);
                $notificationFixer = Notifications::createNotification($fixer, $maker, $messageForMaker, $urlMakeMark, $channelMaker, $type, $klussID);
            }
            return redirect()->back()->with('thanksfam', 'Het werd geregistreerd. Voor dat het definitief afgesloten wordt moet de andere persoon deze ook afvinken. Er werd een melding verstuurd om de persoon te herinneren.');
        }
    }

    public function paypalPage($id){
        $accepted_applicant = Kluss_applicant::getAcceptedApplicant($id);
        $task = Kluss::getSingle($id);
        $paid = KlussPay::getPaidStatus($id);
        return view('kluss.paypal', compact('task', 'accepted_applicant', 'paid'));
    }

    public function processPayment($id){
        $pay = KlussPay::addPayment($id);
        return redirect()->back();
    }

    public function blockKluss(Request $request, $id){
        $user = $request->blocker_id;
        $block = KlussBlocks::addBlock($id, $user);
    }
    public function filterTasks(Request $request){
        preg_match_all('!\d+!', $request->prijs, $prijs);
        $tijd = $request->tijd;
        $locatie = $request->locatie;
        $lat = $request->lat;
        $lng = $request->lng;
        $account_type = User::where('id', \Auth::user()->id)->pluck('account_type');
        $klussjes = Kluss::getPublished();
        $cards = Kluss::paginatePublished();

        if($account_type[0] == "normal"){
            $maxD = 2;
        }else{
            $maxD = 5;
        }

        $query = Kluss::join('users', 'kluss.user_id', '=', 'users.id')
            ->select('kluss.*', 'users.account_type')
            ->where([
                ['kluss.closed', '=', 0],
                ['kluss.approved', '=', 1],
                ['kluss.blocked', '=', 0]
            ]);

        if($request->has('prijs')){
            $query->where('price', '>=', $prijs);
        }
        if($tijd != "null"){
            $query->where('time', 'LIKE', $tijd);
        }
        if($request->has('lat')){
            $query->whereRaw('(6371 * acos(cos(radians('. $lat .')) * cos(radians(latitude)) * cos(radians(longitude) - radians(' . $lng . ')) + sin(radians('. $lat .')) * sin(radians(latitude)))) <= '.$maxD.'');
        }

        return view("home", ['filtered' => $query->paginate(12), 'klussjes' => $klussjes, 'cards' => $cards]);
    }
}
