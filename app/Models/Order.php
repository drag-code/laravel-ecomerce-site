<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    const PENDING = 1;
    const PAYED = 2;
    const ON_ROUTE = 3;
    const DELIVERED = 4;
    const CANCELED = 5;

    protected $guarded = ['created_at, updated_at', 'id', 'status'];

    public function department() {
        return $this->belongsTo(Department::class);
    }

    public function city() {
        return $this->belongsTo(City::class);
    }

    public function district() {
        return $this->belongsTo(District::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
