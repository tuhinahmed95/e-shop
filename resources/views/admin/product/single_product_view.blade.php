@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3>Single Product View</h3>
                </div>
                <div class="d-flex justify-content-end">
                    <a href="{{ route('product.list') }}" class="btn btn-success mr-3">Back to Product List</a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>Sl</th>
                            <td>{{ $product->id }}</td>
                        </tr>
                        <tr>
                            <th>Category Name</th>
                            <td>{{optional( $product->category)->category_name?? 'no category'}}</td>
                        </tr>
                        <tr>
                            <th>SubCategory Name</th>
                            <td>{{optional( $product->subcategory)->subcategory_name?? 'no Subcategory'}}</td>
                        </tr>
                        <tr>
                            <th>Brand Name</th>
                            <td>{{ optional($product->brand)->brand_name?? 'No Brand Name' }}</td>
                        </tr>
                        <tr>
                            <th>Product Name</th>
                            <td>{{ $product->product_name }}</td>
                        </tr>
                        <tr>
                            <th>Product Price</th>
                            <td>{{ $product->price }}</td>
                        </tr>
                        <tr>
                            <th>Discount Price</th>
                            <td>{{ $product->discount }}</td>
                        </tr>
                        <tr>
                            <th>After Discount</th>
                            <td>{{ $product->after_discount }}</td>
                        </tr>
                        <tr>
                            <th>Tags</th>
                            <td>{{ $product->tags}}</td>
                        </tr>
                        <tr>
                            <th>Short Description</th>
                            <td>{!! $product->short_des !!}</td>
                        </tr>
                        <tr>
                            <th>Long Description</th>
                            <td>{!! $product->long_des !!}</td>
                        </tr>
                        <tr>
                            <th>Addininal Information</th>
                            <td>{!! $product->addi_info !!}</td>
                        </tr>
                        <tr>
                            <th>Preview Image</th>
                            <td>
                                <img src="{{ asset('uploads/product/preview') }}/{{ $product->preview }}" alt="">
                            </td>
                        </tr>
                        <tr>
                            <th>Gallery Image</th>
                            <td>
                                @foreach ($product->gallery as $gal )
                                <img src="{{ asset('uploads/product/gallery') }}/{{ $gal->gallery }}" alt="">
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>{{ $product->status }}</td>
                        </tr>
                        <tr>
                            <th>Slug</th>
                            <td>{{ $product->slug }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
