@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-lg-8 m-auto">
            <div class="card">
                <div class="card-header">
                    <h3>Color List</h3>
                </div>
                <div class="d-flex justify-content-end">
                    <a href="{{ route('color.create') }}" class="btn btn-primary mr-3">Add New Color</a>
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
                    <table class="table table-bordered bg-light">
                        <tr>
                            <th>SL</th>
                            <th>Color Name</th>
                            <th>Color Code</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($colors as $key => $color)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $color->color_name }}</td>
                            <td>
                                <i style="display: inline-block; width: 50px; height: 30px; background:{{ $color->color_name == 'N/A'? '': $color->color_code}}; color:{{ $color->color_name == 'N/A'?'':'transparent' }}">{{ $color->color_name == 'N/A'? $color->color_name:'color' }}</i>
                            </td>
                            <td>
                                <a href="{{ route('color.edit',$color->id) }}" class="btn btn-warning"><i class="fa fa-pencil"></i></a>
                                <a href="{{ route('color.delete',$color->id) }}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
