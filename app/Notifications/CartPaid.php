<?php

namespace App\Notifications;

use App\Models\Number;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class CartPaid extends Notification
{
    use Queueable;


    private string $cartId;
    private string $cartAmount;
    private string $paidAmount;
    private float $discountAmount;
    private array $orders;

    /**
     * Create a new notification instance.
     */
    public function __construct($cartId, $cartAmount, $paidAmount, $orders)
    {
        $this->cartId = $cartId;
        $this->cartAmount = $cartAmount;
        $this->paidAmount = $paidAmount;
        $this->orders = $orders;
        $this->discountAmount = $cartAmount - $paidAmount;
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $mail = (new MailMessage)
            ->subject('Your cart paid!')
            ->greeting("Hi " . Auth::user()->name)
            ->line("Your cart with id: " . $this->cartId . " is paid.")
            ->line("Cart amount: " . Number::doReadable($this->cartAmount))
            ->line("Discount amount:" . Number::doReadable($this->discountAmount))
            ->line("Paid amount: " . Number::doReadable($this->paidAmount))
            ->line("your orders:");

        $orders = [];
        foreach ($this->orders as $order) {
            $mail->line("order " . $order->id . ": { ");
            $mail->line("from restaurant: " . $order->restaurant()->first()->name);
            $mail->line("with amount: " . Number::doReadable($order->amount));
            $mail->line("order status: " . $order->order_status);
            $mail->line("payment status: " . $order->payment_status);
            $mail->line("tracking code: " . $order->tracking_code);
            $mail->line("}");
        }

        return $mail->lines($orders);
    }


//    /**
//     * Get the array representation of the notification.
//     *
//     * @return array<string, mixed>
//     */
//    public function toArray(object $notifiable): array
//    {
//        return [
//            //
//        ];
//    }
}
