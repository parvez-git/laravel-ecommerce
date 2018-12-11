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
                            <a href="" class="text-dark">Products</a>
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
                <div class="card-header text-dark">Edit Category</div>

                <div class="card-body">
                    <form class="" action="{{ route('category.update',$category->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-12">
                                <label>Category name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control rounded-0" name="name" value="{{ $category->name }}" required="">
                                @if ($errors->has('name'))
                                    <div class="invalid-feedback d-block">
                                        {{ $errors->first('name') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <button class="btn btn-primary mt-3 rounded-0" type="submit">Update Category</button>
                    </form>
                </div>

            </div>
        </div>

    </div>
</div>
@endsection
