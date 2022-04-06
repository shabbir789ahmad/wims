<?php

namespace App\Http\Traits;
use Carbon\Carbon;
use App\Models\Image;

trait ImageTrait
 {

  
   function image()
   {
       $req = app('request');
          $image='';
       if($req->hasfile('image'))
       {
         $file=$req->file('image');
         $ext=$file->getClientOriginalExtension();
         $filename=time(). '.' .$ext;
         $file->move('uploads/brand/' , $filename);
         $image=$filename;
        }

       return $image;;
   }

   function cutomerValidation()
   {
     
     $req = app('request');
      $req->validate([

          'customer_group'=>'required',
          'customer_name'=>'required',
          'customer_address'=>'required',
          'customer_company'=>'required',
          'customer_city'=>'required',
          'customer_email'=>'required',
           'customer_phone'=>'required',
          

        ]);

   }

 }

?>