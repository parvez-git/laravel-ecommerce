<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;

class NewOrderNotification extends Notification
{
    use Queueable;

    public $orderid;
    public $amount;

    public function __construct($order)
    {
        $this->orderid  = $order['order_id'];
        $this->amount   = $order['amount'];
    }

    public function via($notifiable)
    {
        return ['database','broadcast'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'order_id'  => $this->orderid,
            'amount'    => $this->amount,
        ];
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'order_id'  => $this->orderid,
            'amount'    => $this->amount,
        ]);
    }
}
