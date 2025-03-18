@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-lg-8">
            <form action="{{ route('checked.category.restore') }}" method="POST">
                @csrf

            <div class="card">
                <div class="card-header">
                    <h3>Category Trash List</h3>
                </div>
                @if (session('restore'))
                    <div class="alert alert-success">{{ session('restore') }}</div>
                @endif

                @if (session('permanent_delete'))
                    <div class="alert alert-success">{{ session('permanent_delete') }}</div>
                @endif

                @if (session('check_restore'))
                    <div class="alert alert-success">{{ session('check_restore') }}</div>
                @endif
                <div class="d-flex justify-content-end">
                    <a href="{{ route('category.list') }}" class="btn btn-primary mr-3">Back To Category List</a>
                </div>

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
                    @forelse ($categories as $key =>$category)
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
                                    <a title="Restore" href="{{ route('category.restore',$category->id) }}" class="btn btn-primary mr-1"><i data-feather="rotate-cw"></i></a>

                                    <a title="Restore" href="{{ route('category.permanent.delete',$category->id) }}" class="btn btn-danger"><i data-feather="trash"></i></a>
                                </td>
                            </tr>
                    @empty
                     <tr>
                        <td colspan="4"><h3 class="text-center text-info">No Trash Category Found</h3></td>
                     </tr>
                    @endforelse
                    </table >
                   <div class="mt-3">
                        <button type="submit" class="btn btn-primary">Checked Restore</button>
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

