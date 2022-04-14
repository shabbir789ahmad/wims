<?php

namespace App\Http\Controllers\Branch;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Branch;
use Auth;
class BranchController extends Controller
{
    function index()
    {
        $branchs=Branch::where('id',Auth::user()->branch_id)->first();

        return view('branch.index',compact('branchs'));
    }

    function edit($id)
    {
       $branchs=Branch::findorfail($id);

        return view('branch.edit',compact('branchs'));
    }

    function update(Request $request,$id)
    {
        $request->validate([
          
           'branch_name'=>'required',
        ]);

        Branch::where('id',$id)->update([
          
           'branch_name'=>$request->branch_name,
        ]);

        return redirect()->route('branch.index')->with('success','Branch Name Updated');
    }
}
