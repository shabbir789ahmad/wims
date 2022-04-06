<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use App\Models\Category;
use App\Models\SubCategory;
use Carbon\Carbon;
use Cache;
use Auth;
class SubCategoryController extends Controller {

    public function index() {

         // $expire = Carbon::now()->addMinutes(10);

           $sub_categories =SubCategory::Branch()->get();
                          
        return view('panel.sub_categories.index', compact('sub_categories'));

    }

    public function create() {

        $categories = Category::Branch()->get();

        return view('panel.sub_categories.create', compact('categories'));

    }

    public function store(Request $request) {
     
        $validator = \Validator::make($request->all(), [

            'category_id' => 'required',
            'sub_category_name' => 'required',

        ]);

        if ($validator->fails()) {

            return redirect()->back()->withErrors($validator)->withInput()->with('flash', 'validation');

        }
         $data = [ 'category_id' => $request->category_id,'sub_category_name' => $request->sub_category_name,'branch_id' => Auth::user()->branch_id,];
        return \FormHelper::createEloquent(new SubCategory, $data);

    }

    public function edit($id) {

        $categories = Category::Branch()->get();
        $sub_category = SubCategory::findOrFail($id);
        
        return view('panel.sub_categories.edit', compact('categories', 'sub_category'));

    }

    public function update(Request $request, $id) {

        $validator = \Validator::make($request->all(), [

            'category_id' => 'required',
            'sub_category_name' => 'required',

        ]);

        if ($validator->fails()) {

            return redirect()->back()->withErrors($validator)->withInput()->with('flash', 'validation');

        }
           $data = [ 'category_id' => $request->category_id,'sub_category_name' => $request->sub_category_name,
           'branch_id' => Auth::user()->branch_id,];
        return \FormHelper::updateEloquent(new SubCategory, $id, $data);
        
    }

    public function destroy($id) {

        SubCategory::destroy($id);        

        return redirect()->route('sub-categories.index')->with('flash', 'success');

    }

}
