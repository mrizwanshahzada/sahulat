<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Service;

class UpdateTask extends Notification
{
    use Queueable;

    private $userImage;
    private $msg;
    private $title;
    private $task_id;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
      public function __construct($userImage,$msg,$title,$task_id)
    {  

        $this->userImage = $userImage;
        $this->msg = $msg;
        $this->title = $title;
        $this->task_id = $task_id;
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
            'title' => $this->title,
            'task_id' => $this->task_id
        ];
    }
}
