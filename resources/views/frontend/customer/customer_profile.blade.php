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
                     <img width="70" class="m-auto mt-2" src="{{ asset('uploads/customer') }}/{{ Auth::guard('customer')->user()->photo }}" alt="">
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
        <div class="col-lg-9 my-5">
            <div class="card">
                <div class="card-header">
                    <h2>Customer Information Update</h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('customer.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="" class="form-label">First Name</label>
                                    <input type="text" class="form-control" name="fname" value="{{ Auth::guard('customer')->user()->fname }}">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="" class="form-label">Last Name</label>
                                    <input type="text" class="form-control" name="lname" value="{{ Auth::guard('customer')->user()->lname }}">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="" class="form-label">Email</label>
                                    <input type="text" class="form-control" name="email" value="{{ Auth::guard('customer')->user()->email }}">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="" class="form-label">Password</label>
                                    <input type="password" class="form-control" name="password">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="" class="form-label">Phone</label>
                                    <input type="number" class="form-control" name="phone" value="{{ Auth::guard('customer')->user()->phone }}">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="" class="form-label">Zip</label>
                                    <input type="number" class="form-control" name="zip" value="{{ Auth::guard('customer')->user()->zip }}">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="" class="form-label">Address</label>
                                    <input type="text" class="form-control" name="address" value="{{ Auth::guard('customer')->user()->address }}">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="" class="form-label">Image</label>
                                    <input type="file" class="form-control" name="photo"  onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                                    <img width="70" class="mt-2" id="blah" src="{{ asset('uploads/customer') }}/{{ Auth::guard('customer')->user()->photo }}" alt="">
                                </div>
                            </div>

                            <div class="col-lg-6 m-auto">
                                <div class="mb-3 d-block">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
