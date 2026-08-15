<?php

use App\Models\SalesOrder;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

// Saluran publik untuk notifikasi "Pesanan Baru" di frontstore.
Broadcast::channel('orders', function ($user) {
    return true;
});

// Saluran privat untuk update status order realtime (pemilik order & admin).
Broadcast::channel('orders.{trxId}', function ($user, $trxId) {
    $order = SalesOrder::query()->where('trx_id', $trxId)->first();

    if (! $order) {
        return false;
    }

    return (int) $order->user_id === (int) $user->id
        || $user->hasAnyRole(['super_admin', 'panel_user']);
});
