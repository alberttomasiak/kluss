<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\User;
use App\Notifications;
use App\Message;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('layouts.app', function($view){
            $channel = User::getUserNotificationsChannel(\Auth::user()->id);
            $notifications = Notifications::getUserUnreadNotifications(\Auth::user()->id);
            $messages = Message::getUserUnreadMessages(\Auth::user()->id);
        $view->with('data', array('channel' => $channel, 'notifications' => $notifications, 'messages' => $messages));
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if($this->app->environment('development')){
            $this->app->register('Barryvdh\Debugbar\ServiceProvider');
        }
    }
}
