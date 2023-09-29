@extends('layouts.master')

@section('content')
    <div class="card">
        <div class="card-header">
            <h6 class="card-title float-start">Category List</h6>
            <div class="card-title float-end btn btn-primary btn-sm">
                <a href="{{ route('admin.categories.create') }}" class="text-white">Add New</a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Title</th>
                        <th>Description</th> {{-- New field for category_description --}}
                        <th>Image</th> {{-- New field for category_image --}}
                        <th>Parent Category</th> {{-- New field for parent_category_id --}}
                        <th>Created At</th>
                        <th style="width: 40px">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->title }}</td>
                            <td>{{ $category->category_description }}</td> {{-- Display category_description --}}
                            <td ><img style="width: 100px;height:100px;" src="../uploads/categories/{{$category->category_image }}"></td> {{-- Display category_image --}}
                            <td>{{ $category->parent_category_id }}</td> {{-- Display parent_category_id --}}
                            <td>{{ $category->created_at->format('d M Y') }}</td>
                            <td>
                                <a href="{{ route('admin.categories.edit', $category->id) }}">
                                    <span class="badge bg-primary">Edit</span>
                                </a>
                                <form id="delete-form-{{ $category->id }}" method="post"
                                      action="{{ route('admin.categories.destroy', $category->id) }}"
                                      style="display: none">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                </form>
                                <a href="javascript:void(0)" class="badge bg-danger text-white"
                                   onclick="if(confirm('Are you sure, You want to Delete this ??')) {
                                       event.preventDefault();
                                       document.getElementById('delete-form-{{ $category->id }}').submit();
                                   }">
                                    Delete
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer clearfix">
            {{ $categories->links() }}
        </div>
    </div>
@endsection
