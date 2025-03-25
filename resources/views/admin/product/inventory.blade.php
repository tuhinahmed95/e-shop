@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h3>Inventory or Stock for <strong class="text-danger">{{ $product->product_name }}</strong></h3>
                </div>
                @if (session('delete'))
                  <div class="alert alert-danger">{{ session('delete') }}</div>
                @endif
                <div class="d-flex justify-content-end">
                    <a href="{{ route('product.list') }}" class="btn btn-primary mr-5">Back to Product List</a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>Color</th>
                            <th>Size</th>
                            <th>Quantity</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($inventories as $inventory)
                        <tr>
                            <td>{{ $inventory->rel_to_color->color_name }}</td>
                            <td>{{ $inventory->rel_to_size->size_name }}</td>
                            <td>{{ $inventory->quantity }}</td>
                            <td>
                                <a href="{{ route('inventory.delete',$inventory->id) }}" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h3>Add New Stock Or Inventory</h3>
                </div>
                @if (session('inventory'))
                 <div class="alert alert-success">{{ session('inventory') }}</div>
                @endif
                <div class="card-body">
                    <form action="{{ route('inventory.store',$product->id) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="" class="form-label">Product</label>
                            <input type="text" disabled class="form-control" value="{{ $product->product_name }}">
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Color</label>
                            <select name="color_id" class="form-control">
                                <option value="">Select Color</option>
                                @foreach ($colors as $color)
                                <option value="{{ $color->id }}">{{ $color->color_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Size</label>
                            <select name="size_id" class="form-control">
                                <option value="">Select Color</option>
                                @foreach (App\Models\Size::where('category_id',$product->category_id)->get() as $size)
                                <option value="{{ $size->id }}">{{ $size->size_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Quantity</label>
                            <input type="number" name="quantity" class="form-control">
                            @error('quantity')
                             <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Add Inventory</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
