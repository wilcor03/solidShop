@extends('layouts.main')

@section('main_content')
<section class="py-5 text-center container">
  <div class="row">
    <div class="col-lg-6 col-md-8 mx-auto">
      <h1 class="fw-light text-uppercase">Payment state:</h1>
      <p class="lead text-muted">
      	@switch($order->status)
	      	@case("CREATED")
	      		<p class="alert alert-warning">Pending to pay</p>
	      		<hr>
	      		<a href="{{ $order->payment_response['placetopay']['respondeUrl'] }}" class="btn btn-primary my-2">Go to pay</a>
	      		@break
	      	@case("PAYED")
	      		successful payment!
	      		@break
	      	@default
	      		<p class="alert alert-danger">Rejected payment!</p>
	      		<hr>
	      		<a href="{{ route('product.show', $order->order_details['id']) }}" class="btn btn-primary my-2">Get this product</a>
      	@endswitch
    	</p>
      <!--<p>
        <a href="#" class="btn btn-primary my-2">Main call to action</a>
        <a href="#" class="btn btn-secondary my-2">Secondary action</a>
      </p>-->
    </div>
  </div>
</section>

<div class="container">
	<div class="row justify-content-center">
		<div class="col-sm-8">
			<table class="table">
			  <thead>
			    <tr>
			      <th scope="col">Product</th>
			      <th scope="col">Quantity</th>
			      <th scope="col">Shipping price</th>
			      <th scope="col">Total</th>
			    </tr>
			  </thead>
			  <tbody>
			    <tr>
			      <th scope="row">{{ $order['order_details']['title'] }}</th>
			      <td>{{ $order['order_details']['quantity'] }}</td>
			      <td>0</td>
			      <td><strong>{{ $order['order_details']['quantity'] * $order['order_details']['price'] }}</strong></td>
			    </tr>			    
			  </tbody>
			</table>
		</div>
	</div>	
</div>

@endsection