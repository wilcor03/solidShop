@extends('layouts.main')

@section('main_content')
<section class="py-5 text-center container">
  <div class="row py-lg-5">
    <div class="col-lg-6 col-md-8 mx-auto">
      <h1 class="fw-light text-uppercase">Summary of purchase</h1>
      <p class="lead text-muted">You're ready!</p>
      <!--<p>
        <a href="#" class="btn btn-primary my-2">Main call to action</a>
        <a href="#" class="btn btn-secondary my-2">Secondary action</a>
      </p>-->
    </div>
  </div>
</section>

<div class="container">
	<div class="row">
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
			      <th scope="row">{{ $product->title }}</th>
			      <td>{{ request()->quantity }}</td>
			      <td>{{ $product->price }}</td>
			      <td><strong>{{ $product->price }}</strong></td>
			    </tr>			    
			  </tbody>
			</table>
		</div>
		<div class="col-sm-4">
			<h3 class="text-center">Fill the form, please!</h3>			

			@if ($errors->any())
			    <div class="alert alert-danger">
			        <ul>
			            @foreach ($errors->all() as $error)
			                <li>{{ $error }}</li>
			            @endforeach
			        </ul>
			    </div>
			@endif

			<form method="post" action="{{ route('order.store', $product) }}">
				 @csrf
				 <!--<input type="hidden" name="product_id" value="{{ $product->id }}">-->
				 <input type="hidden" name="quantity" value="{{ request()->quantity }}">
				<div class="mb-3">
			    <label for="exampleInputEmail1" class="form-label">Email address</label>
			    <input name="customer_email" maxlength="100" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">   
			  </div>
			  <div class="mb-3">
			    <label for="exampleInputPassword1" class="form-label">Name</label>
			    <input name="customer_name" maxlength="100" type="text" class="form-control" id="exampleInputPassword1">
			  </div>
			  <div class="mb-3">
			    <label for="exampleInputPassword1" class="form-label">Phone</label>
			    <input name="customer_mobile" type="text" class="form-control" id="exampleInputPassword1">
			  </div>
			  
			  <button type="submit" class="btn btn-primary">GO TO PAY</button>
			</form>			
		</div>
	</div>
</div>
@endsection