<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Donations;
use App\Models\SubCategories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DonationsController extends Controller
{
    public function loadCategories()
    {
        return Categories::all();
    }

    public function loadSubcategories(Request $request)
    {
        $category = $request->input('category');
        $subcategories = SubCategories::where('category_id', $category)->get();
        return response()->json($subcategories);
    }

    public function create()
    {
        $categories = $this->loadCategories();
        return view('donations.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'item_condition' => 'nullable|string|max:50',
            'item_category' => 'nullable|string|max:50',
            'sub_category' => 'nullable|string|max:50',
            'user_id' => 'nullable|numeric|unsigned',
            'likes_count' => 'nullable|integer',
            'status' => 'nullable|in:active,completed,deactivated',
            'views_count' => 'nullable|integer',
            'item_category_id' => 'nullable|numeric|unsigned',
            'sub_category_id' => 'nullable|integer',
        ]);

        $donation = Donations::create($validatedData);

        return redirect()->route('donations.index')->with('success', 'Donation added successfully!');
    }

    public function edit($id)
    {
        $donation = Donations::findOrFail($id);
        $categories = $this->loadCategories();
        $subcategories = SubCategories::where('category_id', $donation->item_category_id)->get();

        return view('donations.edit', compact('donation', 'categories', 'subcategories'));
    }

    public function update(Request $request, $id)
    {
        $donation = Donations::findOrFail($id);

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'item_condition' => 'nullable|string|max:50',
            'item_category' => 'nullable|string|max:50',
            'sub_category' => 'nullable|string|max:50',
            'user_id' => 'nullable|numeric|unsigned',
            'likes_count' => 'nullable|integer',
            'status' => 'nullable|in:active,completed,deactivated',
            'views_count' => 'nullable|integer',
            'item_category_id' => 'nullable|numeric|unsigned',
            'sub_category_id' => 'nullable|integer',
        ]);

        $donation->update($validatedData);

        return redirect()->route('donations.index')->with('success', 'Donation updated successfully!');
    }

    public function destroy($id)
    {
        $donation = Donations::findOrFail($id);
        $donation->delete();

        return redirect()->route('donations.index')->with('success', 'Donation deleted successfully!');
    }
}