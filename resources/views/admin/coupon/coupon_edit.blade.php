@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-lg-8 m-auto">
            <div class="card">
                <div class="card-header">
                    <h3>Coupon Update</h3>
                </div>
                <div class="d-flex justify-content-end">
                    <a href="{{ route('coupon.list') }}" class="btn btn-primary mr-3">Back To Coupn List</a>
                </div>
                <div class="card-body">
                    <form action="{{ route('coupon.update',$coupon->id) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="" class="form-label">Coupon</label>
                            <input type="text" name="coupon" class="form-control" value="{{ $coupon->coupon }}">
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Type</label>
                            <select name="type">
                                <option value="">Select Type</option>
                                <option value="1" {{ $coupon->type == 1?'selected':'' }}>Percentage</option>
                                <option value="2" {{ $coupon->type == 2?'selected':'' }}>Solid</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Amount</label>
                            <input type="number" name="amount" class="form-control" value="{{ $coupon->amount }}">
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Validity</label>
                            <input type="date" name="validity" class="form-control" value="{{ $coupon->validity }}">
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Limit</label>
                            <input type="number" name="limit" class="form-control" value="{{ $coupon->limit }}">
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Update Coupon</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
