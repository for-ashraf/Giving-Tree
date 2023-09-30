<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(Gate::denies('category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categories = Category::paginate();

        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        abort_if(Gate::denies('category_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('admin.categories.create', ['categories' => $categories]);
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        abort_if(Gate::denies('category_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'category_description' => 'nullable|string',
            'category_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'parent_category_id' => 'nullable|integer',
        ]);

        $category = new Category();
        $category->title = $validatedData['title'];
        $category->category_description = $validatedData['category_description'];
        $category->parent_category_id = $validatedData['parent_category_id'];
        $category_image = $validatedData['category_image'];
        if ($category->parent_category_id=='None')
            $category->parent_category_id='';

        $category->save();
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
        // Handle category_image file upload here if needed
        return redirect()->route('admin.categories.index')->with('message', 'Category added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Category $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $categories = Category::all();
        abort_if(Gate::denies('category_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.categories.edit', compact('category','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        abort_if(Gate::denies('category_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
    
        $category = Category::findOrFail($id);
    
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'category_description' => 'nullable|string',
            'category_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'parent_category_id' => 'nullable|integer',
        ]);
    
        $category->title = $validatedData['title'];
        $category->category_description = $validatedData['category_description'];
        $category->parent_category_id = $validatedData['parent_category_id'];
    
        if ($category->parent_category_id === 'None') {
            $category->parent_category_id = null;
        }
    
        // Handle category_image file upload if a new file is provided
        if ($request->hasFile('category_image')) {
            $file = $request->file('category_image');
            $fileName = $category->id . '.' . $file->getClientOriginalExtension();
    
            // Delete the old image file if it exists
            if ($category->category_image) {
                unlink(public_path('uploads/categories/' . $category->category_image));
            }
    
            $file->move('uploads/categories', $fileName);
            $category->category_image = $fileName;
        }
    
        $category->save();
    
        return redirect()->route('admin.categories.index')->with('message', 'Category updated successfully!');
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param Category $category
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Category $category)
    {
        abort_if(Gate::denies('category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
    
        // Check if there are any posts associated with this category
        $postsCount = $category->posts()->count();
    
        if ($postsCount === 0) {
            // Delete the associated category image file if it exists
            if ($category->category_image) {
                unlink(public_path('uploads/categories/' . $category->category_image));
            }
    
            $category->delete();
            return redirect()->back()->with('message', 'Category deleted successfully.');
        }
    
        return redirect()->back()->with('error', "Category is used in $postsCount post(s), you can't delete it!");
    }
    
}
