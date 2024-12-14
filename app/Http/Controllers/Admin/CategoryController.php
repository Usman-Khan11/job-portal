<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $data['page_title'] = "Categories";

        if ($request->ajax()) {
            $query = Category::Query();
            $query = $query->latest()->get();
            return DataTables::of($query)->addIndexColumn()->make(true);
        }

        return view('admin.category.index', $data);
    }

    public function create()
    {
        $data['page_title'] = "Add New Category";
        return view('admin.category.create', $data);
    }

    public function edit($id)
    {
        $data['page_title'] = "Edit Category";
        $data['category'] = Category::where("id", $id)->first();
        return view('admin.category.edit', $data);
    }

    public function delete($id)
    {
        $category = Category::find($id);
        if ($category) {
            // deleteImage($category->image);
            $category->delete();
            return back()->withSuccess('Category deleted successfully.');
        }

        return back()->withError('Something went wrong.');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:1048'
        ]);

        $category = new Category();
        $category->name = $request->name;
        $category->description = $request->description;

        if ($request->hasFile('image')) {
            $category->image = uploadFile($request->file('image'), 'assets/img/uploads');
        }

        if ($category->save()) {
            return redirect()->route('admin.category')->withSuccess('Category added successfully.');
        }

        return back()->withError('Something went wrong.');
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:1048'
        ]);

        $category = Category::find($request->id);
        $category->name = $request->name;
        $category->description = $request->description;

        if ($request->hasFile('image')) {
            $category->image = uploadFile($request->file('image'), 'assets/img/uploads', $category->image);
        }

        if ($category->save()) {
            return redirect()->route('admin.category')->withSuccess('Category updated successfully.');
        }

        return back()->withError('Something went wrong.');
    }
}
