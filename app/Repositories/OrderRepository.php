<?php

namespace App\Repositories;

use App\Models\Order;

class OrderRepository{

	const STATUS_CREATE = "CREATED";
	const STATUS_PAYED = "PAYED";
	const STATUS_REJECTED = "REJECTED";

	public function _store(array $info){		
		$data = [
      'payment_response' => [
        'placetopay' => [
          'requestId'   => $info['requestId'], 
          'respondeUrl' => $info['processUrl'],
        ]
      ],
      'order_details'   => $info['order_details'],      
      'customer_name'   => $info['customer_name'],
      'customer_email'  => $info['customer_email'],
      'customer_mobile' => $info['customer_mobile'],
      'reference'       => $info['reference']
    ];

    return Order::create($data);
	}

	public function _updateState(Order $order, $new_state){
		$order->status = $new_state;
		$order->save();
		return $order;
	}
}