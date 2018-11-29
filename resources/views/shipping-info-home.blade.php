@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-3">
            <div class="card rounded-0">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    <ul class="list-group">
                        <li class="list-group-item rounded-0">
                            <a href="{{ route('home') }}" class="text-dark">Order List</a>
                        </li>
                        <li class="list-group-item rounded-0">
                            <a href="{{ route('home.shippinginfo') }}" class="text-dark">Shipping Address</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-9">
            <div class="card rounded-0">
                <div class="card-header">Shipping Address</div>

                <div class="card-body">
                    @if($shippinginfo)
                    <form class="" action="{{ route('shippinginfo.store') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="firstName">First name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control rounded-0" id="firstName" name="firstname" value="{{ $shippinginfo->firstname }}" required="">
                                @if ($errors->has('firstname'))
                                    <div class="invalid-feedback d-block">
                                        {{ $errors->first('firstname') }}
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="lastName">Last name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control rounded-0" id="lastName" name="lastname" value="{{ $shippinginfo->lastname }}" required="">
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
                                <input type="email" class="form-control rounded-0" id="email" name="email" value="@auth{{ auth()->user()->email }}@endauth" readonly="true">
                                @if ($errors->has('email'))
                                    <div class="invalid-feedback d-block">
                                        {{ $errors->first('email') }}
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="phone">Phone <span class="text-danger">*</span></label>
                                <input type="number" class="form-control rounded-0" id="phone" name="phone" value="{{ $shippinginfo->phone }}" required="">
                                @if ($errors->has('phone'))
                                    <div class="invalid-feedback d-block">
                                        {{ $errors->first('phone') }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="address">Address <span class="text-danger">*</span></label>
                            <input type="text" class="form-control rounded-0" id="address" name="address" value="{{ $shippinginfo->address }}" required="">
                            @if ($errors->has('address'))
                                <div class="invalid-feedback d-block">
                                    {{ $errors->first('address') }}
                                </div>
                            @endif
                        </div>

                        <div class="mb-3">
                          <label for="address2">Address 2 <span class="text-muted">(Optional)</span></label>
                          <input type="text" class="form-control rounded-0" id="address2" name="address2" value="{{ $shippinginfo->address2 }}">
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
                                <input type="text" class="form-control rounded-0" id="zip" name="zip" value="{{ $shippinginfo->zip }}" required="">
                                @if ($errors->has('zip'))
                                    <div class="invalid-feedback d-block">
                                        {{ $errors->first('zip') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <hr class="mb-4">

                        <button class="btn btn-primary btn-lg btn-block rounded-0" type="submit">Update Shipping Address</button>
                    </form>
                    @endif
                </div>

            </div>
        </div>

    </div>
</div>
@endsection
