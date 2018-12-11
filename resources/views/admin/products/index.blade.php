@extends('../../layouts.app')

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
                            <a href="{{ route('product.index') }}" class="text-dark">Products</a>
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
                <div class="card-header text-dark">
                    Products
                    <a href="{{ route('product.create') }}" class="btn btn-sm btn-success float-right rounded-0">Add New</a>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Slug</th>
                                    <th>Category</th>
                                    <th width="130px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($products as $product)
                                    <tr>
                                        <td>{{ $product->id }}</td>
                                        <td>
                                            <img src="{{ asset('images').'/'.$product->image }}" alt="" width="60px">
                                        </td>
                                        <td>{{ $product->name }}</td>
                                        <td>${{ $product->price }}</td>
                                        <td>{{ $product->slug }}</td>
                                        <td>{{ @$product->category->name }}</td>
                                        <td>
                                            <a href="{{ route('product.edit',$product->id) }}" class="btn btn-sm btn-primary rounded-0">Edit</a>
                                            
                                            <a href="{{ route('product.destroy',$product->id) }}" class="btn btn-sm btn-danger rounded-0"
                                                onclick="event.preventDefault();
                                                    document.getElementById('productdestroy-form-{{$product->id}}').submit();">
                                                <span>Delete</span>
                                            </a>
                                            <form id="productdestroy-form-{{$product->id}}" action="{{ route('product.destroy',$product->id) }}" method="POST" style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
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
