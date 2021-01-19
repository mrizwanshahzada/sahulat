<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DoneTask extends Notification
{
    use Queueable;
    // private $taskId;
    // private $serviceTitle;
    // private $userName;
    private $userImage;
    private $msg;
    // private $btnConditions;
    // private $taskStatus;
    private $title;
    

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($userImage,$msg,$title)
    {  

        $this->userImage = $userImage;
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
            'userImage' => $this->userImage,
            'msg' => $this->msg,
            'title' => $this->title
            
        ];
    }
}
