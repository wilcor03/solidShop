@extends('layouts.main')

@section('main_content')
<section class="py-5 text-center container">
  <div class="row">
    <div class="col-lg-6 col-md-8 mx-auto">
      <h1 class="fw-light text-uppercase">Your order list:</h1>      
      <!--<p>
        <a href="#" class="btn btn-primary my-2">Main call to action</a>
        <a href="#" class="btn btn-secondary my-2">Secondary action</a>
      </p>-->
    </div>
  </div>
</section>

@if($orders)
<div class="container">
	<div class="row justify-content-center">
		<div class="col-sm-8">
			<table class="table">
			  <thead>
			    <tr>
			      <th scope="col">ID</th>
			      <th scope="col">State</th>
			      <th scope="col">Details</th>
			      <th scope="col">Created</th>
			      <th scope="col">Total</th>
			      <th></th>
			    </tr>
			  </thead>
			  <tbody>
			  	@foreach($orders as $order)
			    <tr>
			      <th scope="row">{{ $order->id }}</th>
			      <td>
			      	@switch($order->status)
			      		@case("CREATED")
			      		<p>Pending to pay</p>
			      			@break

			      		@case("PAYED")
			      		<p>Payed</p>
			      			@break

			      		@case("REJECTED")
			      		<p>Rejected</p>
			      			@break
			      	@endswitch
			      </td>
			      <td>
			      	{{ $order['order_details']['quantity'] }} -
			      	{{ $order['order_details']['title'] }}
			      </td>
			      <td>{{ $order->created_at->format('Y-m-d') }}</td>
			      <td><strong>{{ $order['order_details']['quantity'] * $order['order_details']['price'] }}</strong></td>	
			      <td>			      	
			      	<a href="{{ route('order.show', $order) }}">details</a>
			      	@if($order->status == "CREATED")			      	
			      	| <a class="btn btn-sm btn-danger" href="{{ $order->payment_response['placetopay']['respondeUrl'] }}">go to pay</a>
			      	@endif
			      	@if($order->status == "REJECTED")			      	
			      	| <a class="btn btn-sm btn-info" href="{{ route('product.show', $order['order_details']['id']) }}">retry</a>
			      	@endif
			      </td>		      
			    </tr>			    
			    @endforeach
			  </tbody>
			</table>			
		</div>
		{{ $orders->links() }}
	</div>	
</div>
@endif
@endsection	