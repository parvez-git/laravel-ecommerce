@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-3">
            <div class="card bg-transparent text-dark rounded-0">
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
            </div>
        </div>

        <div class="col-md-9">
            <div class="card bg-transparent text-dark rounded-0">
                <div class="card-header text-dark">Order List</div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Order ID</th>
                                    <th>Payment Type</th>
                                    <th>Payment Status</th>
                                    <th></th>
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

                                                <a href="{{ route('admin.paymentstatusupdate',$order->order_id) }}" class="btn btn-sm btn-outline-success rounded-0"
                                                    onclick="event.preventDefault();
                                                        document.getElementById('orderstatus-form-{{$order->order_id}}').submit();">
                                                    <span>Approve</span>
                                                </a>
                                                <form id="orderstatus-form-{{$order->order_id}}" action="{{ route('admin.paymentstatusupdate',$order->order_id) }}" method="POST" style="display: none;">
                                                    @csrf
                                                    @method('PUT')
                                                </form>
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
