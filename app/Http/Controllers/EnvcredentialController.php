<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Credential;
use Auth;
class EnvcredentialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $envs=Credential::all();
        return view('env.index',compact('envs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('env.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([

           
            'email' => ['required', 'string', 'email', 'max:255', 'unique:credentials'],
            'password' => ['required', 'string', 'min:8'],
             
        ]);
      $cred= Credential::create([
            
            'email' => $request->email,
            'password' => $request->password,
            'admin_id'=>Auth::id(),
         
        ]);

      
     
        $data = [

           'MAIL_USERNAME' => $cred['email'],
           'MAIL_FROM_ADDRESS' => $cred['email'],
           'MAIL_PASSWORD' => $cred['password']
           ];

      


            $path = base_path('.env');

            if (file_exists($path)) {
                foreach ($data as $key => $value) {
                    file_put_contents($path, str_replace(
                        $key . '=' . env($key), $key . '=' . $value, file_get_contents($path)
                    ));
                }
            }

    
     

       return redirect()->route('credentials.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Credential::destroy($id);
        return redirect()->back();
    }
}
