<?php

namespace App\Http\Controllers\Frontend\User;

use App\Http\Controllers\Controller;
use App\Venues;

/**
 * Class DashboardController.
 */
class DashboardController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
       $venues = Venues::where('active',1)->get();
       
      return redirect('/')->withInput(['venues'=>$venues]);
    }

    public function eventindex()
    {
    	return view('frontend.user.eventdashboard');
        
    }
}
