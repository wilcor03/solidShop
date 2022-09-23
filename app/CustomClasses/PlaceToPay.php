<?php

namespace App\CustomClasses;

use App\Interfaces\PaymentInterface;
use App\Repositories\OrderRepository;

use App\Models\Order;
use \Dnetix;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;

use Exception;


class PlaceToPay implements PaymentInterface{	

	private $placetopay;
	private $orderRepo;

	public function __construct(){
		$this->placetopay = new Dnetix\Redirection\PlacetoPay(config('placetopay'));		
		$this->orderRepo = new OrderRepository;
	}

	public function paymentRedirectUrl():string {		
		$product = request()->route("product");
		$reference = Str::random(10);

		$request = [
        'payment' => [
            'reference' => $reference,
            'description' => $product->title,
            'amount' => [
                'currency' => 'USD',
                'total' => request()->quantity * $product->price,
            ],
        ],
        'expiration' => date('c', strtotime('+2 days')),
        'returnUrl' => route('payment.response').'?reference=' . $reference,
        'ipAddress' => request()->ip(),
        'userAgent' => request()->server('HTTP_USER_AGENT')
    ];      

    
    $response =  $this->placetopay->request($request);

    if ($response->isSuccessful()) {
    	$data = $this->settedData($response, $product, $reference);    	
      $this->orderRepo->_store($data);
     	return $response->processUrl();        
    } else {   
    	throw new Exception(
    		$response->status()->message()
    	);
    }
	}

	private function settedData($response, $product, $reference){
		return [
			'requestId' 			=> $response->requestId(),
			'processUrl'			=> $response->processUrl(),
			'order_details' 	=> Arr::add(Arr::except($product->toArray(), ['created_at', 'updated_at']), 'quantity', request()->quantity),
			'customer_name'		=> request()->customer_name,
			'customer_email'	=> request()->customer_email,
			'customer_mobile'	=> request()->customer_mobile,
			'reference'				=> $reference
		];		
	}


	public function changeOrderStatus(Order $order){
		$response = $this->placetopay->query($order->payment_response['placetopay']['requestId']);		

    if ($response->status()->isApproved()) {
    	return $this->orderRepo->_updateState($order, OrderRepository::STATUS_PAYED);
    }	elseif($response->status()->isRejected()){
    	return $this->orderRepo->_updateState($order, OrderRepository::STATUS_REJECTED);
    }
	}

}