<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class CartCreated extends Notification
{
    use Queueable;

    private string $cartId;

    public function __construct($cartId)
    {
        $this->cartId = $cartId;
    }


    public function via(object $notifiable): array
    {
        return ['mail'];
    }


    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->greeting("Hi " . Auth::user()->name . ".")
            ->subject("New Cart Created!")
            ->line('New Cart created for you!')
            ->line("it's Id is " . $this->cartId);
    }

}
