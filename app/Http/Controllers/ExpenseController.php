<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Expence;
use App\Models\Expense;
use Carbon\Carbon;
use DB;
use Auth;
use App\Helpers\BranchHalper;
class ExpenseController extends Controller
{

    function index()
    {
        $expence=Expense::join('expences','expenses.id','=','expences.expense_id')->where('expenses.branch_id',Auth::user()->branch_id)->get();

        return view('payment.expense.all_expence_index',compact('expence'));
    }
    function Expense(Request $req)
    {

        $req->validate([
        
            'e_type' => 'required',
            'expense_price' => 'required',
            'e_name' => 'required'
        ]);
        Expence::create([

            'expense_id' => $req->e_type,
            'expense' => $req->expense_price,
            'name' => $req->e_name,
            'branch_id'=>Auth::user()->branch_id,
        ]);
        $data=Expence::whereDate('created_at', Carbon::today())->sum('expense');
        return response()->json($data);
    }


    //xepense type
    function expenseType()
    {
        $expense=Expense::Branch()->get();
        return view('payment.expense.index',compact('expense'));
    }
    function getExpenseType()
    {
        $expense=Expense::Branch()->get();
        return response()->json($expense);
    }

    function expenseCreateType(Request $req)
    {
        $req->validate([
            'expence_type' =>'required',
        ]);
          
    
      Expense::create([
        
         'expence_type' => $req->expence_type,
         'branch_id' =>Auth::user()->branch_id,
      ]);

      return response()->json('data added');
        
    }

    function expenseUpdate(Request $req)
    {
       $id=$req->id;
      $req->request->add(['branch_id',Auth::user()->branch_id]);
      $data=$req->all();
      return \FormHelper::updateEloquent(new Expense, $id, $data);
    
    }

    function expenseDelete($id)
    {
        
         try{

           Expense::destroy($id);
      
          return redirect()->back()->with('flash','success');

       }catch(\Exception $e) {

         return redirect()->back()->with('flash', 'error');
            
     }
    }
}
