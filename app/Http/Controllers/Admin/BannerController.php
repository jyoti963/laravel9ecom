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

        return view('admin.banner.index', compact('banners'))->with('no', 1);
    }

    public function addBanner(Request $request)
    {
        if ($request->isMethod('post')) {

            $data = $request->all();
            // echo "<pre>"; print_r($data); die;

            $rules = [
                'banner_images' => 'required|image|mimes:jpg,png,jpeg,gif,svg',
                'title' => 'required',
                'link' => 'required',
                'alt' => 'required',
            ];
            $customMessages = [
                'banner_images.required' => 'Please select a image',
                'banner_images.mimes' => 'Must be in the format of jpeg,png,gif,svg,jpeg',
                'title.required' => 'Please enter a title',
                'link.required' => 'Please enter a link',
                'alt.required' => 'Please enter Alternative Text',
            ];

            $this->validate($request, $rules, $customMessages);


            // $image_name = uniqid() . '.' . $data['image']->getClientOriginalExtension();
            // $image_path = 'uploads/' . $image_name;
            // Image::make($data['image'])->resize(320, 240)->save(public_path($image_path));
            // $data['image'] = $image_path;
            // $blog = Blog::create($data);
            $banner = new Banner();

            $image_tmp = $request->file('banner_images');
            if ($image_tmp->isValid()) {
                // Get Image Extension
                $extension = $image_tmp->getClientOriginalExtension();
                // Generate New Image Name
                $imageName = rand(111, 99999) . '.' . $extension;
                $imagePath = 'front/banner_images/' . $imageName;
                // Upload the Image
                Image::make($image_tmp)->save($imagePath);
                $banner->image = $imageName;

                $banner->title = $data['title'];
                $banner->link = $data['link'];
                $banner->type = $data['type'];
                $banner->alt = $data['alt'];
                $banner->status = 1;
                // dd($banner);
                $banner->save();
                // dd($sec);
                return redirect()->route('admin.banners')->with('success', 'Banner Added Sucessfully!!');
            }
        }

        return view('admin.banner.add-banner');
    }

    public function editBanner(Request $request, $id)
    {
        $banner = Banner::find($id);
        if ($request->isMethod('post')) {

            $rules = [
                'banner_images' => 'required|image|mimes:jpg,png,jpeg,gif,svg',
                'title' => 'required',
                'link' => 'required',
                'alt' => 'required',
            ];
            $customMessages = [
                'banner_images.required' => 'Please select a image',
                'banner_images.mimes' => 'Must be in the format of jpeg,png,gif,svg,jpeg',
                'title.required' => 'Please enter a title',
                'link.required' => 'Please enter a link',
                'alt.required' => 'Please enter Alternative Text',
            ];

            $this->validate($request, $rules, $customMessages);



            if ($request->hasFile('banner_images')) {
                $image_tmp = $request->file('banner_images');
                if ($image_tmp->isValid()) {
                    // Get Image Extension
                    $extension = $image_tmp->getClientOriginalExtension();
                    // Generate New Image Name
                    $imageName = rand(111, 99999) . '.' . $extension;
                    $imagePath = 'front/banner_images/' . $imageName;
                    // Upload the Image
                    Image::make($image_tmp)->save($imagePath);
                    $banner->image = $imageName;
                }
            } else {
                $banner->image = "";
            }

            $banner->title = $request->input('title');
            $banner->link = $request->input('link');
            $banner->type = $request->input('type');
            $banner->alt = $request->input('alt');
            $banner->save();
            return redirect()->route('admin.banners')->with('success', 'Banner Updated Sucessfully!!');
        }
        return view('admin.banner.edit-banner', compact('banner'));
    }

    public function updateBannerStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            //  print_r($data);die();
            if ($data['status'] == 'Active') {
                $status = 0;
            } else {
                $status = 1;
            }

            Banner::where('id', $data['banner_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'banner_id' => $data['banner_id']]);
        }
    }

    public function deleteBanner($id)
    {
        $bannerImage = Banner::where('id', $id)->first();

        $banner_image_path = 'front/banner_images/';

        if (file_exists($banner_image_path . $bannerImage->image)) {
            unlink($banner_image_path . $bannerImage->image);
        }

        Banner::where('id', $id)->delete();

        $msg = "Slider Image Has Been Deleted Successfully!!";
        return redirect()->back()->with('delete', $msg);
    }
}
