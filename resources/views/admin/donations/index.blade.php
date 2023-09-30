@extends('layouts.master')

@section('content')
    <div class="card">
        <div class="card-header">
            <h6 class="card-title float-start">Donations List</h6>
            <div class="card-title float-end btn btn-primary btn-sm">
                <a href="{{ route('admin.donations.create') }}" class="text-white">Add New</a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Title</th>
                        <th>Description</th> {{-- New field for description --}}
                        <th>Item Condition</th> {{-- New field for item_condition --}}
                        <th>Item Category</th> {{-- New field for item_category --}}
                        <th>Sub Category</th> {{-- New field for sub_category --}}
                        <th>User</th> {{-- New field for user_id --}}
                        <th>Likes Count</th> {{-- New field for likes_count --}}
                        <th>Status</th> {{-- New field for status --}}
                        <th>Views Count</th> {{-- New field for views_count --}}
                        <th>Created At</th>
                        <th style="width: 40px">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($donations as $donation)
                        <tr>
                            <td>{{ $donation->id }}</td>
                            <td>{{ $donation->title }}</td>
                            <td>{{ $donation->description }}</td> {{-- Display description --}}
                            <td>{{ $donation->item_condition }}</td> {{-- Display item_condition --}}
                            <td>{{ $donation->item_category }}</td> {{-- Display item_category --}}
                            <td>{{ $donation->sub_category }}</td> {{-- Display sub_category --}}
                            <td>{{ $donation->user_id }}</td> {{-- Display user_id --}}
                            <td>{{ $donation->likes_count }}</td> {{-- Display likes_count --}}
                            <td>{{ $donation->status }}</td> {{-- Display status --}}
                            <td>{{ $donation->views_count }}</td> {{-- Display views_count --}}
                            <td>{{ $donation->created_at->format('d M Y') }}</td>
                            <td>
                                <a href="{{ route('admin.donations.edit', $donation->id) }}">
                                    <span class="badge bg-primary">Edit</span>
                                </a>
                                <form id="delete-form-{{ $donation->id }}" method="post"
                                      action="{{ route('admin.donations.destroy', $donation->id) }}"
                                      style="display: none">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                </form>
                                <a href="javascript:void(0)" class="badge bg-danger text-white"
                                   onclick="if(confirm('Are you sure, You want to Delete this ??')) {
                                       event.preventDefault();
                                       document.getElementById('delete-form-{{ $donation->id }}').submit();
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
       
    </div>
@endsection
