@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-lg-6 m-auto">
            <div class="card">
                <div class="card-header">
                    <h3>Brand Edit</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('brand.update',$brand->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="" class="form-label">Brand Name</label>
                            <input type="text" name="brand_name" class="form-control" value="{{ $brand->brand_name }}">
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Brand Icon</label>
                            <input type="file" name="brand_icon" class="form-control">
                            <div class="py-2">
                                <img width="100" src="{{ asset('uploads/brand') }}/{{ $brand->brand_logo }}" alt="">
                            </div>
                        </div>

                        <div class="mb-3">
                           <button type="submit" class="btn btn-primary">Update Brand</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
