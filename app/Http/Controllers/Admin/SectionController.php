<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SectionController extends Controller
{
    public function section()
    {
        $sections = Section::all();
        // dd($sections);
        return view('admin.sections.section')->with(compact('sections'));
    }

    public function editSection(Request $request,$id)
    {

    }

    public function deleteSection($id)
    {
         Section::where('id',$id)->delete();

         $msg = "Section Deleted Successfully!!";

         return redirect()->back()->with('delete',$msg);
    }

    public function updateSectionStatus($id)
    {
            $updateStatus = DB::table('sections')->select('status')->where('id',$id)->first();
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

            DB::table('sections')->where('id',$id)->update($value);

            return redirect()->back()->with('msg','Status Updated Successfully');
    }

}
