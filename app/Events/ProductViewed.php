<?php

namespace App\Events;

use App\Models\Product;
use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ProductViewed implements ShouldBroadcast
{
    use Dispatchable, SerializesModels;

    /**
     * Total klik semua produk
     */
    public $total_clicks;

    /**
     * Create a new event instance.
     */
    public function __construct()
    {
        // 🔥 SUM dari kolom views (SATU-SATUNYA SUMBER DATA)
        $this->total_clicks = Product::sum('views');
    }

    /**
     * Channel broadcast
     */
    public function broadcastOn()
    {
        return new Channel('admin-dashboard');
    }

    /**
     * Event name
     */
    public function broadcastAs()
    {
        return 'product.viewed';
    }

    /**
     * Data yang dikirim ke frontend
     */
    public function broadcastWith()
    {
        return [
            'total_clicks' => $this->total_clicks,
        ];
    }
}
