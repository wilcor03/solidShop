<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use \Dnetix;
use App\Services\PaymentService;
use App\CustomClasses\PlaceToPay;


class PaymentController extends Controller
{
  public function payResponse(Request $request){
    $order = Order::where('reference', $request->reference)->first();
    
    return (new PaymentService)->changeOrderStatus(
      new PlaceToPay(), $order
    );    
  }
}
