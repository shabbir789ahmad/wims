<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Dashboard;

class DashboardController extends Controller {
    
    public function index() {
     
     
        
        $data = Dashboard::initAdmin();

        return view('panel.dashboard.index', compact('data'));

    }

}
