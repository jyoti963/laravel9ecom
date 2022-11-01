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
        // dd($categories);

        return view('admin.category.index')->with(compact('categories'));
    }

    public function addEditCategory(Request $request , $id=null)
    {
        if($id === "")
        {
          //Add Category Functionality
          $title = "Add Category";
          $category = new Category;
          $getcategories = array();
          $btn = "Add";
          $message = "Category Added Successfully!!";
        }else{
            //Edit Category Functionality
            // dd($id);
           $title = "Edit Category";
           $category = Category::find($id);
            // dd($category['section_id']);
           $btn = "Update";
           $getcategories = Category::with('subcategories')->where(['parent_id'=>0,'section_id'=>$category['section_id']])->get();
        //    dd($getcategories);
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

            return redirect('admin/category')->with('msg', $message);

        }
      $getSections = Section::get()->toArray();
      return view('admin.category.add-edit-category')->with(compact('getSections','category','getcategories','title','btn'));
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

    public function appendCategoryLevel(Request $request){
        if ($request->ajax()) {
            $data = $request->all();
            $getcategories = Category::with('subcategories')->where(['parent_id'=>0,'section_id'=>$data['section_id']])->get()->toArray();
            return view('admin.category.append-category-level')->with(compact('getcategories'));

        }
    }

    public function deleteCategory($id)
    {
        Category::where('id',$id)->delete();

         $msg = "Category Deleted Successfully!!";

         return redirect()->back()->with('delete',$msg);
    }
}
