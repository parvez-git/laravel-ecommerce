@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-3">
            <div class="card bg-transparent text-dark rounded-0">

                @if(auth()->user()->admin)
                    <div class="card-header text-dark">Admin</div>
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item bg-transparent rounded-0">
                                <a href="{{ route('admin') }}" class="text-dark font-weight-bold">Dashboard</a>
                            </li>
                            <li class="list-group-item bg-transparent rounded-0">
                                <a href="{{ route('category.index') }}" class="text-dark">Categories</a>
                            </li>
                            <li class="list-group-item bg-transparent rounded-0">
                                <a href="{{ route('category.index') }}" class="text-dark">Products</a>
                            </li>
                            <li class="list-group-item bg-transparent rounded-0">
                                <a href="" class="text-dark">Settings</a>
                            </li>
                        </ul>
                    </div>
                @else 
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
                @endif
            </div>
        </div>

        <div class="col-md-9">
            <div class="card bg-transparent text-dark rounded-0">
                <div class="card-header text-dark">Order Details</div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>SL.</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php 
                                    $total = 0;
                                    $tax = 0.21;
                                @endphp
                                @foreach($orderdetails as $key => $product)
                                    @php
                                        $total += $product->subtotal;
                                    @endphp
                                    <tr>
                                        <td>{{ ++$key }}.</td>
                                        <td>{{ $product->name }}</td>
                                        <td>
                                            <img src="{{ asset('images').'/'.$product->image }}" alt="" width="60px">
                                        </td>
                                        <td>${{ $product->price }}</td>
                                        <td>{{ $product->qty }}</td>
                                        <td>${{ $product->subtotal }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="3"></th>
                                    <th colspan="2">Total:</th>
                                    <th>${{ $total }}</th>
                                </tr>
                                <tr>
                                    <th colspan="3"></th>
                                    <th colspan="2">Tax:</th>
                                    <th>${{ ($total * $tax) }}</th>
                                </tr>
                                <tr>
                                    <th colspan="3"></th>
                                    <th colspan="2">Grand Total:</th>
                                    <th>${{ $total + ($total * $tax) }}</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <table class="table table-bordered">
                        <thead>
                            <tr><th>Address</th></tr>
                        </thead>
                        <tbody>
                            @foreach($orderdetails as $key => $product)
                                @if($key==0)
                                    <tr><td><span>Name: {{ $product->firstname}} {{ $product->lastname}}</span></td></tr>
                                    <tr><td><span>Email: {{ $product->email}}</span></td></tr>
                                    <tr><td><span>Phone: {{ $product->phone}}</span></td></tr>
                                    <tr><td><span>Address: {{ $product->address}}</span></td></tr>
                                    <tr><td><span>Address2: {{ $product->address2}}</span></td></tr>
                                    <tr><td><span>Country: {{ $product->country}}</span></td></tr>
                                    <tr><td><span>State: {{ $product->state}}</span></td></tr>
                                    <tr><td><span>Zip Code: {{ $product->zip}}</span></td></tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

    </div>
</div>
@endsection
