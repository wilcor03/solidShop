<?php

namespace App\Interfaces;

use App\Models\Order;

interface PaymentInterface{
	public function paymentRedirectUrl(): string;

	public function changeOrderStatus(Order $order);
}