@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-8">
            
            <div class="card mb-4 rounded-0">
                <div class="card-body">
                    <h4 class="card-title mb-0">Shipping Information</h4>
                </div>
            </div>

            <form class="" action="{{ route('shippinginfo.store') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="firstName">First name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control rounded-0" id="firstName" name="firstname" value="@auth{{ auth()->user()->name }}@endauth" required="">
                        @if ($errors->has('firstname'))
                            <div class="invalid-feedback d-block">
                                {{ $errors->first('firstname') }}
                            </div>
                        @endif
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="lastName">Last name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control rounded-0" id="lastName" name="lastname" value="" required="">
                        @if ($errors->has('lastname'))
                            <div class="invalid-feedback d-block">
                                {{ $errors->first('lastname') }}
                            </div>
                        @endif
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="email">Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control rounded-0" id="email" name="email" value="@auth{{ auth()->user()->email }}@endauth" required="">
                        @if ($errors->has('email'))
                            <div class="invalid-feedback d-block">
                                {{ $errors->first('email') }}
                            </div>
                        @endif
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="phone">Phone <span class="text-danger">*</span></label>
                        <input type="number" class="form-control rounded-0" id="phone" name="phone" value="" required="">
                        @if ($errors->has('phone'))
                            <div class="invalid-feedback d-block">
                                {{ $errors->first('phone') }}
                            </div>
                        @endif
                    </div>
                </div>

                <div class="mb-3">
                    <label for="address">Address <span class="text-danger">*</span></label>
                    <input type="text" class="form-control rounded-0" id="address" name="address" required="">
                    @if ($errors->has('address'))
                        <div class="invalid-feedback d-block">
                            {{ $errors->first('address') }}
                        </div>
                    @endif
                </div>

                <div class="mb-3">
                  <label for="address2">Address 2 <span class="text-muted">(Optional)</span></label>
                  <input type="text" class="form-control rounded-0" id="address2" name="address2">
                </div>

                <div class="row">
                    <div class="col-md-5 mb-3">
                        <label for="country">Country <span class="text-danger">*</span></label>
                        <select class="custom-select d-block w-100 rounded-0" name="country" id="country" required="">
                            <option value="">Choose...</option>
                            <option>United States</option>
                            <option>Bangladesh</option>
                        </select>
                        @if ($errors->has('country'))
                            <div class="invalid-feedback d-block">
                                {{ $errors->first('country') }}
                            </div>
                        @endif
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="state">State <span class="text-danger">*</span></label>
                        <select class="custom-select d-block w-100 rounded-0" name="state" id="state" required="">
                            <option value="">Choose...</option>
                            <option>California</option>
                            <option>Dhaka</option>
                            <option>Rajshahi</option>
                        </select>
                        @if ($errors->has('state'))
                            <div class="invalid-feedback d-block">
                                {{ $errors->first('state') }}
                            </div>
                        @endif
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="zip">Zip <span class="text-danger">*</span></label>
                        <input type="text" class="form-control rounded-0" id="zip" name="zip" required="">
                        @if ($errors->has('zip'))
                            <div class="invalid-feedback d-block">
                                {{ $errors->first('zip') }}
                            </div>
                        @endif
                    </div>
                </div>
                <hr class="mb-4">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="same-address">
                    <label class="custom-control-label" for="same-address">Shipping address is the same as my billing address</label>
                </div>
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" name="save-info" id="save-info">
                    <label class="custom-control-label" for="save-info">Save this information for next time</label>
                </div>
                <hr class="mb-4">

                <button class="btn btn-primary btn-lg btn-block rounded-0" type="submit">Continue to checkout</button>
            </form>
        </div>

        <div class="col-md-4">
            <ul class="list-group mb-3">
                <li class="list-group-item d-flex justify-content-between rounded-0">
                    <h4>Checkout Details</h4>
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
