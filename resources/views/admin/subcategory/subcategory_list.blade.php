@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-lg-10">
            <div class="card">
                <div class="card-header">
                    <h3>SubCategory List</h3>
                </div>
                <div class="d-flex justify-content-end">
                    <a href="{{ route('subcategory.create') }}" class="btn btn-primary mr-3">Add SubCategory</a>
                </div>
                @if (session('subcat'))
                    <div class="alert alert-success">{{ session('subcat') }}</div>
                @endif
                @if (session('update'))
                    <div class="alert alert-success">{{ session('update') }}</div>
                @endif
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>Sl</th>
                            <th>Category Name</th>
                            <th>Subcategory Name</th>
                            <th>Subcategory Icon</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($subcategories as $key => $subcategory)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ App\Models\Category::find($subcategory->category_id)->category_name }}</td>
                            <td>{{ $subcategory->subcategory_name }}</td>
                            <td>
                                <img src="{{ asset('uploads/subcategory') }}/{{ $subcategory->subcat_icon }}" alt="">
                            </td>
                            <td class="d-flex">
                                <a href="{{ route('subcategory.edit',$subcategory->id) }}" class="btn btn-warning mr-1"><i data-feather="edit"></i></a>
                                <a class="btn btn-danger del_btn" data-link="{{ route('subcategory.delete', $subcategory->id) }}"><i data-feather="trash"></i></a>
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
    $('.del_btn').click(function(){
            var link = $(this).attr('data-link');

            Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
            }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = link;
            }
        });
    })
</script>

@if (session('delete'))
<script>
    Swal.fire({
      title: "Deleted!",
      text: '{{ session('delete') }}',
      icon: "success"
    });
</script>
@endif
@endsection
