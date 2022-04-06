<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Auth;
use Mail;
use DB;
class UserController extends Controller
{
 
    //  function __construct()
    // {
    //      $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index','store']]);
    //      $this->middleware('permission:user-create', ['only' => ['create','store']]);
    //      $this->middleware('permission:user-edit', ['only' => ['edit','update']]);
    //      $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    // }

    function index(Request $request)
    {

        $users=Admin::Branch()->with('roles')->orderBy('id', 'desc')->paginate(10);
      
        return view('user.index',compact('users'));
    }


    function create()
    {
        $roles = Role::pluck('name','name')->all();
        return view('user.create',compact('roles'));
    }
    

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function save(Request $request)
    {

        $request->validate([
          
          'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
         
           

        ]);
    

        $user= Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
           'branch_id'=>Auth::user()->branch_id,
            'admin_image'=>1,

         
        ]);
        $user->assignRole($request->input('roles'));

        

       return redirect()->route('user.index');

   
     }
      public function edit($id)
    {
        $user = Admin::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();
    
        return view('user.edit',compact('user','roles','userRole'));
    }

        public function update(Request $request, $id)
    {

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
          
            'roles' => 'required'
        ]);
    
        $input = $request->all();
       
        $user = Admin::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();
    
        $user->assignRole($request->input('roles'));
    
        return redirect()->route('user.index')
                        ->with('success','User updated successfully');
    }


     function destroy($id)
     {
        Admin::destroy($id);
        return redirect()->back();
     }


}
