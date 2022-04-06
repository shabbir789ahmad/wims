<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\Supplier;

class SupplierController extends Controller {

    public function index() {

        $suppliers = Supplier::Branch()->get();
        
        return view('panel.suppliers.index', compact('suppliers'));

    }

    public function create() {
        
        return view('panel.suppliers.create');

    }

    public function store(Request $request) {
        
        $validator = \Validator::make($request->all(), [

            'company_name' => 'required',
            'contact_person_name' => 'required',
            'contact_person_phone' => 'required',

        ]);

        if ($validator->fails()) {

            return redirect()->back()->withErrors($validator)->withInput()->with('flash', 'validation');

        }

       
         $request->request->add(['branch_id'=>Auth::user()->branch_id]);
         $data=$request->all();
        return \FormHelper::createEloquent(new Supplier, $data);

    }

    public function edit($id) {
        
        $supplier = Supplier::Branch()->findOrFail($id);

        return view('panel.suppliers.edit', compact('supplier'));

    }

    public function update(Request $request, $id) {
        
        $validator = \Validator::make($request->all(), [

            'company_name' => 'required',
            'contact_person_name' => 'required',
            'contact_person_phone' => 'required',
            
        ]);

        if ($validator->fails()) {

            return redirect()->back()->withErrors($validator)->withInput()->with('flash', 'validation');

        }
        $request->request->add(['branch_id'=>Auth::user()->branch_id]);
        $data=$request->all();
        return \FormHelper::updateEloquent(new Supplier, $id, $data);

    }

    public function destroy($id) {
        
        Supplier::Branch()->destroy($id); 

        return redirect()->route('suppliers.index')->with('flash', 'success');

    }

}
