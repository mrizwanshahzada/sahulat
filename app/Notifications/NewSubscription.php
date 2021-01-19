<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewSubscription extends Notification
{
    use Queueable;
    private $image;
    private $msg;
    private $title;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($image,$msg,$title)
    {
        $this->image = $image;
        $this->msg = $msg;
        $this->title = $title;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
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
                    ->line('You have subscribed for new service')
                    ->action('My Subscriptions', url('my-subscription'))
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
            'userImage' => $this->image,
            'msg' => $this->msg,
            'title' => $this->title
        ];
    }
}
