<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use \Dnetix;

use Illuminate\Support\Str;

use App\Models\Order;
use App\Models\Product;

use App\Repositories\OrderRepository;

use App\Services\PaymentService;


class OrderController extends Controller
{
    protected $order;

    public function __construct(OrderRepository $orepo){
      $this->order = $orepo;
    }

    public function orderPreview(Product $product){
      return view('orders.preview', compact('product'));
    }

    public function index(){      
      $orders = Order::paginate();
      return view('orders.index', compact('orders'));
    }

    public function show(Order $order){
      return view('orders.status', compact('order'));
    }

    public function store(OrderRequest $r, Product $product){       
      $platform = "App\CustomClasses\PlaceToPay";
      $redirectUrl = (new PaymentService())->redirectUrl(new $platform());      
      //return redirect()->to($redirectUrl);
    }
}
