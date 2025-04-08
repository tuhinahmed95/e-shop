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
                        <li><a href="product.html">Product</a></li>
                        <li>Product Single</li>
                    </ol>
                </div>
            </div>
        </div> <!-- end row -->
    </div> <!-- end container -->
</section>
<!-- end page-title -->

<div class="container">
    <div class="row">
        <div class="col-lg-3 m-auto py-5">
            <div class="card" style="width: 18rem;">
                @if (Auth::guard('customer')->user()->photo == null)
                    <img width="70" class="m-auto mt-2" src="{{ Avatar::create(Auth::guard('customer')->user()->fname)->toBase64() }}" />
                @else
                    <img class="card-img-top" src="{{ asset('frontend/customer') }}/{{ Auth::guard('customer')->user()->photo }}" alt="Card image cap">
                @endif
                <div class="card-body">
                  <h5 class="card-title text-center">{{ Auth::guard('customer')->user()->fname.' '. Auth::guard('customer')->user()->lname }}</h5>
                </div>
                <ul class="list-group list-group-flush">
                  <li class="list-group-item text-center bg-light py-1"><a href="" class="text-dark">My Profile</a></li>
                  <li class="list-group-item text-center bg-light py-1"><a href="" class="text-dark">My Whish List</a></li>
                  <li class="list-group-item text-center bg-light py-1"><a href="" class="text-dark">My Order</a></li>
                  <li class="list-group-item text-center bg-light py-1"><a href="{{ route('customer.logout') }}" class="text-dark">Logout</a></li>
                </ul>
            </div>
        </div>
        <div class="col-lg-9"></div>
    </div>
</div>
@endsection
