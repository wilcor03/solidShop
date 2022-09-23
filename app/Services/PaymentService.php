<?php

namespace App\Services;

use App\Interfaces\PaymentInterface;
use App\Models\Order;

class PaymentService {
	public function redirectUrl($paymentPlatform) {
		return $paymentPlatform->paymentRedirectUrl();
	}

	public function changeOrderStatus(PaymentInterface $paymentPlatform, Order $order ){		
		return $paymentPlatform->changeOrderStatus($order);
	}
}