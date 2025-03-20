@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-lg-8">
            <form action="{{ route('checked.category.trash') }}" method="POST">
                @csrf

                <div class="card">
                    <div class="card-header">
                        <h3>Category List</h3>
                    </div>
                    @if (session('soft_delete'))
                    <div class="alert alert-success">{{ session('soft_delete') }}</div>
                    @endif
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('category.create') }}" class="btn btn-primary mr-3">Add New Category</a>
                    </div>
                    @if (session('category_c'))
                        <div class="alert alert-success">{{ session('category_c') }}</div>
                    @endif
                    @if (session('category_update'))
                        <div class="alert alert-success">{{ session('category_update') }}</div>
                    @endif
                    @if (session('check_trash'))
                        <div class="alert alert-success">{{ session('check_trash') }}</div>
                    @endif
                    <div class="card-body">
                        <table class="table table-bordered">

                                <tr>
                                    <th>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                               <input type="checkbox" id="chkSelectAll" class="form-check-input">
                                                Check All
                                                <i class="input-frame"></i>
                                            </label>
                                        </div>
                                    </th>
                                    <th>SL</th>
                                    <th>Category Name</th>
                                    <th>Category Icon</th>
                                    <th>Action</th>
                                </tr>
                        @foreach ($categories as $key =>$category)
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="checkbox" name="category_id[]" class="form-check-input chkDel" value="{{ $category->id }}">
                                              <i class="input-frame"></i>
                                            </label>
                                        </div>
                                    </td>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $category->category_name }}</td>
                                    <td>
                                        <img src="{{ asset('uploads/category') }}/{{ $category->icon }}" alt="">
                                    </td>
                                    <td class="d-flex">
                                        <a href="{{ route('category.edit',$category->id) }}" class="btn btn-warning mr-1"><i class="fa fa-pencil"></i></a>

                                        <a href="{{ route('category.soft.delete',$category->id) }}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                        @endforeach
                        </table >
                    <div class="mt-3 d-flex justify-content-end">
                            {{ $categories->links() }}
                    </div>
                    <div class="bt-2">
                        <button class="btn btn-danger">Delete Checked</button>
                    </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
@endsection

@section('footer_script')
    <script>
        $("#chkSelectAll").on('click', function(){
            this.checked ? $(".chkDel").prop("checked",true) : $(".chkDel").prop("checked",false);
        })
    </script>
@endsection
