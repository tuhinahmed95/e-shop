@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-lg-6 m-auto">
            <div class="card">
                <div class="card-header">
                    <h3>Add SubCategory</h3>
                </div>
                <div class="d-flex justify-content-end">
                    <a href="{{ route('subcategory.list') }}" class="btn btn-success mr-3">Back to SubCategory List</a>
                </div>
                @if (session('exists'))
                     <div class="alert laert-success">{{ session('exists') }}</div>
                @endif
                <div class="card-body">
                    <form action="{{ route('subcategory.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                           <select name="category"  class="form-label">
                                <option value="">Select Category</option>
                                @foreach ($categories as $category)
                                 <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                @endforeach
                                @error('category')
                                    <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                           </select>

                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">SubCategory Name</label>
                            <input type="text" class="form-control" name="subcat_name">
                            @error('subcat_name')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">SubCategory Image</label>
                            <input type="file" class="form-control" name="subcat_icon">
                        </div>

                        <div class="mb-3">
                            <button class="btn btn-success">Add SubCategory</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
