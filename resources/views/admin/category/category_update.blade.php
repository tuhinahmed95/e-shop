@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-lg-6 m-auto">
            <div class="card">
                <div class="card-header">
                    <h3>Edit Category</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('category.update',$category->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="" class="form-label"> Category Name </label>
                            <input type="text" class="form-control" name="category_name" value="{{ $category->category_name }}">
                            @error('category_name')
                            <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label"> Category Icon </label>
                            <input type="file" class="form-control" name="icon">
                            @error('icon')
                            <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                            <div class="my">
                                <img width="50" src="{{ asset('uploads/category') }}/{{ $category->icon }}" alt="">
                            </div>
                        </div>

                        <div class="mb-3">
                           <button type="submit" class="btn btn-primary">Update Category</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
