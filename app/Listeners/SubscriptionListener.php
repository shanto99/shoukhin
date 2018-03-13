<?php

namespace App\Listeners;

use App\Events\Subscription;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Subscribe;
use Illuminate\Support\Facades\Mail;

class SubscriptionListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  Subscription  $event
     * @return void
     */
    public function handle(Subscription $event)
    {
        
        $products = Subscribe::where('product','LIKE','%'.$event->title.'%')->get();
        /*$email = $product->user()->email;*/
        foreach($products as $product){
            $email = $product->user->email;
            Mail::send('subscriptionMail',['id'=>$event->inserted_id],function ($message)use($email){
                $message->from('evilldevill623@gmail.com', 'Admin');
                $message->to($email,'User');
                $message->subject("Subscription Mail");
            });
        }
    
    }
}
