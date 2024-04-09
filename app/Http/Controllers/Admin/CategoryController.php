<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function list()
    {
        $data['getRecord'] = Category::getRecord();
        $data['header_title'] = "Category";
        return view('admin.category.list', $data);
    }

    public function add()
    {
        $data['header_title'] = "Add New Category";
        return view('admin.category.add', $data);
    }

    public function insert(Request $request)
    {
        request()->validate([
           'slug' => 'required|unique:categories,slug',
        ]);
        $category = new Category();
        $category->name = trim($request->name);
        $category->slug = trim($request->slug);
        $category->status = trim($request->status);
        $category->meta_title = trim($request->meta_title);
        $category->meta_description = trim($request->meta_description);
        $category->meta_keywords = trim($request->meta_keywords);
        $category->created_by = Auth::user()->id;
        $category->save();
        return redirect('admin/category/list')->with('success', 'Category added successfully!');
    }

    public function edit($id)
    {
        $data['getRecord'] = Category::getSingle($id);
        $data['header_title'] = "Edit Category";
        return view('admin.category.edit', $data);
    }

    public function update(Request $request, $id)
    {
        request()->validate([
            'slug' => 'required|unique:categories,slug,' . $id,
        ]);
        $category = Category::getSingle($id);
        $category->name = trim($request->name);
        $category->slug = trim($request->slug);
        $category->status = trim($request->status);
        $category->meta_title = trim($request->meta_title);
        $category->meta_description = trim($request->meta_description);
        $category->meta_keywords = trim($request->meta_keywords);
        $category->save();
        return redirect('admin/category/list')->with('success', 'Category updated successfully!');
    }

    public function delete($id)
    {
        $category = Category::getSingle($id);
        $category->is_delete = 1;
        $category->save();
        return redirect('admin/category/list')->with('success', 'Category deleted successfully!');
    }
}
