@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-lg-10 m-auto">
            <div class="card">
                <div class="card-heder">
                    <h3>Coupon List</h3>
                </div>
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if (session('update'))
                    <div class="alert alert-success">{{ session('update') }}</div>
                @endif

                @if (session('delete'))
                    <div class="alert alert-success">{{ session('delete') }}</div>
                @endif
                <div class="d-flex justify-content-end">
                    <a href="{{ route('coupon.crete') }}" class="btn btn-primary mr-3">Add Coupon</a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>SL</th>
                            <th>Coupon</th>
                            <th>Type</th>
                            <th>Limit</th>
                            <th>Validity</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($coupons as $key => $coupon)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $coupon->coupon }}</td>
                            <td>{{ $coupon->type == 1?'Percentage':'solid' }}</td>
                            <td>{{ $coupon->limit }}</td>
                            <td>{{ $coupon->validity }}</td>
                            <td>{{ $coupon->amount }}</td>
                            <td>
                                <a href="{{ route('coupon.status',$coupon->id) }}" class="btn btn-{{ $coupon->status == 1?'success':'info' }}">{{ $coupon->status == 1?'Active':'Inactive' }}</a>
                            </td>
                            <td>
                                <a href="{{ route('coupon.edit',$coupon->id) }}" class="btn btn-warning"><i data-feather="edit"></i></a>
                                <a href="{{ route('coupon.delete',$coupon->id) }}" class="btn btn-danger"><i data-feather="trash"></i></a>

                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
