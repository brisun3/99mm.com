<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailClass extends Mailable
{
    use Queueable, SerializesModels;
    public $content;
    public $ename;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($content,$ename)
    {
        $this->content=$content;
        $this->ename=$ename;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('email.'.$this->content)
                    ->with('ename', $this->ename);
    }
}
