@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-lg-8 m-auto">
            <div class="card">
                <div class="card-header">
                    <h3>Size List</h3>
                </div>
                <div class="d-flex justify-content-end mb-2">
                    <a href="{{ route('size.create') }}" class="btn btn-primary mr-3">Add New Size</a>
                </div>
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if (session('update'))
                    <div class="alert alert-success">{{ session('update') }}</div>
                @endif

                @if (session('delete'))
                    <div class="alert alert-danger">{{ session('delete') }}</div>
                @endif
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>SL</th>
                            <th>Catagory Name</th>
                            <th>Size</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($sizes as $key => $size)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $size->category->category_name }}</td>
                            <td>{{ $size->size_name }}</td>
                            <td>
                                <a href="{{ route('size.edit',$size->id) }}" class="btn btn-warning"><i class="fa fa-pencil"></i></a>
                                <a href="{{ route('size.delete',$size->id) }}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
