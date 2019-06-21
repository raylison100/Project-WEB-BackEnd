<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class SignupActivate extends Notification implements ShouldQueue
{
    use Queueable;

    protected $entity;
    /**
     * Create a new notification instance.
     *
     * @param $entity
     */
    public function __construct($entity)
    {
        $this->entity = $entity;
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
//        $url = url('/api/betterworld/activate/'.$notifiable->activation_token);
        $url = url('http://localhost:4200/register/confirm/'.$notifiable->activation_token);
        return (new MailMessage)
            ->subject('Confirm your account')
            ->line('Thanks for signup! Please before you begin, you must confirm your account.')
            ->action('Confirm Account', url($url))
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
