<?php
namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = Categories::all();
        return view('categories.index', compact('categories'));
    }

    public function show($id)
    {
        $category = Categories::findOrFail($id);
        return view('categories.show', compact('category'));
    }

    public function create()
    {
        $categories = Categories::all();
        return view('categories.create', ['categories' => $categories]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'category_description' => 'nullable|string',
            'category_image' => 'nullable|string',
            'parent_category_id' => 'nullable|integer',
        ]);
        $category = Categories::create($validatedData);

        try {
            if ($request->hasFile('category_image')) {
                $file = $request->file('category_image');
                $fileName = $category->id . '.' . $file->getClientOriginalExtension();
                $file->move('uploads/categories', $fileName);
                $category->update(['category_image' => $fileName]);
            }
        } catch (\Exception $e) {
            Log::error('File upload failed: ' . $e->getMessage());
        }
        return redirect()->route('categories.index')->with('message', 'Category added successfully!');
    }

    public function edit($id)
    {
        $category = Categories::findOrFail($id);
        $categories = Categories::all();
        return view('categories.edit', compact('category', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $category = Categories::findOrFail($id);

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'category_description' => 'nullable|string',
            'category_image' => 'nullable|string',
            'parent_category_id' => 'nullable|integer',
        ]);

        if ($request->hasFile('category_image')) {
            $file = $request->file('category_image');
            if ($category->category_image) {
                unlink(public_path('uploads/categories/' . $category->category_image));
            }
            $fileName = $category->category_id . '.' . $file->getClientOriginalExtension();
            $file->move('uploads/categories', $fileName);
            $validatedData['category_image'] = $fileName;
        }

        $category->update($validatedData);
        return redirect()->route('categories.index')->with('success', 'Category updated successfully!');
    }

    public function destroy($id)
    {
        $category = Categories::findOrFail($id);
        if ($category->category_image) {
            unlink(public_path('uploads/categories/' . $category->category_image));
        }
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully!');
    }
}
