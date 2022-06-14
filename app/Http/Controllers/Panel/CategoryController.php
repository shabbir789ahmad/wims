<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Auth;
use App\Models\Category;
use App\Http\Traits\ProductTrait;
class CategoryController extends Controller {

  use ProductTrait;
    public function index() {

        $categories = $this->category();
 
        return view('panel.categories.index', compact('categories'));

    }

    public function create() {

        return view('panel.categories.create');

    }

    public function store(Request $request) {

        $validator = \Validator::make($request->all(), [

            'category_name' => [
                'required',
            ]

        ]);

        if ($validator->fails()) {
            return redirect()
            ->back()
            ->withErrors($validator)
            ->withInput()->with('flash', 'validation');
        }

        $data = [
            'category_name' => $request->category_name,
            'branch_id' => Auth::user()->branch_id,
        ];

        return \FormHelper::createEloquent(new Category, $data);

    }

    public function edit($id) {

        $category = Category::Branch()->findOrFail($id);
        
        return view('panel.categories.edit', compact('category'));

    }

    public function update(Request $request, $id) {

        $validator = \Validator::make($request->all(), [

            'category_name' => 'required'
       
        ]);

        if ($validator->fails()) {
            return redirect()
            ->back()
            ->withErrors($validator)
            ->withInput()->with('flash', 'validation');
        }
        $data = [ 'category_name' => $request->category_name,'branch_id' => Auth::user()->branch_id,];
        return \FormHelper::updateEloquent(new Category, $id, $data);

    }

    public function destroy($id) {

        Category::destroy($id);        

        return redirect()->route('categories.index')->with('flash', 'success');

    }

}
