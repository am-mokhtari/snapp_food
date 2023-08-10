<?php

namespace App\Notifications;

use App\Models\Comment;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class CommentPosted extends Notification
{
    use Queueable;

    private Comment $comment;

    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject("Your comment posted!")
            ->greeting("Hi " . Auth::user()->name)
            ->line('Your comment was registered with the following information:')
            ->line('id: ' . $this->comment->id)
            ->line('for order: ' . $this->comment->order()->first()->id)
            ->line('content: ' . $this->comment->content);
    }
}
