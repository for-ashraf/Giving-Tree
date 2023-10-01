@extends('layouts.master')

@section('content')
    <div class="card border-0 shadow-sm">
        <div class="card-header">
            <h6 class="card-title">Edit Donation #{{ $donation->id }}</h6>
        </div>
        <form role="form" method="post" action="{{ route('admin.donations.update', $donation->id) }}" enctype="multipart/form-data">
            @csrf
            {{ method_field('PUT') }}
            <div class="card-body">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror"
                           name="title" value="{{ old('title', $donation->title) }}" id="title" placeholder="Enter title">
                    @error('title')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control @error('description') is-invalid @enderror"
                              name="description" id="description" rows="3">{{ old('description', $donation->description) }}</textarea>
                    @error('description')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="item_condition">Item Condition</label>
                    <select class="form-control" name="item_condition" id="item_condition">
                        <option value="New" {{ old('item_condition', $donation->item_condition) == 'New' ? 'selected' : '' }}>New</option>
                        <option value="Used-Like New" {{ old('item_condition', $donation->item_condition) == 'Used-Like New' ? 'selected' : '' }}>Used-Like New</option>
                        <option value="Used-Average" {{ old('item_condition', $donation->item_condition) == 'Used-Average' ? 'selected' : '' }}>Used-Average</option>
                        <option value="Used-Below Average" {{ old('item_condition', $donation->item_condition) == 'Used-Below Average' ? 'selected' : '' }}>Used-Below Average</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="item_category">Category</label>
                    <select class="form-control" name="item_category" id="item_category">
                        <option value="{{$donation->item_category}}">
                            {{ $categories->firstWhere('id', $donation->item_category)->title }}
                        </option>
                        @foreach($categories as $category)
                            @if($category->id != $donation->item_category)
                                <option value="{{ $category->id }}" {{ old('item_category', $donation->item_category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->title }}
                                </option>
                            @endif
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
                    <img id="preview" src="{{ asset('path_to_existing_image/' . $donation->image) }}" alt="Image Preview" style="max-width: 200px; max-height: 200px;">
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
