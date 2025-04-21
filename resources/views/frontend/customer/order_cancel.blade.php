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
        @include('frontend.includes.profile_sidebar')

        <div class="col-lg-9 py-3">
            <div class="card">
                <div class="card-header">
                    <h3>Order ID: {{ $orders?->order_id }}</h3>
                </div>
                @if (session('req'))
                    <div class="alert alert-success">{{ session('req') }}</div>
                @endif
                <div class="card-body">

                    <form action="{{ route('order.cancel.request',['id'=>$orders?->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="" class="form-label">Cancel Reason</label>
                            <textarea name="reason" class="form-control" cols="30" rows="10"></textarea>
                            @error('reason')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
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
