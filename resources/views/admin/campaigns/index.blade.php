@extends('layouts.master')

@section('content')
    <div class="card">
        <div class="card-header">
            <h6 class="card-title float-start">Campaigns List</h6>
            <div class="card-title float-end btn btn-primary btn-sm">
                <a href="{{ route('admin.campaigns.create') }}" class="text-white">Add New</a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Is Money Involved</th>
                        <th>Target Amount</th>
                        <th>Current Amount</th>
                        <th>Campaign Status</th>
                        <th>Campaign Type</th>
                        <th>Organizer</th>
                        <th>Contact Person</th>
                        <th>Contact Email</th>
                        <th>Contact Phone</th>
                        <th>Volunteer Opportunities</th>
                        <th>Campaign Address</th>
                        <th>Campaign Image</th>
                        <th>Donor Instructions</th>
                        <th>Created At</th>
                        <th style="width: 40px">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($campaigns as $campaign)
                        <tr>
                            <td>{{ $campaign->id }}</td>
                            <td>{{ $campaign->title }}</td>
                            <td>{{ $campaign->description }}</td>
                            <td>{{ $campaign->start_date }}</td>
                            <td>{{ $campaign->end_date }}</td>
                            <td>{{ $campaign->is_money_involved }}</td>
                            <td>{{ $campaign->target_amount }}</td>
                            <td>{{ $campaign->current_amount }}</td>
                            <td>{{ $campaign->campaign_status }}</td>
                            <td>{{ $campaign->campaign_type }}</td>
                            <td>{{ $campaign->organizer }}</td>
                            <td>{{ $campaign->contact_person }}</td>
                            <td>{{ $campaign->contact_email }}</td>
                            <td>{{ $campaign->contact_phone }}</td>
                            <td>{{ $campaign->volunteer_opportunities }}</td>
                            <td>{{ $campaign->campaign_address }}</td>
                            <td>
                                <img style="width: 100px; height: 100px;" src="{{ asset('uploads/campaigns/' . $campaign->campaign_image) }}" alt="Campaign Image">
                            </td>
                            <td>{{ $campaign->donor_instructions }}</td>
                            <td>
                                @if ($campaign->created_at)
                                    {{ $campaign->created_at->format('d M Y') }}
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.campaigns.edit', $campaign->id) }}">
                                    <span class="badge bg-primary">Edit</span>
                                </a>
                                <form id="delete-form-{{ $campaign->id }}" method="post"
                                      action="{{ route('admin.campaigns.destroy', $campaign->id) }}"
                                      style="display: none">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                </form>
                                <a href="javascript:void(0)" class="badge bg-danger text-white"
                                   onclick="if(confirm('Are you sure, You want to Delete this ??')) {
                                       event.preventDefault();
                                       document.getElementById('delete-form-{{ $campaign->id }}').submit();
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
