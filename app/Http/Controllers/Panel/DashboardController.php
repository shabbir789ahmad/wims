<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Dashboard;
use App\Models\ProductStock;
use Auth;
use App\Notifications\NewPostNotify;
use Illuminate\Support\Facades\Notification;
use Illuminate\Notifications\Notifiable;
class DashboardController extends Controller {
    
    public function index() {
     
     
        
        $data = Dashboard::initAdmin();

          // foreach (Auth::user()->getRoleNames() as $role) {
            
          //       if ($role=='admin' ) {

          //           $stock=ProductStock::where('stock','=',0)->get();
          //           foreach($stock as $st)
          //           {
          //               Notification::route('mail' , Auth::user()->email)
          //                  ->notify(new NewPostNotify());
          //           }
                   
                    
          //       }
          //   }
           
        return view('panel.dashboard.index', compact('data'));

    }

}
