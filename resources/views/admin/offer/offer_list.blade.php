@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h3>Offer-1 List</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>SL</th>
                            <th>Title</th>
                            <th>Price</th>
                            <th>Discount Price</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($offers1 as $key => $offer1)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $offer1->title }}</td>
                            <td>{{ $offer1->price }}</td>
                            <td>{{ $offer1->discount_price }}</td>
                            <td>
                                <img width="70" src="{{ asset('uploads/offer') }}/{{ $offer1->image }}" alt="">
                            </td>
                            <td>
                                <a href="{{ route('offer1.edit',$offer1->id) }}" class="btn btn-warning"><i data-feather="edit"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>


        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h3>Offer-2 List</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>SL</th>
                            <th>Title</th>
                            <th>Subtitle</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($offers2 as $key => $offer2)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $offer2->title }}</td>
                            <td>{{ $offer2->subtitle }}</td>
                            <td>
                                <img src="{{ asset('uploads/offer') }}/{{ $offer2->image }}" alt="">
                            </td>
                            <td>
                                <a href="{{ route('offer2.edit',$offer2->id) }}" class="btn btn-warning"><i data-feather="edit"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
