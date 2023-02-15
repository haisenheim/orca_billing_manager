<?php

namespace App\Providers;

use App\Models\MailboxInboundEmail;
use Illuminate\Support\ServiceProvider;
use BeyondCode\Mailbox\InboundEmail;
use BeyondCode\Mailbox\Facades\Mailbox;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
       /* Mailbox::catchAll(function(InboundEmail $email) {
            // Work with incoming email
           });
           */
          Mailbox::from('clementessomba@gmail.com', function (InboundEmail $email) {
            // Handle the incoming email
            MailboxInboundEmail::create([
                'message_id'=>$email->id(),
                'message'=>$email->text()
            ]);
        });
    }
}
