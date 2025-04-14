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
                    <h3>My Order List</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>SL</th>
                            <th>Order ID</th>
                            <th>Total</th>
                            <th>Order Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($my_orders as $my_order)
                        <tr>
                            <td>{{ $loop->index+1 }}</td>
                            <td>{{ $my_order->order_id }}</td>
                            <td>{{ $my_order->total }}</td>
                            <td>{{ $my_order->created_at->format('Y-m-d') }}</td>
                            <td>
                                @if ($my_order->status == 0)
                                    <span class="badge bg-secondary">Placed</span>
                                @elseif ($my_order->status == 1)
                                    <span class="badge bg-primary">Procesing</span>
                                @elseif ($my_order->status == 2)
                                    <span class="badge bg-warning">Shipping</span>
                                @elseif ($my_order->status == 3)
                                    <span class="badge bg-info">Ready For Delivery</span>
                                @elseif ($my_order->status == 4)
                                    <span class="badge bg-success">Received</span>
                                @elseif ($my_order->status == 5)
                                    <span class="badge bg-danger">Cancel</span>
                                @endif
                            </td>
                            <td>
                                @if (App\Models\OrderCancel::where('order_id',$my_order->id)->exists())
                                    <a class="badge bg-info">Cancel Request Pending</a>
                                @else
                                    @if ($my_order->status == 5)
                                        <a class="badge bg-danger">Canceled</a>
                                    @else
                                        <a href="{{ route('invoice.download',$my_order->id) }}" class="badge bg-info">Download Invoice</a>
                                    @endif

                                    @if ($my_order->status == 5)

                                    @else
                                        <a href="{{ route('invoice.download',$my_order->id) }}" class="badge bg-info">Download Invoice</a>
                                    @endif

                                @endif

                                {{-- <a href="{{ route('orders.cancel',$my_order->id) }}" class="badge bg-danger">Order Cancel</a> --}}
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
