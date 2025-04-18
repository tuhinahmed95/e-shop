@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h2>Order List</h2>
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
                        @foreach ($orders as $order )
                        <tr>
                            <td>{{ $loop->index+1 }}</td>
                            <td>{{ $order->order_id }}</td>
                            <td>{{ $order->total }}</td>
                            <td>{{ $order->created_at->format('Y-m-d') }}</td>
                            <td>
                                @if ($order->status == 0)
                                    <span class="badge bg-secondary">Placed</span>
                                @elseif ($order->status == 1)
                                    <span class="badge bg-primary">Processing</span>
                                @elseif ($order->status == 2)
                                    <span class="badge bg-warning">Shipping</span>
                                @elseif ($order->status == 3)
                                    <span class="badge bg-info">Ready To Deliver</span>
                                @elseif ($order->status == 4)
                                    <span class="badge bg-success">Delivered</span>
                                @elseif ($order->status == 5)
                                    <span class="badge bg-danger">Cancel</span>
                                @endif
                            </td>
                            <td>
                                <form action="{{ route('orders.status.update', $order->id) }}" method="POST">
                                    @csrf
                                      <div class="dropdown">
                                        <button class="btn" type="button" data-toggle="dropdown" aria-expanded="false">
                                          Change Status
                                        </button>
                                        <div class="dropdown-menu">
                                            <button name="status" style="background: #{{$order->status == 0?'ddd':''}}" value="0" class="dropdown-item">Placed</button>
                                            <button name="status" value="1" style="background: #{{$order->status == 1?'ddd':''}}" class="dropdown-item">Processing</button>
                                            <button name="status" value="2" style="background: #{{$order->status == 2?'ddd':''}}" class="dropdown-item">Shipping</button>
                                            <button name="status" value="3" style="background: #{{$order->status == 3?'ddd':''}}" class="dropdown-item">Ready To Deliver</button>
                                            <button name="status" value="4" style="background: #{{$order->status == 4?'ddd':''}}" class="dropdown-item">Delivered</button>
                                            <button name="status" value="5" style="background: #{{$order->status == 5?'ddd':''}}" class="dropdown-item">Cancel</button>
                                        </div>
                                      </div>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
