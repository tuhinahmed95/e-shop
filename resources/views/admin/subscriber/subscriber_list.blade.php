@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-lg-6 m-auto">
            <div class="card">
                <div class="card-header">
                    <h3>Subscriber List</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr class="bg-light">
                            <th>SL</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($subscribers as $key => $subscriber)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $subscriber->email }}</td>
                            <td><a href="" class="btn btn-info">Send Offer</a></td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
