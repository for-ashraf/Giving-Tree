<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CampaignController extends Controller
{
    public function index()
    {
        $campaigns = Campaign::all();
        return view('admin.campaigns.index', compact('campaigns'));
    }

    public function create()
    {
        return view('admin.campaigns.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'is_money_involved' => 'required|in:Yes,No',
            'target_amount' => 'required|numeric',
            'current_amount' => 'required|numeric',
            'campaign_status' => 'required|in:Active,Closed',
            'campaign_type' => 'required|string|max:70',
            'organizer' => 'required|string|max:150',
            'contact_person' => 'required|string|max:100',
            'contact_email' => 'required|email|max:255',
            'contact_phone' => 'required|string|max:20',
            'volunteer_opportunities' => 'nullable|string',
            'campaign_address' => 'nullable|string|max:250',
            'campaign_image' => 'nullable|image|mimes:jpg|max:2048',
            'donor_instructions' => 'nullable|string',
        ]);

        $user_id = auth()->user()->id;

        // Add the user_id to the validated data
        $validatedData['user_id'] = $user_id;
        
        $campaign = Campaign::create($validatedData);

        try {
            if ($request->hasFile('campaign_image')) {
                $file = $request->file('campaign_image');
                $fileName = $campaign->id . '.' . $file->getClientOriginalExtension();
                $file->move('uploads/campaigns', $fileName);
                $campaign->update(['campaign_image' => $fileName]);
            }
        } catch (\Exception $e) {
            Log::error('File upload failed: ' . $e->getMessage());
        }

        return redirect()->route('admin.campaigns.index')->with('success', 'Campaign added successfully!');
    }

    public function edit($id)
    {
        $campaign = Campaign::findOrFail($id);
        return view('admin.campaigns.edit', compact('campaign'));
    }

    public function update(Request $request, Campaign $campaign)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'is_money_involved' => 'required|in:Yes,No',
            'target_amount' => 'required|numeric',
            'current_amount' => 'required|numeric',
            'campaign_status' => 'required|in:Active,Closed',
            'campaign_type' => 'required|string|max:70',
            'organizer' => 'required|string|max:150',
            'contact_person' => 'required|string|max:100',
            'contact_email' => 'required|email|max:255',
            'contact_phone' => 'required|string|max:20',
            'volunteer_opportunities' => 'nullable|string',
            'campaign_address' => 'nullable|string|max:250',
            'campaign_image' => 'nullable|image|mimes:jpg|max:2048',
            'donor_instructions' => 'nullable|string',
        ]);

        $campaign->update($validatedData);

        try {
            if ($request->hasFile('campaign_image')) {
                $file = $request->file('campaign_image');
                $fileName = $campaign->id . '.' . $file->getClientOriginalExtension();
                $file->move('uploads/campaigns', $fileName);
                $campaign->update(['campaign_image' => $fileName]);
            }
        } catch (\Exception $e) {
            Log::error('File upload failed: ' . $e->getMessage());
        }

        return redirect()->route('admin.campaigns.index')->with('success', 'Campaign updated successfully!');
    }

    public function destroy($id)
    {
        $campaign = Campaign::findOrFail($id);

        if ($campaign->campaign_image) {
            unlink(public_path('uploads/campaigns/' . $campaign->campaign_image));
        }

        $campaign->delete();

        return redirect()->route('admin.campaigns.index')->with('success', 'Campaign deleted successfully!');
    }
}
