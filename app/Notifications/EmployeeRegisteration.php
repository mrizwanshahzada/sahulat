<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EmployeeRegisteration extends Notification
{
    use Queueable;
    private $_employeeName;
    private $_employeePassword;


    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($name, $password)
    {
        $this->_employeeName = $name;
        $this->_employeePassword = $password;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
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
                    ->greeting('Hi Mr/Mrs '.$this->_employeeName)
                    ->line('Welcome to Sahulat.')
                    ->line('Your password is: '.$this->_employeePassword)
                    ->action('Login Now', url('/login'))
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
            //
        ];
    }
}
