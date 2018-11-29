@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-3">
            <div class="card bg-dark text-light rounded-0">
                <div class="card-header text-light">Admin</div>

                <div class="card-body">
                    <ul class="list-group">
                        <li class="list-group-item bg-dark rounded-0">
                            <a href="{{ route('admin') }}" class="text-light font-weight-bold">Dashboard</a>
                        </li>
                        <li class="list-group-item bg-dark rounded-0">
                            <a href="" class="text-light">Categories</a>
                        </li>
						<li class="list-group-item bg-dark rounded-0">
                            <a href="" class="text-light">Products</a>
                        </li>
						<li class="list-group-item bg-dark rounded-0">
                            <a href="" class="text-light">Settings</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-9">
            <div class="card bg-dark text-light rounded-0">
                <div class="card-header text-light">Order Details</div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Order ID</th>
                                    <th>Payment Type</th>
                                    <th>Payment Status</th>
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
                                                <span class="badge badge-success">Approved</span>
                                            @else
                                                <span class="badge badge-warning">Pending</span>
                                            @endif
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
