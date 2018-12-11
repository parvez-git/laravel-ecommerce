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
                <div class="card-header text-dark">Create Product</div>

                <div class="card-body">
                    <form class="" action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label>Product name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control rounded-0" name="name" required="">
                                @if ($errors->has('name'))
                                    <div class="invalid-feedback d-block">
                                        {{ $errors->first('name') }}
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <label>Product Price <span class="text-danger">*</span></label>
                                <input type="text" class="form-control rounded-0" name="price" required="">
                                @if ($errors->has('price'))
                                    <div class="invalid-feedback d-block">
                                        {{ $errors->first('price') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label>Product Category <span class="text-danger">*</span></label>
                                <select name="category_id" class="form-control rounded-0">
                                    <option value="" selected disabled>--Select Category--</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('category_id'))
                                    <div class="invalid-feedback d-block">
                                        {{ $errors->first('category_id') }}
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <label>Product Image <span class="text-danger">*</span></label>
                                <input type="file" class="form-control rounded-0" name="image">
                                @if ($errors->has('image'))
                                    <div class="invalid-feedback d-block">
                                        {{ $errors->first('image') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label>Product Description <span class="text-danger">*</span></label>
                                <textarea name="description" class="form-control rounded-0" rows="6"></textarea>
                            </div>
                        </div>
                        <button class="btn btn-primary mt-3 rounded-0" type="submit">Create Product</button>
                    </form>
                </div>

            </div>
        </div>

    </div>
</div>
@endsection
