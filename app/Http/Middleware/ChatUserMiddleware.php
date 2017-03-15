<?php

namespace App\Http\Middleware;

use Closure;

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
        //check if current user has access to this chatroom ($request->get('chatroom'), $chatroom)
        //if user has access got the the chat
        //else redirect back

        return $next($request);
    }
}
