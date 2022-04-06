<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Meta {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    public function handle(Request $request, Closure $next) {

        $current_url = \Route::currentRouteName();

        $navigation = explode('.', $current_url);

        $request->request->add([
            '_branchId' => \Auth::user()->branch_id,
            '_vendorId' => \VendorHelper::getId(),
        ]);

        $meta = [

            'current_url' => $navigation[0]

        ];

        view()->share($meta);

        return $next($request);

    }
}
