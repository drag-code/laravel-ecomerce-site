<?php

namespace App\Policies;

use App\Models\Order;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrderPolicy
{
    use HandlesAuthorization;

    public function author(User $user, Order $order) {
        if ($user->id == $order->user_id)
            return true;
        return false;
    }

    public function payment(User $user, Order $order) {
        if ($order->status == 2)
            return false;
        return true;
    }
}
