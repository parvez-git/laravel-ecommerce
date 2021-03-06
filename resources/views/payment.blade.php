@extends("layouts.app")

@section("content")
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
					    	<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card"s content.</p>

					    	<form action="{{ route("order.store") }}" method="post">
					    		@csrf
					    		<input type="hidden" name="payment_type" value="cash-on-delivery">
								<button type="submit" class="btn btn-primary w-100 rounded-0">Pay for Order</button>
							</form>
							
							@if(session()->has('cashpaymenterror'))
								<div class="row">
									<div class="col-md-12">
										<div class="alert-danger alert mt-3 rounded-0">
											{{ session('cashpaymenterror') }}
										</div>
									</div>
								</div>
							@endif

					  	</div>
					</div>
				</div>				
				<div class="col-md-8">
					<div class="card bg-light mb-3 rounded-0">
					  	<div class="card-header">Stripe</div>
					  	<div class="card-body">
						  <form class="form-horizontal-" action="{{ route('payment.stripe') }}" method="POST" id="payment-form" role="form" >
								@csrf

								<div class="form-group">
									<label for="CardNumber"><strong>CARD NUMBER <span class="text-danger">*</span></strong></label>
									<input type="text" name="card_no" class="form-control rounded-0" id="CardNumber" size="20" placeholder="Card Number">
								</div>
								<div class="row">
									<div class="col-md-8 col-12">
										<div class="form-group">
											<label for="ExpirationDate"><strong>EXPIRATION DATE <span class="text-danger">*</span></strong></label>
											<div class="row">
												<div class="col-md-6 pr-1">
													<input type="text" name="ccExpiryMonth" class="form-control rounded-0" id="ExpirationDate" size="2" placeholder="MM">
												</div>
												<div class="col-md-6 pl-1">
													<input type="text" name="ccExpiryYear" class="form-control rounded-0" id="ExpirationYear" size="4" placeholder="YYYY">
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-4 col-12">
										<div class="form-group">
											<label for="CvcCode"><strong>CVC CODE <span class="text-danger">*</span></strong></label>
											<input type="text" name="cvvNumber" class="form-control rounded-0" id="CvcCode" size="4" placeholder="CVC">
										</div>
									</div>
								</div>
								<button class="btn btn-primary w-100 rounded-0" type="submit">Pay <strong>${{Cart::total()}}</strong> with Stripe</button>

								@if(session()->has('paymenterror'))
									<div class="row">
										<div class="col-md-12">
											<div class="alert-danger alert mt-3 rounded-0">
												{{ session('paymenterror') }}
											</div>
										</div>
									</div>
								@endif

							</form>
					  	</div>
					</div>
				</div>				
				<div class="col-md-4">
					<div class="card bg-light mb-3 rounded-0">
					  	<div class="card-header">PayPal</div>
					  	<div class="card-body">
					    	<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card"s content.</p>
							<a href="#" class="btn btn-sm btn-primary rounded-0">Pay Order</a>
					  	</div>
					</div>
				</div>				
				<div class="col-md-4">
					<div class="card bg-light mb-3 rounded-0">
					  	<div class="card-header">Bank Transfar</div>
					  	<div class="card-body">
					    	<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card"s content.</p>
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