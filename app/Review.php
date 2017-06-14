<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Carbon\Carbon;
use App\KlussCategories;
use Mail;
use App\Mail\TaskForApproval;
use App\Mail\TaskApprovalAdmin;

class Review extends Model
{
    //
    protected $fillable = [
        'user_id', 'otheruser_id', 'score', 'message'
    ];

    public $table = "kluss";

    /*public static function getPublished(){
        //return self::where('closed', '=', '0')->get();
        return DB::table('kluss')
            ->join('users', 'kluss.user_id', '=', 'users.id')
            ->select('kluss.*', 'users.account_type')
            ->where([
                ['kluss.closed', '=', 0],
                ['kluss.approved', '=', 1]
            ])
            ->get();
    }

    public static function getSingle($id){
        //return self::where('id', '=', $id)->get();
        return DB::table('kluss')
            ->join('users', 'kluss.user_id', '=', 'users.id')
            ->select('kluss.*', 'users.account_type')
            ->where('kluss.id', '=', $id)
            ->get();
    }

    public static function getUserHistory($user_id){
        $creator = self::where([
            ['date', '>=', Carbon::now()->subMonth()],
            ['user_id', $user_id] ])
            ->count();

        $fixer = self::join('kluss_applicants', 'kluss.id', '=', 'kluss_applicants.kluss_id')
            ->where([
                ['kluss_applicants.user_id', $user_id],
                ['kluss_applicants.updated_at', '>=', Carbon::now()->subMonth()],
                ['kluss_applicants.accepted', '1']
            ])
            ->count();

        $total = $creator + $fixer;
        return $total;
    }

    public static function createTask($title, $description, $image, $price, $address, $date, $latitude, $longitude, $user_id, $category, $time){
        $categoryName = KlussCategories::IDToName($category);
        if($categoryName == "Overige"){
            $userName = User::get($user_id);
            $userEmail = User::getUserMail($user_id);
            // Mail to user
            Mail::to($userEmail)->send(new TaskForApproval($title, $userName));
            // Mail to admin
            Mail::to("admin@kluss.be")->send(new TaskApprovalAdmin($userEmail, $title, $description));
            return self::insert([
                'title' => $title, 'description' => $description, 'kluss_image' => $image, 'price' => $price, 'date' => $date, 'address' => $address, 'approved' => '0', 'latitude' => $latitude, 'longitude' => $longitude, 'user_id' => $user_id, 'kluss_category' => $category, 'time' => $time
            ]);
        }else{
            return self::insert([
                'title' => $title, 'description' => $description, 'kluss_image' => $image, 'price' => $price, 'date' => $date, 'address' => $address, 'latitude' => $latitude, 'longitude' => $longitude, 'user_id' => $user_id, 'kluss_category' => $category, 'time' => $time
            ]);
        }

    }

    public static function getLatestID($userID){
        return self::where([
            ['user_id', $userID]
        ])->orderBy('id', 'desc')->pluck('id')->first();
    }

    public static function getSingleTitle($id){
        return self::where('id', '=', $id)->value('title');
    }

    public static function getUserKluss($id){
        return self::where([
            ['user_id', '=', $id],
            ['approved', '=', '1']
        ])->paginate(6);
    }

    public static function deleteTask($id){
        return self::where('id', $id)->delete();
    }

    public static function getTasksInNeighborhood($lat, $lng){
        return DB::select(DB::raw(" SELECT *, (
		            6371 * acos (
            		cos (radians(". $lat .") )
            		* cos ( radians(kluss.latitude) )
            		* cos ( radians(kluss.longitude) - radians(". $lng .") )
            		+ sin ( radians(". $lat .") )
            		* sin ( radians( kluss.latitude ) )
            		)
               ) AS distance
               FROM kluss
               WHERE approved = 1
               HAVING distance < 2
               ORDER BY distance;"));
    }

    public static function getActiveTaskCount(){
        return self::where('accepted_applicant_id', '=', null)->count();
    }

    public static function getClosedTaskCount(){
        return self::where('closed', '=', '1')->count();
    }

    public static function getOpenTasks(){
        return self::where('accepted_applicant_id', '=', null)->paginate(6);
    }

    public static function getTasksForApproval(){
        return self::where('approved', '=', 0)->paginate(6);
    }

    public static function getClosedTasks(){
        return self::where('closed', '=', '1')->paginate(6);
    }

    public static function acceptUser($taskID, $applicantID){
        return self::where([
            ['id', $taskID]
        ])->update(['accepted_applicant_id' => $applicantID]);
    }

    public static function approveTask($id){
        return self::where('id', $id)->update(['approved' => 1]);
    }
    public static function denyTask($id){
        return self::where('id', $id)->delete();
    }
    public static function getUserMailForTaskID($id){
        return self::join('users', 'kluss.user_id', '=', 'users.id')
            ->select('users.email', 'users.name')
            ->where('kluss.id', $id)
            ->first();
    }*/
}