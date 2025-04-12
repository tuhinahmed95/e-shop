@extends('frontend.master')
@section('content')

<section class="wpo-page-title">
    <h2 class="d-none">Hide</h2>
    <div class="container">
        <div class="row">
            <div class="col col-xs-12">
                <div class="wpo-breadcumb-wrap">
                    <ol class="wpo-breadcumb-wrap">
                        <li><a href="index.html">Home</a></li>
                        <li><a href="product.html">Order Success</a></li>
                    </ol>
                </div>
            </div>
        </div> <!-- end row -->
    </div> <!-- end container -->
</section>
    <!-- end page-title -->


<div class="row py-5">
    <div class="col-lg-8 m-auto">
        <div class="card">
            <div class="card-header">Order Id : {{ session('success') }}</div>
        </div>
        <div class="card-body">
            <img src="{{ asset('frontend/images/order.png') }}" alt="">
        </div>
    </div>
</div>
@endsection
