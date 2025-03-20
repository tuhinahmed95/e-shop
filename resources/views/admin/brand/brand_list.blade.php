@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h3>Brand List</h3>
            </div>
            <div class="d-flex justify-content-end">
                <a href="{{ route('brand.create') }}" class="btn btn-success mr-3">Add New Brand</a>
            </div>
            @if (session('brand'))
                <div class="alert alert-success">{{ session('brand') }}</div>
            @endif

            @if (session('b_update'))
                <div class="alert alert-success">{{ session('b_update') }}</div>
            @endif

            @if (session('b_delete'))
                <div class="alert alert-success">{{ session('b_delete') }}</div>
            @endif
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th>SL</th>
                        <th>Brand Name</th>
                        <th>Brand Logo</th>
                        <th>Action</th>
                    </tr>
                    @foreach ($brands as $key=>$brand )
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $brand->brand_name }}</td>
                        <td>
                            <img src="{{ asset('uploads/brand') }}/{{ $brand->brand_logo }}" alt="">
                        </td>
                        <td class="d-flex">
                            <a href="{{ route('brand.edit',$brand->id) }}" class="btn btn-warning mr-1"><i data-feather="edit"></i></a>
                            <a href="{{ route('brand.delete',$brand->id) }}" class="btn btn-danger"><i data-feather="trash"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
