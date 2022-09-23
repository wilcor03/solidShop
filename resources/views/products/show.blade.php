@extends('layouts.main')

@section('main_content')
<section class="py-5 text-center container">
  <div class="row py-lg-5">
    <div class="col-lg-6 col-md-8 mx-auto">
      <h1 class="fw-light text-uppercase">{{ $product->title }}</h1>
      <p class="lead text-muted">{{ $product->description }}</p>
      <!--<p>
        <a href="#" class="btn btn-primary my-2">Main call to action</a>
        <a href="#" class="btn btn-secondary my-2">Secondary action</a>
      </p>-->
    </div>
  </div>
</section>


    <div class="container">
		<div class="row align-items-center">
			<div class="col-sm-6">
				<img class="img-fluid" src="{{asset('images/default_product_img.jpeg')}}">
			</div>
			<div class="col-sm-6">
				<div class="alert alert-dark" role="alert">
				  <strong>Price:</strong> ${{ $product->price }}
				</div>
				<div class="alert alert-dark" role="alert">
				  <strong>Category:</strong> Appliances
				</div>
				<div class="alert alert-dark" role="alert">
				  <strong>Shipping price:</strong> free
				</div>
				<div class="alert alert-dark" role="alert">
				  <strong>available quantity:</strong> 10.000 / Uni
				</div>				

				<div class="row my-5">
					<div class="col-sm-6">
						<form action="{{ route('order.preview', $product) }}">
							<input type="hidden" name="quantity" value="1">
							<button type="submit" class="btn btn-primary btn-lg">COMPRAR</button>
							</form>
					</div>
					<div class="col-sm-6">
						
					</div>
				</div>
			</div>
	</div>

@endsection