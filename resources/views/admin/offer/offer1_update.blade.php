@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h3>Offer-1 Update</h3>
                </div>
                <div class="d-flex justify-content-end">
                    <a href="{{ route('offer.list') }}" class="btn btn-primary mr-3">Back To Offer List</a>
                </div>
                <div class="card-body">
                    <form action="{{ route('offer1.update',$offer1->first()->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="" class="form-label">Title</label>
                            <input type="text" name="title" class="form-control" value="{{ $offer1->first()->title }}">
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Price</label>
                            <input type="number" name="price" class="form-control" value="{{ $offer1->first()->price }}">
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Discount Price</label>
                            <input type="number" name="discount_price" class="form-control" value="{{ $offer1->first()->discount_price }}">
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Image</label>
                            <input type="file" name="image" class="form-control" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                            <div class="my-2">
                                <img width="150" id="blah" src="{{ asset('uploads/offer') }}/{{ $offer1->first()->image }}" alt="">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Date</label>
                            <input type="date" name="date" class="form-control" value="{{$offer1->first()->date }}">
                        </div>

                        <div class="mb-3">
                           <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
