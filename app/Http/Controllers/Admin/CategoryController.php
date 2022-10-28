<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Section;
use Illuminate\Http\Request;
use Session;
use Image;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::with(['section','parentCategory'])->get()->toArray();

        return view('admin.category.index')->with(compact('categories'));
    }

    public function addEditCategory(Request $request , $id=null)
    {
        if($id=="")
        {
          //Add Category Functionality
          $title = "Add Category";
          $category = new Category;
          $getcategories = array();
          $message = "Category Added Successfully!!";
        }else{
            //Edit Category Functionality
            $title = "Edit Category";
           $category = Category::find($id);
           $getcategories = Category::where(['parent_id'=>0,'section_id'=>$category['section_id']])->get();
           $message = "Category Updated Successfully!!";
        }

        if ($request->isMethod('post')) {

           $data = $request->all();
           $rules = [
            'category_name' => 'required|regex:/^[\pL\s\-]+$/u',
            'category_discount' => 'required|numeric',
            'parent_id' => 'required',
            'section_id' => 'required',
            'url' => 'required',
            'meta_title' => 'required',
            'meta_description' => 'required',
            'meta_keywords' => 'required',
            'description' => 'required',
            'category_images' =>'required'
        ];

        $customMsg = [
            'section_id.required' => 'The section field is required',
            'category_images.required' => 'The category image is required',
        ];

        $this->validate($request, $rules, $customMsg);
        //    dd($data);
           if ($request->hasFile('category_images')) {
            $image_tmp = $request->file('category_images');
            if ($image_tmp->isValid()) {
                $extension = $image_tmp->getClientOriginalExtension();
                $imageName = rand(111, 99999) . '.' . $extension;
                $imagePath = 'admin/image/category_image/' . $imageName;
                Image::make($image_tmp)->save($imagePath);
                $category->category_image = $imageName;
            }
        }else {
            $category->category_image = "";
        }
            $category->parent_id = $data['parent_id'];
            $category->section_id = $data['section_id'];
            $category->category_name = $data['category_name'];
            $category->category_discount = $data['category_discount'];
            $category->url = $data['url'];
            $category->meta_title = $data['meta_title'];
            $category->meta_description = $data['meta_description'];
            $category->meta_keywords = $data['meta_keywords'];
            $category->section_id = $data['section_id'];
            $category->description = $data['description'];
            $category->save();

            return redirect('admin/category')->with('msg','Category Added Successfully!!');

        }
      $getSections = Section::get()->toArray();
      return view('admin.category.add-edit-category')->with(compact('getSections','category','getcategories','title'));
    }

    public function edit(Request $request,$id){
        $category = Category::where('id',$id)->first();
        // dd($category);
        if ($request->isMethod('post')) {

           $data = $request->all();
           $rules = [
            'category_name' => 'required|regex:/^[\pL\s\-]+$/u',
            'category_discount' => 'required|numeric',
            'parent_id' => 'required',
            'section_id' => 'required',
            'url' => 'required',
            'meta_title' => 'required',
            'meta_description' => 'required',
            'meta_keywords' => 'required',
            'description' => 'required',
            'category_images' =>'required'
        ];

        $customMsg = [
            'section_id.required' => 'The section field is required',
            'category_images.required' => 'The category image is required',
        ];

        $this->validate($request, $rules, $customMsg);
        //    dd($data);
           if ($request->hasFile('category_images')) {
            $image_tmp = $request->file('category_images');
            if ($image_tmp->isValid()) {
                $extension = $image_tmp->getClientOriginalExtension();
                $imageName = rand(111, 99999) . '.' . $extension;
                $imagePath = 'admin/image/category_image/' . $imageName;
                Image::make($image_tmp)->save($imagePath);
                $category->category_image = $imageName;
            }
        }else {
            $category->category_image = "";
        }
            $category->parent_id = $data['parent_id'];
            $category->section_id = $data['section_id'];
            $category->category_name = $data['category_name'];
            $category->category_discount = $data['category_discount'];
            $category->url = $data['url'];
            $category->meta_title = $data['meta_title'];
            $category->meta_description = $data['meta_description'];
            $category->meta_keywords = $data['meta_keywords'];
            $category->section_id = $data['section_id'];
            $category->description = $data['description'];
            $category->save();

            return redirect('admin/category')->with('msg','Category Updated Successfully!!');

        }
      $getSections = Section::get()->toArray();
      return view('admin.category.edit-category')->with(compact('getSections','category'));

    }

    public function updateCategoryStatus(Request $request)
    {
        if($request->ajax()){
            $data = $request->all();
            //  print_r($data);die();
            if($data['status'] == 'Active'){
                $status = 0;
            }else{
                $status = 1;
            }

            Category::where('id',$data['category_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status,'category_id'=>$data['category_id']]);
        }
    }
}
