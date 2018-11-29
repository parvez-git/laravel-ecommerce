@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-12 table-responsive">
        	<table class="table table-bordered">
        		<thead>
	                <tr class="text-uppercase text-center">
	                    <th scope="col">
	                        <form action="{{ route('cart.delete.all') }}" method="post">
	                        	@csrf
	                            <button type="submit" class="btn btn-sm btn-light rounded-0 text-danger">x</button>
	                        </form>
	                    </th>
	                    <th scope="col" width="60px">Image</th>
	                    <th scope="col" class="text-left">Product</th>
	                    <th scope="col">Price</th>
	                    <th scope="col" width="200px">Quantity</th>
	                    <th scope="col">Sub Total</th>
	                </tr>
	            </thead>
	            <tbody>
	            	@foreach($products as $product)
	            	<tr>
                        <th class="align-middle text-center" scope="row">
                            <form action="{{ route('cart.destroy',$product->rowId) }}" method="post">
                            	@csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-light rounded-0 text-muted">x</button>
                            </form>
                        </th>

                        <td class="align-middle">
							<img src="{{ asset('images') .'/'. $product->options->image }}" class="img-fluid">
                        </td>
                        <td class="align-middle">
                            {{ $product->name }}
                        </td>

                        <td class="align-middle text-center">
                            ${{ $product->price }}
                        </td>

                        <td class="align-middle text-center">
                            <form class="form-inline" action="{{ route('cart.update',$product->rowId) }}" method="post">
                            	@csrf
                                @method('PUT')
                                <input type="number" name="qty" value="{{ $product->qty }}" class="form-control rounded-0 w-50" min="0">
                                <button type="submit" class="btn btn-default rounded-0 w-50">Update</button>
                            </form>
                        </td>
                        <td class="align-middle text-center">
                        	${{ $product->subtotal }}
                        </td>
                    </tr>
                    @endforeach
                    <tr class="bg-white">
                        <td class="text-center" colspan="4">
                            <a href="{{ route('checkout') }}" class="btn btn-success w-100 rounded-0">Checkout</a>
                        </td>
						<td class="text-right">
							<strong>Total (</strong>tax: ${{ Cart::tax() }}<strong>) :</strong>
                        </td>
                        <td class="text-center">
                            <strong>${{ Cart::total() }}</strong>
                        </td>
					</tr>
	            </tbody>
        	</table>
        </div>

    </div>
</div>
@endsection
