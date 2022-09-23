<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Repositories\OrderRepository;

class Order extends Model
{
    use HasFactory;

    protected $casts = [
      'order_details'     => 'array',
      'payment_response'  => 'array'
    ];

    protected $fillable = ['customer_name', 'customer_email', 'customer_mobile', 'status', 'order_details', 'payment_response', 'reference'];

    protected $attributes = [
      'status' => OrderRepository::STATUS_CREATE
    ];
}
