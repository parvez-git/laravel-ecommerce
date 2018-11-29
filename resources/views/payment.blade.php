@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-8">

            <div class="card mb-4 rounded-0">
                <div class="card-body">
                    <h4 class="card-title mb-0">Payment Process</h4>
                </div>
            </div>

			<div class="row">
				<div class="col-md-4">
					<div class="card bg-light mb-3 rounded-0">
					  	<div class="card-header">Cash on Delivery</div>
					  	<div class="card-body">
					    	<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>

					    	<form action="{{ route('order.store') }}" method="post">
					    		@csrf
					    		<input type="hidden" name="payment_type" value="cash-on-delivery">
					    		<input type="hidden" name="payment_status" value="0">
								<button type="submit" class="btn btn-sm btn-primary rounded-0">Pay for Order</button>
					    	</form>

					  	</div>
					</div>
				</div>				
				<div class="col-md-4">
					<div class="card bg-light mb-3 rounded-0">
					  	<div class="card-header">PayPal</div>
					  	<div class="card-body">
					    	<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
							<a href="#" class="btn btn-sm btn-primary rounded-0">Pay Order</a>
					  	</div>
					</div>
				</div>				
				<div class="col-md-4">
					<div class="card bg-light mb-3 rounded-0">
					  	<div class="card-header">Bank Transfar</div>
					  	<div class="card-body">
					    	<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
							<a href="#" class="btn btn-sm btn-primary rounded-0">Pay Order</a>
					  	</div>
					</div>
				</div>
	        </div>

        </div>

        <div class="col-md-4">
            <ul class="list-group mb-3">
                <li class="list-group-item d-flex justify-content-between bg-light rounded-0">
                    <h4 class="mb-0">Checkout Details</h4>
                </li>

                @foreach(Cart::content() as $product)
                <li class="list-group-item d-flex justify-content-between">
                    <div>
                        <h5 class="my-0">{{ $product->name }}</h5>
                        <small class="text-muted">Price: ${{ $product->price }} and Items: {{ $product->qty }}</small>
                    </div>
                    <span class="text-muted">${{ $product->subtotal }}</span>
                </li>
                @endforeach
                
                <li class="list-group-item d-flex justify-content-between">
                    <span>Tax (USD):</span>
                    <span>${{ Cart::tax() }}</span>
                </li>                
                <li class="list-group-item d-flex justify-content-between rounded-0">
                    <span><strong>Total (USD):</strong></span>
                    <strong>${{ Cart::total() }}</strong>
                </li>
            </ul>
        </div>

    </div>
</div>
@endsection