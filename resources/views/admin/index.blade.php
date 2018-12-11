@extends('../layouts.app')

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
                    Categories
                    <a href="{{ route('category.create') }}" class="btn btn-sm btn-success float-right rounded-0">Add New</a>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($categories as $category)
                                    <tr>
                                        <td>{{ $category->id }}</td>
                                        <td>{{ $category->name }}</td>
                                        <td>{{ $category->slug }}</td>
                                        <td>
                                            <a href="{{ route('category.edit',$category->id) }}" class="btn btn-sm btn-primary rounded-0">Edit</a>
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
