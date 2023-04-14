<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Image;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::get()->toArray();

        return view('admin.banner.index',compact('banners'))->with('no', 1);
    }

    public function addEditBanner(Request $request , $id=null)
    {
        if ($id=="") {
            $title = "Add Slider Image";
            $btn = "Add";
            $message = "Slider Image added successfully!";
            $banner = new Banner;
         }else{
             $title = "Edit Slider Image";
             $btn = "Update";
             $banner =Banner::find($id);
            //  dd($banner);
             $banner = "Slider Image Updated successfully!";
         }

         if($request->isMethod('post')){
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;

            $rules = [
                'banner_images' => 'required|',
                'title' => 'required',
                'link' => 'required',
                'alt' => 'required',
            ];
            $customMessages = [
                'banner_images.required' => 'Please select a image',
                'title.required' => 'Please enter a title',
                'link.required' => 'Please enter a link',
                'alt.required' => 'Please enter Alternative Text',
            ];

            $this->validate($request,$rules,$customMessages);

            // Upload Category Image
            if($request->hasFile('banner_images')){
                $image_tmp = $request->file('banner_images');
                if($image_tmp->isValid()){
                    // Get Image Extension
                    $extension = $image_tmp->getClientOriginalExtension();
                    // Generate New Image Name
                    $imageName = rand(111,99999).'.'.$extension;
                    $imagePath = 'front/banner_images/'.$imageName;
                    // Upload the Image
                    Image::make($image_tmp)->save($imagePath);
                    $banner->image = $imageName;
                }
            }else{
                $banner->image = "";
            }

            $banner->title = $data['title'];
            $banner->link = $data['link'];
            $banner->alt = $data['alt'];
            $banner->status = 1;
            // dd($banner);
            $banner->save();

            return redirect('admin/banner')->with('success',$message);

        }

        // Get All Sections
        // $getBanners = Banner::get()->toArray();

        return view('admin.banner.add-edit-banner')->with(compact('title','banner','btn'));
    }

    public function updateBannerStatus(Request $request)
    {
        if($request->ajax()){
            $data = $request->all();
            //  print_r($data);die();
            if($data['status'] == 'Active'){
                $status = 0;
            }else{
                $status = 1;
            }

            Banner::where('id',$data['banner_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status,'banner_id'=>$data['banner_id']]);
        }
    }

    public function deleteBanner($id)
    {
       $bannerImage = Banner::where('id',$id)->first();

       $banner_image_path = 'front/banner_images/';

       if (file_exists($banner_image_path.$bannerImage->image)) {
        unlink($banner_image_path.$bannerImage->image);
       }

       Banner::where('id',$id)->delete();

         $msg = "Slider Image Has Been Deleted Successfully!!";
         return redirect()->back()->with('delete',$msg);
    }
}
