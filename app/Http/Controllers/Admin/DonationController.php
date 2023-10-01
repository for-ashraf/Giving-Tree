<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Donations;

use Illuminate\Http\Request;


class DonationController extends Controller
{
    public function loadCategories()
    {
        return Category::all();
    }
    public function index()
    {
        $donations = Donations::all();
        $categories = Category::all();
        return view('admin.donations.index', compact('categories','donations'));
    }

    public function create()
    {
        $categories = $this->loadCategories();
        return view('admin.donations.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'item_condition' => 'nullable|string|max:50',
            'item_category' => 'nullable|string|max:50',
            'user_id' => 'nullable|numeric|unsigned',
            'image' => 'nullable|image|mimes:jpg|max:2048',
            'status' => 'nullable|in:active,completed,deactivated',
            'item_category_id' => 'nullable|numeric|unsigned',
         
        ]);

        $donation = Donations::create($validatedData);
    
        try {
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $fileName = $donation->id . '.' . $file->getClientOriginalExtension();
                $file->move('uploads/donations', $fileName);
                $donation->update(['image' => $fileName]);
            }
        } catch (\Exception $e) {
            Log::error('File upload failed: ' . $e->getMessage());
        }
        // Handle category_image file upload here if needed
     
        return redirect()->route('admin.donations.index')->with('success', 'Donation added successfully!');
    }

    public function edit($id)
    {
        $donation = Donations::findOrFail($id);
        $categories = $this->loadCategories();

        return view('admin.donations.edit', compact('donation', 'categories'));
    }
    public function update(Request $request, Donations $donation)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'item_condition' => 'nullable|string|max:50',
            'item_category' => 'nullable|string|max:50',
            'user_id' => 'nullable|numeric|unsigned',
            'image' => 'nullable|image|mimes:jpg|max:2048',
            'status' => 'nullable|in:active,completed,deactivated',
            'item_category_id' => 'nullable|numeric|unsigned',
        ]);
    
        $donation->update($validatedData);
    
        try {
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $fileName = $donation->id . '.' . $file->getClientOriginalExtension();
                $file->move('uploads/donations', $fileName);
                $donation->update(['image' => $fileName]);
            }
        } catch (\Exception $e) {
            Log::error('File upload failed: ' . $e->getMessage());
        }
    
        return redirect()->route('admin.donations.index')->with('success', 'Donation updated successfully!');
    }

    public function destroy($id)
    {
           $donation = Donations::findOrFail($id);
     
            if ($donation->image) {
                unlink(public_path('uploads/donations/' . $donation->image));
            }
    
        $donation->delete();

        return redirect()->route('admin.donations.index')->with('success', 'Donation deleted successfully!');
    }
}