<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Order;
class MyMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
	 public $order;
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     
    public function build()
    {
        
		
		//return $this->view('view.name');
		//return $this->from('sghanbari1990@gmail.com')->subject('email laravel')->view('mail');
    }
	*/
    public function build()
    {
        return $this->from('sghanbari1990@gmail.com')->subject('email laravel')->markdown('mail');
    }
}
