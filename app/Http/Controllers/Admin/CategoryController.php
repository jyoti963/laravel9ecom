<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Image;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::with(['section','parentCategory'])->get()->toArray();

        return view('admin.category.index')->with(compact('categories'));
    }

    public function create(Request $request)
    {
      $getSections = Section::get()->toArray();
      
      return view('admin.category.add-category')->with(compact('getSections'));
    }

    public function updateSectionStatus($id)
    {
            $updateStatus = DB::table('categories')->select('status')->where('id',$id)->first();
            //  dd($updateStatus);

            if($updateStatus->status == 1)
            {
                $status = '0';
            }else
            {
                $status = '1';
            }

            $value = [
                'status' => $status
            ];

            DB::table('categories')->where('id',$id)->update($value);

            return redirect()->back()->with('msg','Status Updated Successfully');
    }
}
