<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::all();
        // dd($sections);
        return view('admin.brand.index', compact('brands'))->with('no', 1);
    }

    public function addBrand(Request $request)
    {
        if ($request->isMethod('post')) {

            $validated = $request->validate([
                'name' => 'required|string',
                'brand_status' => 'required',
            ]);

            $brand = new Brand;

            $brand->name = $request->input('name');
            $brand->status = $request->input('brand_status');
            $brand->save();
            // dd($sec);
            return redirect()->route('admin.brand.index')->with('success', 'Brand Added Sucessfully!!');
        }
        return view('admin.brand.add-brand');
    }

    public function editBrand(Request $request, $id)
    {
        $brand = Brand::where('id', $id)->first();
        if ($request->isMethod('post')) {

            $validated = $request->validate([
                'name' => 'required|string',
                'brand_status' => 'required',
            ]);

            $brand = Brand::find($id);
            $brand->name = $request->input('name');
            $brand->status = $request->input('brand_status');
            $brand->save();
            return redirect()->route('admin.brand.index')->with('success', 'Brand Updated Sucessfully!!');
        }
        return view('admin.brand.edit-brand')->with(compact('brand'));
    }

    public function destroy($id)
    {
        Brand::where('id', $id)->delete();

        $msg = "Brand Deleted Successfully!!";

        return redirect()->back()->with('delete', $msg);
    }

    public function updateBrandStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            //  print_r($data);die();
            if ($data['status'] == 'Active') {
                $status = 0;
            } else {
                $status = 1;
            }

            Brand::where('id', $data['brand_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'brand_id' => $data['brand_id']]);
        }
    }
}
