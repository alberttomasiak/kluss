<?php

namespace App\Http\Middleware;

use Closure;
use App\Kluss;

class TaskCheckerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $task = Kluss::getSingle($request->id);
        if($task->count() == 0){
            return redirect('/home');
        }
        $user = \Auth::user()->id;
        $maker = $task[0]->user_id;
        $fixer = $task[0]->accepted_applicant_id;
        $closed = $task[0]->closed;
        $blocked = $task[0]->blocked;

        if($blocked == 1){
            return redirect('/home');
        }else{
            $allowed_users = [$task[0]->user_id, $task[0]->accepted_applicant_id];
            if($closed == 1){
                return in_array($user, $allowed_users) ? $next($request) : redirect('/home');
            }else{
                return $next($request);
            }
        }
    }
}
