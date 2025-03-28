@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-lg-8 m-auto">
            <div class="card">
                <div class="card-header">
                    <h3>Update A banner</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('banner.update',$banner->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="" class="form-label">Tittle</label>
                            <input type="text" name="banner_title" class="form-control" value="{{ $banner->title }}">
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Image</label>
                            <input type="file" name="banner_image" class="form-control">
                            <div class="my-2">
                                <img width="100" src="{{ asset('uploads/banner') }}/{{ $banner->banner_image }}" alt="">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Page Link</label>
                            <select name="category_id" class="form-control">
                                <option value="">Select Category</option>
                                @foreach ($categories as $category)
                                 <option value="{{ $category->id }}" {{ $category->id == $banner->category_id? 'selected':'' }}>{{ $category->category_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Update Banner</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
