<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Image;

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
            $product =Product::find($id);
            // dd($product);
            $message = "Product Updated successfully!";
        }

        if($request->isMethod('post'))
        {
           $data = $request->all();
           //dd(Auth::guard('admin')->user());

            $rules = [
                'category_id' => 'required',
                'brand_id' => 'required',
                'product_name' => 'required|regex:/^[\pL\s\-]+$/u',
                'product_code' => 'required|regex:/^[\pL\s\-]+$/u',
                'product_color' => 'required|regex:/^[\pL\s\-]+$/u',
                'product_price' => 'required|numeric',
                'product_discount' => 'required|numeric',
                'product_weight' => 'required|numeric',
                'product_description' => 'required',
                'meta_title' => 'required',
                'meta_description' => 'required',
                'meta_keyword' => 'required',
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

            //Upload Image after resize
            if($request->hasFile('product_image')){
                $image_tmp = $request->file('product_image');
                if($image_tmp->isValid()){
                    //Upload Image after resize

                    // Get Image Extension
                    $extension = $image_tmp->getClientOriginalExtension();
                    // Generate New Image Name
                    $imageName = rand(111,99999).'.'.$extension;
                    $largeImagePath = 'admin/image/product_images/large/'.$imageName;
                    $mediumImagePath = 'admin/image/product_images/medium/'.$imageName;
                    $smallImagePath = 'admin/image/product_images/small/'.$imageName;
                    // Upload the Image
                    Image::make($image_tmp)->resize(1000,1000)->save($largeImagePath);
                    Image::make($image_tmp)->resize(500,500)->save($mediumImagePath);
                    Image::make($image_tmp)->resize(250,250)->save($smallImagePath);
                    $product->product_image = $imageName;
                }
            }

            //Upload Video after resize
            if($request->hasFile('product_video')){
                $video_tmp = $request->file('product_video');
                if($video_tmp->isValid()){
                    //Upload Image after resize
                    $video_name = $video_tmp->getClientOriginalName();
                    // Get Image Extension
                    $extension = $video_tmp->getClientOriginalExtension();
                    // Generate New Image Name
                    $videoName = $video_name.'-'.rand().'.'.$extension;
                    $videoPath = 'admin/videos/product_videos/';
                    $video_tmp->move($videoPath,$videoName);

                    //Insert video name in product table
                    $product->product_video = $videoName;

                }
            }

            //Save Product details in Product table
            $categoryDetails = Category::find($data['category_id']);
            $product->section_id = $categoryDetails['section_id'];
            $product->category_id = $data['category_id'];
            $product->brand_id = $data['brand_id'];

            $adminType = Auth::guard('admin')->user()->type;
            $vendor_id = Auth::guard('admin')->user()->vendor_id;
            $admin_id = Auth::guard('admin')->user()->id;

            $product->admin_type = $adminType;
            $product->admin_id = $admin_id;
            if ($adminType == 'vendor') {
                $product->vendor_id = $vendor_id;
            }else{
                $product->vendor_id = 0;
            }

            $product->product_name = $data['product_name'];
            $product->product_code = $data['product_code'];
            $product->product_color = $data['product_color'];
            $product->product_price = $data['product_price'];
            $product->product_discount = $data['product_discount'];
            $product->product_weight = $data['product_weight'];
            $product->product_description = $data['product_description'];
            $product->meta_title = $data['meta_title'];
            $product->meta_description = $data['meta_description'];
            $product->meta_keyword = $data['meta_keyword'];

            if (!empty($data['is_featured'])) {
                $product->is_featured = $data['is_featured'];
            }else{
                $product->is_featured = 'No';
            }

            $product->status = 1;
            $product->save();

            return redirect('admin/product')->with('success',$message);
        }



        //Get Section For Category and SubCategory
        $categories = Section::with('categories')->get()->toArray();

        //Get All Brand
        $brands = Brand::where('status','=',1)->select('id','name')->get()->toArray();

        return view('admin.product.add-edit-product',compact('title','btn','message','categories','brands','product'));
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

    public function deleteProductImage($id)
    {
        $productImage = Product::select('product_image')->where('id',$id)->first();

        $small_image_path = 'admin/image/product_images/small/';
        $medium_image_path = 'admin/image/product_images/medium/';
        $large_image_path = 'admin/image/product_images/large/';

        if (file_exists($small_image_path.$productImage->product_image)) {
            unlink($small_image_path.$productImage->product_image);
        }

        if (file_exists($medium_image_path.$productImage->product_image)) {
            unlink($medium_image_path.$productImage->product_image);
        }

        if (file_exists($large_image_path.$productImage->product_image)) {
            unlink($large_image_path.$productImage->product_image);
        }

        Product::where('id',$id)->update(['product_image'=>'']);

         $msg = "Product Image Has Been Deleted Successfully!!";
         return redirect()->back()->with('delete',$msg);
    }

    public function deleteProductVideo($id)
    {
        $productVideo = Product::select('product_video')->where('id',$id)->first();

        $video_path = 'admin/videos/product_videos/';


        if (file_exists($video_path.$productVideo->product_video)) {
            unlink($video_path.$productVideo->product_video);
        }

        Product::where('id',$id)->update(['product_video'=>'']);

         $msg = "Product Image Has Been Deleted Successfully!!";
         return redirect()->back()->with('delete',$msg);
    }

    public function addAttributes(Request $request ,$id)
    {
      $product = Product::select('id','product_name','product_code','product_color','product_price','product_image')->with('attribute')->find($id);

      if($request->isMethod('post'))
      {
         $data = $request->all();
        //  dd($data);
        foreach ($data['sku'] as $key => $value) {
           if (!empty($value)) {

             //SKU duplicate check
             $skuCount = Attribute::where('sku',$value)->count();
             if($skuCount>0){
                return redirect()->back()->with('delete','SKU Already Exists!');
             }

             $sizeCount = Attribute::where(['product_id'=>$id,'size'=>$data['size'][$key]])->count();
             if($sizeCount>0){
                return redirect()->back()->with('delete','Size Already Exists!');
             }

            $attributes = new Attribute;
            $attributes->product_id = $id;
            $attributes->sku = $value;
            $attributes->size = $data['size'][$key];
            $attributes->price = $data['price'][$key];
            $attributes->stock = $data['stock'][$key];
            $attributes->status = 1;
            $attributes->save();

           }
        }
        return redirect()->back()->with('success','Product Attributes Added Successfully!');
      }
      return view('admin.attributes.add-edit-attributes' ,compact('product'))->with('no', 1);
    }

    public function updateAttributeStatus(Request $request)
    {
        if($request->ajax()){
            $data = $request->all();
            //  print_r($data);die();
            if($data['status'] == 'Active'){
                $status = 0;
            }else{
                $status = 1;
            }

            Attribute::where('id',$data['attribute_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status,'attribute_id'=>$data['attribute_id']]);
        }
    }

    public function editAttributes(Request $request)
    {
      if($request->isMethod('post'))
      {
         $data = $request->all();
        //  dd($data);
        foreach ($data['attributeId'] as $key => $attribute) {
           if (!empty($attribute)) {
            Attribute::where(['id'=>$data['attributeId'][$key]])->update(['price'=>$data['price'][$key],'stock'=>$data['stock'][$key]]);

           }
        }
        return redirect()->back()->with('success','Product Attributes Updated Successfully!');
      }
    }

    public function addImage(Request $request,$id)
    {
        $product = Product::select('id','product_name','product_code','product_color','product_price','product_image')->with('images')->find($id);

        if ($request->isMethod('post')) {
            $data = $request->all();
            if ($request->hasFile('image')) {
                $images = $request->file('image');
                foreach ($images as $key => $image) {
                    //Generate Image
                    $image_tmp = Image::make($image);
                    //Get Image Name
                    $image_name = $image->getClientOriginalName();
                    // Get Image Extension
                    $extension = $image->getClientOriginalExtension();
                    // Generate New Image Name
                    $imageName = $image_tmp.rand(111,99999).'.'.$extension;
                    $largeImagePath = 'admin/image/product_images/large/'.$imageName;
                    $mediumImagePath = 'admin/image/product_images/medium/'.$imageName;
                    $smallImagePath = 'admin/image/product_images/small/'.$imageName;
                    // Upload the Image
                    Image::make($image_tmp)->resize(1000,1000)->save($largeImagePath);
                    Image::make($image_tmp)->resize(500,500)->save($mediumImagePath);
                    Image::make($image_tmp)->resize(250,250)->save($smallImagePath);
                    $image = new ProductImage;
                    $image->image = $imageName;
                    $image->product_id = $id;
                    $image->status = 1;
                    $image->save();
                }
            }
            return redirect()->back()->with('success','Product Images Added Successfully!');
        }
        return view('admin.images.add-images' ,compact('product'))->with('no', 1);
    }

    public function updateImageStatus(Request $request)
    {
        if($request->ajax()){
            $data = $request->all();
            //  print_r($data);die();
            if($data['status'] == 'Active'){
                $status = 0;
            }else{
                $status = 1;
            }

            ProductImage::where('id',$data['image_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status,'image_id'=>$data['image_id']]);
        }
    }

    public function deleteImage($id)
    {
        $productImage = ProductImage::select('image')->where('id',$id)->first();

        $small_image_path = 'admin/image/product_images/small/';
        $medium_image_path = 'admin/image/product_images/medium/';
        $large_image_path = 'admin/image/product_images/large/';

        if (file_exists($small_image_path.$productImage->image)) {
            unlink($small_image_path.$productImage->image);
        }

        if (file_exists($medium_image_path.$productImage->image)) {
            unlink($medium_image_path.$productImage->image);
        }

        if (file_exists($large_image_path.$productImage->image)) {
            unlink($large_image_path.$productImage->image);
        }

        ProductImage::where('id',$id)->delete();

         $msg = "Product Image Has Been Deleted Successfully!!";
         return redirect()->back()->with('delete',$msg);
    }
}
