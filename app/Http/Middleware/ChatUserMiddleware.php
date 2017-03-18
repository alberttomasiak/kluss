<?php

namespace App\Http\Middleware;

use Closure;
use App\Conversation;
use Illuminate\Support\Facades\Auth;

class ChatUserMiddleware
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
        $channel = $request->chatname;
        $match = Conversation::matchConversationName($channel);
        $current_user = Auth::user()->id;
        //dd($match["user_one"] . " " . $match["user_two"]. " ". $current_user);
        $allowed_users = [$match["user_one"], $match["user_two"]];
        return in_array($current_user, $allowed_users) ? $next($request) : redirect()->back();
        //return $next($request);
    }
}
