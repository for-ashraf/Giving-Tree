@extends('layouts.master')

@section('content')
    <div class="card border-0 shadow-sm">
        <div class="card-header">
            <h5 class="card-title">Edit Category #{{ $category->id }}</h5>
        </div>
        <form role="form" method="post" action="{{ route('admin.categories.update', $category->id) }}" enctype="multipart/form-data">
            @csrf
            {{ method_field('PUT') }}
            <div class="card-body">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror"
                           name="title" value="{{ old('title', $category->title) }}" id="title"
                           placeholder="Enter title">
                    @error('title')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="category_description">Description</label>
                    <textarea class="form-control @error('category_description') is-invalid @enderror"
                              name="category_description" id="category_description"
                              rows="3">{{ old('category_description', $category->category_description) }}</textarea>
                    @error('category_description')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="category_image">Category Image</label>
                    <input type="file" class="form-control-file @error('category_image') is-invalid @enderror"
                           name="category_image" id="category_image">
                    @error('category_image')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="parent_category_id">Parent Category</label>
                    <select class="form-control @error('parent_category_id') is-invalid @enderror"
                            name="parent_category_id" id="parent_category_id">
                        <option value="">None</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ $cat->id == old('parent_category_id', $category->parent_category_id) ? 'selected' : '' }}>
                                {{ $cat->title }}
                            </option>
                        @endforeach
                    </select>
                    @error('parent_category_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
@endsection
