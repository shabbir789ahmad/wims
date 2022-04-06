<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Auth;
use App\Models\Unit;

class UnitController extends Controller {
    
    public function index() {

        $units = \TestHelper::getEloquent(New Unit);//from testHalper
        
        return view('panel.units.index', compact('units'));

    }

    public function create() {

        return view('panel.units.create');

    }

    public function store(Request $request) {
        
        $validator = \Validator::make($request->all(), [

            'unit_name' => 'required',
            'unit_code' => 'required'

        ]);

        if ($validator->fails()) {
            return redirect()
            ->back()
            ->withErrors($validator)
            ->withInput()->with('flash', 'validation');
        }
        $request->request->add(['branch_id'=>Auth::user()->branch_id]);
       $data=$request->all();
        $query = Unit::create($data);

        if ($query) {

            return redirect()->route('units.index')->with('flash', 'success');

        } else {

            return redirect()
            ->back()
            ->withErrors($validator)
            ->withInput()->with('flash', 'error');

        }

    }

    public function edit($id) {

        $unit = Unit::Branch()->findOrFail($id);
        
        return view('panel.units.edit', ['unit' => $unit]);

    }

    public function update(Request $request, $id) {
        
        $validator = \Validator::make($request->all(), [

            'unit_name' => 'required',
            'unit_code' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()
            ->back()
            ->withErrors($validator)
            ->withInput()->with('flash', 'validation');
        }

        $unit = Unit::findOrFail($id);

        $unit->unit_name = $request->unit_name;
        $unit->unit_code = $request->unit_code;
        $unit->branch_id = Auth::user()->branch_id;

        $unit->save();

        return redirect()->route('units.index')->with('flash', 'success');       

    }

    public function destroy($id) {
        
        Unit::destroy($id);        

        return redirect()->route('units.index')->with('flash', 'success');

    }

}
