<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Traits\ImageTrait;
use App\Models\Brand;
use Auth;

class BrandController extends Controller {
   
   use ImageTrait;
    
    public function index() {

        $brands = \TestHelper::getEloquent(New Brand);

        
        return view('panel.brands.index', compact('brands'));

    }

    public function create() {
        
        return view('panel.brands.create');

    }

    public function store(Request $request) {
        
        $validator = \Validator::make($request->all(), [

            'brand_name' => [
                'required',
            ],
           

        ]);

        if ($validator->fails()) {
            return redirect()
            ->back()
            ->withErrors($validator)
            ->withInput()->with('flash', 'validation');
        }

        $model = new Brand;

        $data = [
            
             'brand_name' => $request->brand_name,
             'brand_logo' => $this->image()??null,
             'branch_id' => Auth::user()->branch_id,
         ];

        return \FormHelper::createEloquent($model, $data);

    }

    public function edit($id) {

        $brand = Brand::Branch()->findOrFail($id);
        
        return view('panel.brands.edit', ['brand' => $brand]);

    }

    public function update(Request $request, $id) {
        
        $validator = \Validator::make($request->all(), [

            'brand_name' => 'required',
           

        ]);

        if ($validator->fails()) {
            return redirect()
            ->back()
            ->withErrors($validator)
            ->withInput()->with('flash', 'validation');
        }

        $model = new Brand;

        $data = [

            'brand_name' => $request->brand_name,
            'brand_logo' => $this->image()??null,
             'branch_id' => Auth::user()->branch_id,
        ];

        return \FormHelper::updateEloquent($model, $id, $data);

    }

    public function destroy($id) {
        
        Brand::destroy($id); 

        return redirect()->route('brands.index')->with('flash', 'success');

    }

}
