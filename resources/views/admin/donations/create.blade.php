@extends('layouts.master')

@section('content')
    <div class="card border-0 shadow-sm">
        <div class="card-header">
            <h6 class="card-title">Add New Donation</h6>
        </div>
        <form role="form" method="post" action="{{ route('admin.donations.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror"
                           name="title" value="{{ old('title') }}" id="title" placeholder="Enter title">
                    @error('title')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control @error('description') is-invalid @enderror"
                              name="description" id="description" rows="3">{{ old('description') }}</textarea>
                    @error('description')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="item_condition">Item Condition</label>
                    <select class="form-control" name="item_condition" id="item_condition"> 
                        @if (old('item_condition') == '')
                            <option value="">Select Item Condition</option>
                        @else
                            <option value="{{ old('item_condition') }}">{{ old('item_condition') }}</option>
                        @endif
                        <option value="New">New</option>
                        <option value="Used-Like New">Used-Like New</option>
                        <option value="Used-Average">Used-Average</option>
                        <option value="Used-Below Average">Used-Below Average</option>
                    </select>
                </div>
                

                <div class="form-group">
                    <label for="item_category">Category</label>
                    <select class="form-control" name="item_category" id="item_category">
                        <option value="">Select Category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->title }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group" style="display: none;" id="subCategoryWrapper">
                    <label for="sub_category">Sub-Category</label>
                    <select class="form-control" name="sub_category" id="sub_category">
                        <option value="">Select sub-Category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Upload Images (Max 30KB, JPG only)</label>
                    <input type="file" class="form-control" id="image" name="image" accept=".jpg">
                    <div id="imagePreview" class="mt-2 d-flex flex-wrap"></div>
                    <div id="imageError" class="text-danger mt-2"></div>
                </div>

                <div class="form-group" id="imagePreview" style="display: none;">
                    <label>Image Preview:</label>
                    <img id="preview" src="" alt="Image Preview" style="max-width: 200px; max-height: 200px;">
                    <button type="button" id="removeImage" class="btn btn-sm btn-danger mt-2">Remove Image</button>
                </div>

            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
    <script src="{{ asset('js/main.js') }}"></script>

@endsection
