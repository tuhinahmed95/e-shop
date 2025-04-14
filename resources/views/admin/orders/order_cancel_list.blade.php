@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-lg-8 m-auto">
            <div class="card">
                <div class="card-header">
                    <h3>Order Cancel List</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>SL</th>
                            <th>Order ID :</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($orderCancels as $sl=>$orderCancel)
                        <tr>
                            <td>{{ $sl+1 }}</td>
                            <td>{{ App\Models\Order::find($orderCancel->order_id)->order_id }}</td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
