<?php

namespace App\Listeners;
use App\Events\DishMail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Dish;
use Mail;
class DishMailFired
{
    public function __construct()
    {
        
    }
    public function handle(DishMail $event)
    {
        $dish = Dish::find($event->dishId)->toArray();  
        Mail::send('mail.dish_email', ['dish'=>$dish], function($message) {
            $message->to(Config('constants.SUPER_ADMIN_EMAIL'));
            $message->subject('Dish Item Less');
        });
    }
}