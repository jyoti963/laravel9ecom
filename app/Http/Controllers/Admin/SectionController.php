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
        return view('admin.sections.section',compact('sections'))->with('no', 1);
    }

    public function addSection(Request $request)
    {
        if ($request->isMethod('post')) {

            $validated = $request->validate([
                'section_name' => 'required|string',
                'section_status' => 'required',
            ]);

            $sec = new Section;
            $sec->name = $request->input('section_name');
            $sec->status = $request->input('section_status');
            $sec->save();
            // dd($sec);
            return redirect()->route('admin.sections')->with('success','Section Added Sucessfully!!');

        }
        return view('admin.sections.add-section');
    }

    public function editSection(Request $request,$id)
    {
        $data = Section::where('id',$id)->first();
        if ($request->isMethod('post')) {

            $validated = $request->validate([
                'section_name' => 'required|string',
                'section_status' => 'required',
            ]);

            $sec = Section::find($id);
            $sec->name = $request->input('section_name');
            $sec->status = $request->input('section_status');
            $sec->save();
            return redirect()->route('admin.sections')->with('success','Section Updated Sucessfully!!');
        }
        return view('admin.sections.edit-section')->with(compact('data'));
    }

    public function deleteSection($id)
    {
         Section::where('id',$id)->delete();

         $msg = "Section Deleted Successfully!!";

         return redirect()->back()->with('delete',$msg);
    }

    public function updateSectionStatus(Request $request)
    {
        if($request->ajax()){
            $data = $request->all();
            //  print_r($data);die();
            if($data['status'] == 'Active'){
                $status = 0;
            }else{
                $status = 1;
            }

            Section::where('id',$data['section_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status,'section_id'=>$data['section_id']]);
        }
    }

}
