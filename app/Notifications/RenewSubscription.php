<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RenewSubscription extends Notification
{
    use Queueable;
    private $image;
    private $msg;
    private $title;
    private $subscription_id;


    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($image,$msg,$title,$subscription_id)
    {
        $this->image = $image;
        $this->msg = $msg;
        $this->title = $title;
        $this->subscription_id = $subscription_id;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'mail'];
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
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'image' => $this->image,
            'msg' => $this->msg,
            'title' => $this->title,
            'subscription_id' => $this->subscription_id
        ];
    }
}
