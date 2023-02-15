<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class HelloEmail extends Mailable
{
    use Queueable, SerializesModels;
    //protected $_body;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
        //$this->_body = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('alliages.technologies@gmail.com')->view('emails.contact');
    }
}
