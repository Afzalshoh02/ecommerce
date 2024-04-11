<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubCategoryController extends Controller
{
    public function list()
    {
        $data['getRecord'] = SubCategory::getRecord();
        $data['header_title'] = "Sub Category";
        return view('admin.subcategory.list', $data);
    }
    public function add()
    {
        $data['getCategory'] = Category::getRecord();
        $data['header_title'] = "Add New Sub Category";
        return view('admin.subcategory.add', $data);
    }
    public function insert(Request $request)
    {
        request()->validate([
            'slug' => 'required|unique:categories,slug',
        ]);
        $sub_category = new SubCategory();
        $sub_category->category_id = trim($request->category_id);
        $sub_category->name = trim($request->name);
        $sub_category->slug = trim($request->slug);
        $sub_category->status = trim($request->status);
        $sub_category->meta_title = trim($request->meta_title);
        $sub_category->meta_description = trim($request->meta_description);
        $sub_category->meta_keywords = trim($request->meta_keywords);
        $sub_category->created_by = Auth::user()->id;
        $sub_category->save();
        return redirect('admin/sub_category/list')->with('success', 'Sub Category added successfully!');
    }
    public function edit($id)
    {
        $data['getCategory'] = Category::getRecord();
        $data['getRecord'] = SubCategory::getSingle($id);
        $data['header_title'] = "Edit Sub Category";
        return view('admin.subcategory.edit', $data);
    }
    public function update(Request $request, $id)
    {
        request()->validate([
            'slug' => 'required|unique:categories,slug,' . $id,
        ]);
        $sub_category = SubCategory::getSingle($id);
        $sub_category->category_id = trim($request->category_id);
        $sub_category->name = trim($request->name);
        $sub_category->slug = trim($request->slug);
        $sub_category->status = trim($request->status);
        $sub_category->meta_title = trim($request->meta_title);
        $sub_category->meta_description = trim($request->meta_description);
        $sub_category->meta_keywords = trim($request->meta_keywords);
        $sub_category->save();
        return redirect('admin/sub_category/list')->with('success', 'Sub Category updated successfully!');
    }
    public function delete($id)
    {
        $category = SubCategory::getSingle($id);
        $category->is_delete = 1;
        $category->save();
        return redirect('admin/sub_category/list')->with('success', 'Sub Category deleted successfully!');
    }
}
