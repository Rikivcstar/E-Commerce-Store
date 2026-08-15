<?php

namespace App\Events;

use App\Data\SalesOrderData;
use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SalesOrderCreatedEvent implements ShouldBroadcast
{
    use Dispatchable, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(
        public SalesOrderData $sales_order
    ) {}

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new Channel('orders'),
        ];
    }

    public function broadcastAs(): string
    {
        return 'orders';
    }

    /**
     * Get the data to broadcast — disesuaikan dengan toast frontstore.
     *
     * @return array<string, string|int>
     */
    public function broadcastWith(): array
    {
        $items = $this->sales_order->items->toCollection();

        return [
            'customer_name' => $this->sales_order->customer->full_name,
            'product_qty' => $items->sum(fn ($item) => $item->quantity),
            'product' => $items->pluck('name')->implode(', '),
        ];
    }
}
