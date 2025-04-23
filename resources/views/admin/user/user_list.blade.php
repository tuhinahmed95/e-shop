@extends('layouts.admin')
@section('content')
@can('user_access')
    <div class="row">
        <div class="col-lg-10 m-auto">
            <div class="card">
                <div class="card-header">
                    <h3>User List</h3>
                </div>
                <div class="d-flex justify-content-end">
                    <a href="{{ route('user.create') }}" class="mr-3 btn btn-primary">Add New User</a>
                </div>

                @if (session('delete'))
                    <div class="alert alert-danger">{{ session('delete') }}</div>
                @endif

                @if (session('User'))
                    <div class="alert alert-danger">{{ session('User') }}</div>
                @endif
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Photo</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Acton</th>
                            </tr>
                        </thead>
                        @foreach ($users as $key => $user )
                        <tbody>
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>
                                    @if ($user->photo != null)
                                        <img src="{{ asset('uploads/user') }}/{{ $user->photo }}" alt="">
                                    @else
                                        <img src="{{ Avatar::create($user->name)->toBase64() }}" />
                                    @endif

                                </td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <a href="{{ route('user.delete',$user->id) }}" class="btn btn-danger"><i class="fa-solid fa-trash"></i></a>
                                </td>
                            </tr>
                        </tbody>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@else
<h3 class="text-danger">You Have No Access</h3>
@endcan
@endsection
