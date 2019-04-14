<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RegEmailClass extends Mailable
{
    use Queueable, SerializesModels;
        private $mtype;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mtype,$mname)
    {   
        //all mtype are:userReg,missReg,ptmissReg,massageReg,moreReg
        $this->mtype=$mtype;
        $this->mname=$mname;
        $this->subject('99 meimei.com');
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {   
        return $this->markdown('email.user.'.$this->mtype)->with('mname',$this->mname);
    }
}
