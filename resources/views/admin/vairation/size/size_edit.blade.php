@extends('layouts.admin')
@section('content')
 <div class="row">
    <div class="col-lg-8 m-auto">
        <div class="card">
            <div class="card-header">
                <h3>Create A New Size</h3>
            </div>
            <div class="d-flex justify-content-end">
                <a href="{{ route('size.list') }}" class="btn btn-primary mr-3">Back To Size List</a>
            </div>
            <div class="card-body">
                <form action="{{ route('size.update',$size->id) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="" class="form-label">Category Name</label>
                        <select class="form-control" name="category_id">
                            <option value="">Select Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ $category->id == $size->category_id? 'selected':'' }}>{{ $category->category_name }}</option>
                            @endforeach
                            @error('category_id')
                            <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Size Name</label>
                        <input type="text" class="form-control" name="size_name" value="{{ $size->size_name }}">
                        @error('size_name')
                        <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Update Size</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
 </div>
@endsection
