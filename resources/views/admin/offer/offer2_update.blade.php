@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h3>Offer-2 Update</h3>
                </div>
                <div class="d-flex justify-content-end">
                    <a href="{{ route('offer.list') }}" class="btn btn-primary mr-3">Back To Offer List</a>
                </div>
                <div class="card-body">
                    <form action="{{ route('offer2.update',$offer2->first()->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="" class="form-label">Title</label>
                            <input type="text" name="title" class="form-control" value="{{ $offer2->first()->title }}">
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Subtitle</label>
                            <input type="text" name="subtitle" class="form-control" value="{{ $offer2->first()->subtitle }}">
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Image</label>
                            <input type="file" name="image" class="form-control" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                            <div class="my-2">
                                <img width="150" id="blah" src="{{ asset('uploads/offer') }}/{{ $offer2->first()->image }}" alt="">
                            </div>
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
