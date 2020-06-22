<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class mynotificatio extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
      //  return ['mail'];
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->error()
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->subject('this is a notification from laravel app.saeed ghanbari')
                    ->line('Thank you for using our application!');

        
      //  return (new MailMessage)->view('mail');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        // this method use to store notification to database
        // we can also use toDatabase instead of toArrray function
        
        return [
            "amount" =>"125",
            "mah" =>"farvardin",
        ];
    }
    public funtion failed(Exeption $ex)
    {
        //action if fail jobs
    }
}
