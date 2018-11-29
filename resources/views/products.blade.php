@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

		@foreach($products as $product)
        <div class="col-md-3 mb-4">
            <div class="card">
				<img class="card-img-top" src="{{ asset('images') .'/'. $product->image }}" alt="{{ $product->name }}">
				<div class="card-body">
					<h5 class="card-title">{{ $product->name }}</h5>
				    <p class="card-text font-weight-bold">${{ $product->price }}</p>

				    <form action="{{ route('cart.store') }}" method="post">
				    	@csrf
				    	<input type="hidden" name="id" value="{{ $product->id }}">
				    	<input type="hidden" name="name" value="{{ $product->name }}">
				    	<input type="hidden" name="price" value="{{ $product->price }}">
				    	<input type="hidden" name="image" value="{{ $product->image }}">
				    	<div class="form-group">
				    		<input type="number" name="qty" value="1" class="form-control w-50 rounded-0 float-left border-right-0" min="1">
				    		<input type="submit" name="submit" value="Add to Cart" class="form-control w-50 rounded-0 btn btn-warning float-left border-top border-right border-bottom">
				    	</div>
				    </form>
				</div>
			</div>
        </div>
        @endforeach

    </div>
</div>
@endsection
