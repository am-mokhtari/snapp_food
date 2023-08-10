<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class UserInfoUpdated extends Notification
{
    use Queueable;

    private array $changes;

    public function __construct(array $changes)
    {
        $this->changes = $changes;
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $changeNames = Arr::pull($this->changes, 0);
        if (isset($this->changes[1])) {
            foreach ($this->changes as $changeName) {
                $otherNames = " & " . $changeName;
            }
            $changeNames = $changeNames . $otherNames;
        }

        return (new MailMessage)
            ->subject("Your info was changed!")
            ->greeting("Dear " . Auth::user()->name)
            ->line('Your ' . $changeNames . " was changed.")
            ->line("If these changes are not applied by you, contact support.");
    }
}
