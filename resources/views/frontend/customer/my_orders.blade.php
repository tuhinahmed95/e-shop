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
                                @if (App\Models\OrderCancel::where('order_id', $my_order->id)->exists())
                                    <a class="badge bg-info">Cancel Request Pending</a>
                                @elseif ($my_order->status == 5)
                                    <a class="badge bg-danger">Canceled</a>
                                @else
                                    <a href="{{ route('invoice.download', $my_order->id) }}" class="badge bg-info">Download Invoice</a>
                                    <a href="{{ route('orders.cancel', $my_order->id) }}">Order Cancel</a>
                                @endif
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
