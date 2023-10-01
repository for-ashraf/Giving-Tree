@extends('layouts.master')


@section('content')
    <div class="card border-0 shadow-sm">
        <div class="card-header">
            <h6 class="card-title">Add New Campaign</h6>
        </div>
        <form role="form" method="post" action="{{ route('admin.campaigns.store') }}" enctype="multipart/form-data">
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
                    <label for="start_date">Start Date</label>
                    <input type="date" class="form-control @error('start_date') is-invalid @enderror"
                           name="start_date" value="{{ old('start_date') }}" id="start_date">
                    @error('start_date')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="end_date">End Date</label>
                    <input type="date" class="form-control @error('end_date') is-invalid @enderror"
                           name="end_date" value="{{ old('end_date') }}" id="end_date">
                    @error('end_date')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="is_money_involved">Is Money Involved</label>
                    <select class="form-control" name="is_money_involved" id="is_money_involved">
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="target_amount">Target Amount</label>
                    <input type="number" step="0.01" class="form-control @error('target_amount') is-invalid @enderror"
                           name="target_amount" value="{{ old('target_amount') }}" id="target_amount">
                    @error('target_amount')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="current_amount">Current Amount</label>
                    <input type="number" step="0.01" class="form-control @error('current_amount') is-invalid @enderror"
                           name="current_amount" value="{{ old('current_amount') }}" id="current_amount">
                    @error('current_amount')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="campaign_status">Campaign Status</label>
                    <select class="form-control" name="campaign_status" id="campaign_status">
                        <option value="Active">Active</option>
                        <option value="Closed">Closed</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="donor_instructions">Participation Instructions</label>
                    <input type="text" class="form-control @error('donor_instructions') is-invalid @enderror"
                           name="donor_instructions" value="{{ old('donor_instructions') }}" id="donor_instructions" placeholder="Enter Instructions for the participants">
                    @error('donor_instructions')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="campaign_type">Campaign Type</label>
                    <input type="text" class="form-control @error('campaign_type') is-invalid @enderror"
                           name="campaign_type" value="{{ old('campaign_type') }}" id="campaign_type" placeholder="Enter campaign type">
                    @error('campaign_type')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="organizer">Organizer</label>
                    <input type="text" class="form-control @error('organizer') is-invalid @enderror"
                           name="organizer" value="{{ old('organizer') }}" id="organizer" placeholder="Enter organizer name">
                    @error('organizer')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="contact_person">Contact Person</label>
                    <input type="text" class="form-control @error('contact_person') is-invalid @enderror"
                           name="contact_person" value="{{ old('contact_person') }}" id="contact_person" placeholder="Enter contact person">
                    @error('contact_person')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="contact_email">Contact Email</label>
                    <input type="email" class="form-control @error('contact_email') is-invalid @enderror"
                           name="contact_email" value="{{ old('contact_email') }}" id="contact_email" placeholder="Enter contact email">
                    @error('contact_email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="contact_phone">Contact Phone</label>
                    <input type="text" class="form-control @error('contact_phone') is-invalid @enderror"
                           name="contact_phone" value="{{ old('contact_phone') }}" id="contact_phone" placeholder="Enter contact phone">
                    @error('contact_phone')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="volunteer_opportunities">Volunteer Opportunities</label>
                    <textarea class="form-control @error('volunteer_opportunities') is-invalid @enderror"
                              name="volunteer_opportunities" id="volunteer_opportunities" rows="3">{{ old('volunteer_opportunities') }}</textarea>
                    @error('volunteer_opportunities')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="campaign_address">Campaign Address</label>
                    <input type="text" class="form-control @error('campaign_address') is-invalid @enderror"
                           name="campaign_address" value="{{ old('campaign_address') }}" id="campaign_address" placeholder="Enter campaign address">
                    @error('campaign_address')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="campaign_image" class="form-label">Upload Campaign Image (Max 2MB, JPG only)</label>
                    <input type="file" class="form-control" id="campaign_image" name="campaign_image" accept=".jpg">
                    <div id="imagePreview" class="mt-2 d-flex flex-wrap"></div>
                    <div id="imageError" class="text-danger mt-2"></div>
                </div>

                <div class="form-group" id="imagePreview" style="display: none;">
                    <label>Campaign Image Preview:</label>
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