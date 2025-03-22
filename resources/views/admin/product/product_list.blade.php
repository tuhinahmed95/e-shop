@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3>Product List</h3>
                </div>
                <div class="d-flex justify-content-end">
                    <a href="{{ route('product.create') }}" class="btn btn-primary mr-3"><i data-feather="plus"></i>Add New Product</a>
                </div>
                @if (session('success'))
                 <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if (session('update'))
                 <div class="alert alert-success">{{ session('update') }}</div>
                @endif
                @if (session('delete'))
                 <div class="alert alert-success">{{ session('delete') }}</div>
                @endif
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>Sl</th>
                            <th>Product Name</th>
                            <th>Price</th>
                            <th>Discount</th>
                            <th>After_Discount</th>
                            <th>Preview Image</th>
                            <th>status</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($products as $key => $product )
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $product->product_name }}</td>
                            <td>{{ $product->price }}</td>
                            <td>{{ $product->discount }}</td>
                            <td>{{ $product->after_discount }}</td>
                            <td>
                                <img src="{{ asset('uploads/product/preview') }}/{{ $product->preview }}" alt="">
                            </td>
                            <td>
                                <input type="checkbox" {{ $product->status == 1?'checked':'' }} data-id="{{ $product->id }}" class="status"  data-toggle="toggle" value="{{ $product->status }}">

                            </td>
                            <td class="d-flex">
                                <a href="{{ route('product.view',$product->id) }}" class="btn btn-primary mr-1"><i data-feather="eye"></i></a>
                                <a href="{{ route('product.edit',$product->id) }}" class="btn btn-warning mr-1"><i data-feather="edit"></i></a>
                                <a href="{{ route('product.delete',$product->id) }}" class="btn btn-danger del_btn" ><i data-feather="trash"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer_script')
<script>
    $('.status').change(function(){

        if($(this).val()!=1){
            $(this).attr('value',1)
        }
        else{
            $(this).attr('value',0)
        }
        var product_id = $(this).attr('data-id');
        var status = $(this).val();

        $.ajaxSetup({
                headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });

            $.ajax({
                url:'/getStatus',
                type:'POST',
                data:{'product_id':product_id,'status':status},
                success: function (data){

                }
            });

    })
</script>
@endsection
