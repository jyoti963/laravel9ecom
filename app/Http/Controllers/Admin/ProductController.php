<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Section;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        $products = Product::with(['section','category'])->get()->toArray();
        // dd($categories);

        return view('admin.product.index',compact('products'))->with('no', 1);
    }

    public function addEditProduct(Request $request , $id=null)
    {
        if ($id=="") {
           $title = "Add Product";
           $btn = "Add";
           $message = "Product added successfully!";
           $product = new Product;
        }else{
            $title = "Edit Product";
            $btn = "Update";
            $message = "Product added successfully!";
        }

        if($request->isMethod('post'))
        {
           $data = $request->all();
        //    dd($data);

        $rules = [
            'category_id' => 'required',
            'brand_id' => 'required',
            'product_name' => 'required|regex:/^[\pL\s\-]+$/u',
            'product_code' => 'required|regex:/^[\pL\s\-]+$/u',
            'product_color' => 'required|regex:/^[\pL\s\-]+$/u',
            'product_price' => 'required|numeric',
            'product_discount' => 'required|numeric',
            'product_weight' => 'required|numeric',
            'product_image' => 'required',
            'product_video' => 'required',
            'product_description' => 'required',
            'meta_title' => 'required',
            'meta_description' => 'required',
            'meta_keywords' => 'required',
            'is_featured' => 'required',
        ];

        $customMessages = [
            'category_id.required' => 'Please Select the Category',
            'brand_id.required' => 'Please Select the Brand',
            'product_name.required' => 'Product Name is required',
            'product_name.regex' => 'Please Enter Valid Product Name',
            'product_code.required' => 'Product Code is required',
            'product_code.regex' => 'Product Code is must be Alphanumeric',
            'product_color.required' => 'Product Color is required',
            'product_color.regex' => 'Product Color is must be an Alphanumeric',
            'product_price.required' => 'Product Price is required',
            'product_price.numeric' => 'Product Price is must be numeric',
            'product_discount.required' => 'Product Discount is required',
            'product_discount.numeric' => 'Product Discount is must be numeric',
            'product_weight.required' => 'Product Weight is required',
            'product_weight.numeric' => 'Product Weight is must be numeric',
            'product_image.required' => 'Please Select an Image',
            'product_video.required' => 'Please Select a Video',
            'is_featured.required' => 'Please check a box',
        ];

        $this->validate($request,$rules,$customMessages);
        }

        //Save Product details in Product table


        //Get Section For Category and SubCategory
        $categories = Section::with('categories')->get()->toArray();

        //Get All Brand
        $brands = Brand::where('status','=',1)->select('id','name')->get()->toArray();

        return view('admin.product.add-edit-product',compact('title','btn','message','categories','brands'));
    }

    public function updateProductStatus(Request $request)
    {
        if($request->ajax()){
            $data = $request->all();
            //  print_r($data);die();
            if($data['status'] == 'Active'){
                $status = 0;
            }else{
                $status = 1;
            }

            Product::where('id',$data['product_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status,'product_id'=>$data['product_id']]);
        }
    }

    public function destroy($id)
    {
        Product::where('id',$id)->delete();

         $msg = "Product Deleted Successfully!!";

         return redirect()->back()->with('delete',$msg);
    }
}
