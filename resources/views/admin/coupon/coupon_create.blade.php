@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-lg-8 m-auto">
            <div class="card">
                <div class="card-header">
                    <h3>Coupon Crete</h3>
                </div>
                <div class="d-flex justify-content-end">
                    <a href="{{ route('coupon.list') }}" class="btn btn-primary mr-3">Back To Coupn List</a>
                </div>
                <div class="card-body">
                    <form action="{{ route('coupon.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="" class="form-label">Coupon</label>
                            <input type="text" name="coupon" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Type</label>
                            <select name="type">
                                <option value="">Select Type</option>
                                <option value="1">Percentage</option>
                                <option value="2">Solid</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Amount</label>
                            <input type="number" name="amount" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Validity</label>
                            <input type="date" name="validity" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Limit</label>
                            <input type="number" name="limit" class="form-control">
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Add Coupon</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
