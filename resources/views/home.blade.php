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
                <div class="card-header">Order Details</div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Order ID</th>
                                    <th>Payment Type</th>
                                    <th>Payment Status</th>
                                    <th>Payment Details</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)
                                    <tr>
                                        <td>{{ $order->id }}</td>
                                        <td>{{ $order->order_id }}</td>
                                        <td>{{ $order->payment_type }}</td>
                                        <td>
                                            @if($order->payment_status)
                                                <span class="badge badge-success p-2 rounded-0">Approved</span>
                                            @else
                                                <span class="badge badge-warning p-2 rounded-0">Pending</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('home.orderdetails',$order->order_id) }}" class="btn btn-sm btn-primary rounded-0">Details</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>
@endsection
