@extends('frontend.master')
@section('content')
<!-- start wpo-page-title -->
<section class="wpo-page-title">
    <h2 class="d-none">Hide</h2>
    <div class="container">
        <div class="row">
            <div class="col col-xs-12">
                <div class="wpo-breadcumb-wrap">
                    <ol class="wpo-breadcumb-wrap">
                        <li><a href="index.html">Home</a></li>
                        <li><a href="product.html">My Orders</a></li>
                    </ol>
                </div>
            </div>
        </div> <!-- end row -->
    </div> <!-- end container -->
</section>
<!-- end page-title -->

<div class="container">
    <div class="row my-5">
        <div class="col-lg-3 m-auto py-3">
            <div class="card" style="width: 18rem;">
                @if (Auth::guard('customer')->user()->photo == null)
                    <img width="70" class="m-auto mt-2" src="{{ Avatar::create(Auth::guard('customer')->user()->fname)->toBase64() }}" />
                @else
                     <img width="70" class="m-auto mt-2" src="{{ asset('uploads/customer') }}/{{ Auth::guard('customer')->user()->photo }}" alt="">
                @endif
                <div class="card-body">
                  <h5 class="card-title text-center">{{ Auth::guard('customer')->user()->fname.' '. Auth::guard('customer')->user()->lname }}</h5>
                </div>
                <ul class="list-group list-group-flush">
                  <li class="list-group-item text-center bg-light py-1"><a href="" class="text-dark">My Profile</a></li>
                  <li class="list-group-item text-center bg-light py-1"><a href="" class="text-dark">My Whish List</a></li>
                  <li class="list-group-item text-center bg-light py-1"><a href="{{ route('my.orders') }}" class="text-dark">My Order</a></li>
                  <li class="list-group-item text-center bg-light py-1"><a href="{{ route('customer.logout') }}" class="text-dark">Logout</a></li>
                </ul>
            </div>
        </div>

        <div class="col-lg-9 py-3">
            <div class="card">
                <div class="card-header">
                    <h3>Order ID: {{ $orders?->order_id }}</h3>
                </div>
                @if (session('req'))
                    <div class="alert alert-success">{{ session('req') }}</div>
                @endif
                <div class="card-body">
                    <form action="{{ route('orders.cancel.request',['id'=> $orders?->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="" class="form-label">Cancel Reason</label>
                            <textarea name="reason" class="form-control" cols="30" rows="10"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Image</label>
                            <input type="file" class="form-control" name="image">
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Send Request</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
