<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Country;
use App\Models\Vendor;
use App\Models\VendorBankDetail;
use App\Models\VendorBuisnessDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Image;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function login(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            $validated = $request->validate([
                'email' => 'required|email|max:255',
                'password' => 'required',
            ]);

            if (Auth::guard('admin')->attempt(['email' => $data['email'], 'password' => $data['password'], 'status' => 1])) {
                return redirect('admin/dashboard');
            } else {
                return redirect()->back()->with('error_msg', 'Invalid Email or Password');
            }
        }

        return view('admin.login');
    }

    public function updateAdminPass()
    {
        $adminDtls = Admin::where('email', Auth::guard('admin')->user()->email)->first()->toArray();

        return view('admin.settings.update-admin-password')->with(compact('adminDtls'));
    }

    public function checkCurrentPassword(Request $request)
    {
        $data = $request->all();
        //   dd($data);
    }

    public function updateAdminDtls(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();

            $rules = [
                'name' => 'required|regex:/^[\pL\s\-]+$/u',
                'mobile' => 'required|numeric',
            ];

            $this->validate($request, $rules);

            if ($request->hasFile('image')) {
                $image_tmp = $request->file('image');

                if ($image_tmp->isValid()) {
                    $extension = $image_tmp->getClientOriginalExtension();
                    $imageName = rand(111, 99999) . '.' . $extension;
                    $imagePath = 'admin/photo/' . $imageName;
                    Image::make($image_tmp)->save($imagePath);
                }

            } else if (!empty($data['current_image'])) {
                $imageName = $data['current_image'];

            } else {
                $imageName = "";
            }

            Admin::where('id', Auth::guard('admin')->user()->id)->update(['name' => $data['name'], 'mobile' => $data['mobile'], 'image' => $imageName]);

            return redirect()->back()->with('success', 'Admin Details Updated Successfully!');
            // dd($data);
        }
        return view('admin.settings.update-admin-details');
    }

    public function updateVendorDtls($slug, Request $request)
    {

        if ($slug == "personal") {
            if ($request->isMethod('post')) {

                $data = $request->all();
                // dd($data);
                $rules = [
                    'name' => 'required|regex:/^[\pL\s\-]+$/u',
                    'mobile' => 'required|numeric',
                ];

                $customMsg = [
                    'name.required' => 'Vendor Name is required',
                    'name.regex' => 'Vendor Name should be in alphabetical order',
                    'mobile.required' => 'Vendor Mobile is required',
                    'mobile.numeric' => 'Mobile number should be in numeric with 10 digits',
                ];
                $this->validate($request, $rules, $customMsg);

                if ($request->hasFile('vendor_image')) {
                    $image_tmp = $request->file('vendor_image');
                    if ($image_tmp->isValid()) {
                        $extension = $image_tmp->getClientOriginalExtension();
                        $imageName = rand(111, 99999) . '.' . $extension;
                        $imagePath = 'admin/photo/' . $imageName;
                        Image::make($image_tmp)->save($imagePath);
                    }
                } else if (!empty($data['current_vendor_image'])) {
                    $imageName = $data['current_vendor_image'];
                } else {
                    $imageName = "";
                }
                //Update in admin table
                Admin::where('id', Auth::guard('admin')->user()->id)->update(['name' => $data['name'], 'mobile' => $data['mobile'], 'image' => $imageName]);
                //Update in vendor table
                Vendor::where('id', Auth::guard('admin')->user()->vendor_id)->update(['name' => $data['name'], 'mobile' => $data['mobile'], 'address' => $data['address'], 'city' => $data['city'], 'country' => $data['country'], 'state' => $data['state'], 'pincode' => $data['pincode'], 'mobile' => $data['mobile']]);

                return redirect()->back()->with('success', 'Vendor Details Updated Successfully!');
            }
            $vendorDtls = Vendor::where('id', Auth::guard('admin')->user()->vendor_id)->first()->toArray();

        } else if ($slug == "buisness") {

            if ($request->isMethod('post')) {
                $data = $request->all();
                // dd($data);
                $rules = [
                    'shop_name' => 'required|regex:/^[\pL\s\-]+$/u',
                    'shop_mobile' => 'required|numeric',
                    'address_proof' => 'required',
                    'address_proof_image' => 'required|image',
                ];

                $customMsg = [
                    'name.required' => 'Vendor Name is required',
                    'name.regex' => 'Vendor Name should be in alphabetical order',
                    'mobile.required' => 'Vendor Mobile is required',
                    'mobile.numeric' => 'Mobile number should be in numeric with 10 digits',
                    'address_proof_image.required' => 'Address Proof Image is required',
                    'address_proof_image.image' => 'Please select a valid image type',
                ];

                $this->validate($request, $rules, $customMsg);

                if ($request->hasFile('address_proof_image')) {
                    $image_tmp = $request->file('address_proof_image');
                    if ($image_tmp->isValid()) {
                        $extension = $image_tmp->getClientOriginalExtension();
                        $imageName = rand(111, 99999) . '.' . $extension;
                        $imagePath = 'admin/proofs/' . $imageName;
                        Image::make($image_tmp)->save($imagePath);
                    }

                } else if (!empty($data['current_address_proof_image'])) {
                    $imageName = $data['current_address_proof_image'];

                } else {
                    $imageName = "";
                }
                //Update in vendor table
                VendorBuisnessDetails::where('vendor_id', Auth::guard('admin')->user()->vendor_id)->update(['shop_name' => $data['shop_name'], 'shop_mobile' => $data['shop_mobile'], 'shop_address' => $data['shop_address'], 'shop_city' => $data['shop_city'], 'shop_country' => $data['shop_country'], 'shop_state' => $data['shop_state'], 'shop_pincode' => $data['shop_pincode'], 'buisness_lincence_no' => $data['buisness_lincence_no'], 'gst_no' => $data['gst_no'], 'pancard_no' => $data['pancard_no'], 'address_proof' => $data['address_proof'], 'address_proof_image' => $imageName]);

                return redirect()->back()->with('success', 'Vendor Business Details Updated Successfully!');
            }
            $vendorDtls = VendorBuisnessDetails::where('vendor_id', Auth::guard('admin')->user()->vendor_id)->first()->toArray();
        } else if ($slug == "bank") {

            if ($request->isMethod('post')) {
                $data = $request->all();
                // dd($data);
                $rules = [
                    'account_holder_name' => 'required|regex:/^[\pL\s\-]+$/u',
                    'bank_name' => 'required|regex:/^[\pL\s\-]+$/u',
                    'bank_ifsc_code' => 'required',
                    'bank_account_no' => 'required',

                ];

                $customMsg = [
                    'account_holder_name.required' => 'Account Holder Name is required',
                    'account_holder_name.regex' => 'Account Holder Name should be in alphabetical order',
                    'bank_name.required' => 'Bank Name is required',
                    'bank_name.regex' => 'Bank Name should be in alphabetical order',
                ];
                $this->validate($request, $rules, $customMsg);
                //Update in vendor table
                VendorBankDetail::where('vendor_id', Auth::guard('admin')->user()->vendor_id)->update(['account_holder_name' => $data['account_holder_name'], 'bank_name' => $data['bank_name'], 'bank_ifsc_code' => $data['bank_ifsc_code'], 'bank_account_no' => $data['bank_account_no']]);

                return redirect()->back()->with('success', 'Vendor Bank Details Updated Successfully!');
            }
            $vendorDtls = VendorBankDetail::where('vendor_id', Auth::guard('admin')->user()->vendor_id)->first()->toArray();

        }
        $countries = Country::get();

        return view('admin.settings.update-vendor-details')->with(compact('slug', 'vendorDtls', 'countries'));
    }

    public function adminManage($type = null)
    {
        $adminManage = Admin::query();
        if (!empty($type)) {
            $adminManage = $adminManage->where('type', $type);
            $title = ucfirst($type) . 's';

        } else {
            $title = "All Admins/Subadmis/Vendors";
        }

        $adminManage = $adminManage->get()->toArray();
        //  dd($adminManage);
        return view('admin.adminmanage.admins',compact('adminManage', 'title'))->with('no',1);
    }

    public function updateStatus(Request $request)
    {
        if($request->ajax()){
            $data = $request->all();
            //  print_r($data);die();
            if($data['status'] == 'Active'){
                $status = 0;
            }else{
                $status = 1;
            }

            Admin::where('id',$data['admin_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status,'admin_id'=>$data['admin_id']]);
        }

    }

    public function viewVendorDtls($id)
    {
        $vendorDtls = Admin::with('vendorPersonal', 'vendorBusiness', 'vendorBank')->where('id', $id)->first();
        $vendorDtls = json_decode(json_encode($vendorDtls), true);
        // dd($vendorDtls);
        return view('admin.adminmanage.view-vendor-details')->with(compact('vendorDtls'));

    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('admin/login');
    }
}
