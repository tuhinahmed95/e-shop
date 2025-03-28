@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-lg-8 m-auto">
            <div class="card">
                <div class="card-header">
                    <h2>Banner List</h2>
                </div>
                <div class="d-flex justify-content-end">
                    <a href="{{ route('banner.create') }}" class="btn btn-primary mr-3">Add New Banner</a>
                </div>
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if (session('update'))
                    <div class="alert alert-success">{{ session('update') }}</div>
                @endif
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>Title</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($banners as $banner)
                        <tr>
                            <td>{{ $banner->title }}</td>
                            <td>
                                <img src="{{ asset('uploads/banner') }}/{{ $banner->banner_image }}" alt="">
                            </td>
                            <td>
                                <a href="{{ route('banner.edit',$banner->id) }}" class="btn btn-warning">Edit</a>
                                <a href="{{ route('banner.delete',$banner->id) }}" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
