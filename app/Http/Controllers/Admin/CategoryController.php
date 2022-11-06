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

        return view('admin.category.index',compact('categories'))->with('no', 1);
    }

    public function addEditCategory(Request $request , $id=null)
    {
        if($id==""){
            // Add Category Functionality
            $title = "Add Category";
            $category = new Category;
            $getCategories = array();
            $btn = "Add";
            $message = "Category added successfully!";
        }else{
            // Edit Category Functionality
            $title = "Edit Category";
            $category = Category::find($id);
            $btn = "Update";
            // echo "<pre>"; print_r($category['category_name']); die;/
            $getCategories = Category::with('subcategories')->where(['parent_id'=>0,'section_id'=>$category['section_id']])->get();
            $message = "Category updated successfully!";
        }

        if($request->isMethod('post')){
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;/

            $rules = [
                'category_name' => 'required|regex:/^[\pL\s\-]+$/u',
                'section_id' => 'required',
                'url' => 'required',
            ];

            $customMessages = [
                'category_name.required' => 'Category Name is required',
                'category_name.regex' => 'Valid Category Name is required',
                'section_id.required' => 'Section is required',
                'url.required' => 'Category URL is required',
            ];

            $this->validate($request,$rules,$customMessages);

            // Upload Category Image
            if($request->hasFile('category_images')){
                $image_tmp = $request->file('category_images');
                if($image_tmp->isValid()){
                    // Get Image Extension
                    $extension = $image_tmp->getClientOriginalExtension();
                    // Generate New Image Name
                    $imageName = rand(111,99999).'.'.$extension;
                    $imagePath = 'admin/image/category_image/'.$imageName;
                    // Upload the Image
                    Image::make($image_tmp)->save($imagePath);
                    $category->category_image = $imageName;
                }
            }else{
                $category->category_image = "";
            }

            $category->section_id = $data['section_id'];
            $category->parent_id = $data['parent_id'];
            $category->category_name = $data['category_name'];
            $category->category_discount = $data['category_discount'];
            $category->description = $data['description'];
            $category->url = $data['url'];
            $category->meta_title = $data['meta_title'];
            $category->meta_description = $data['meta_description'];
            $category->meta_keywords = $data['meta_keywords'];
            $category->status = 1;
            $category->save();

            return redirect('admin/category')->with('success',$message);

        }

        // Get All Sections
        $getSections = Section::get()->toArray();

        return view('admin.category.add-edit-category')->with(compact('title','category','getSections','getCategories','btn'));
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
