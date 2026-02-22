<?php

namespace App\Events;

use App\Models\Orders;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class OrderCreated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $order;
    public $total_orders;

    public function __construct($order)
    {
        $this->order = $order;

        // Hitung total order
        $this->total_orders = Orders::count();
    }

    public function broadcastOn()
    {
        return new Channel('admin-dashboard');
    }

    public function broadcastAs()
    {
        return 'order.created';
    }
}
