<?php

namespace App\Http\Middleware;

use Closure;
use App\Kluss;

class TaskReviewPermissionMiddleware
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
        // check if the current user has permission to give a review about a user for a specific task
        $task_id = $request->task_id;
        $task = Kluss::getSingle($task_id);
        $current_user = \Auth::user()->id;
        $allowed_users = [$task[0]->user_id, $task[0]->accepted_applicant_id];
        return in_array($current_user, $allowed_users) ? $next($request) : redirect()->back();
    }
}
