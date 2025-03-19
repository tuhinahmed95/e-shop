@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-lg-6 m-auto">
            <div class="card">
                <div class="card-header">
                    <h3>Edit SubCategory</h3>
                </div>
                <div class="d-flex justify-content-end">
                    <a href="{{ route('subcategory.list') }}" class="btn btn-success mr-3">Back to SubCategory List</a>
                </div>
                <div class="card-body">
                    <form action="{{ route('subcategory.update',$subcategory->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                           <select name="category"  class="form-label">
                                <option value="">Select Category</option>
                                @foreach ($categories as $category)
                                 <option {{ $subcategory->category_id == $category->id? 'selected':'' }} value="{{ $category->id }}">{{ $category->category_name }}</option>
                                @endforeach
                                @error('category')
                                    <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                           </select>

                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">SubCategory Name</label>
                            <input type="text" class="form-control" name="subcat_name" value="{{ $subcategory->subcategory_name }}">
                            @error('subcat_name')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">SubCategory Image</label>
                            <input type="file" class="form-control" name="subcat_icon">
                            <div class="my-2">
                                <img width="100" src="{{ asset('uploads/subcategory') }}/{{ $subcategory->subcat_icon }}" alt="">
                            </div>
                        </div>

                        <div class="mb-3">
                            <button class="btn btn-success">Update SubCategory</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
