<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Bookings;

class BookingsController extends Controller
{
    public function index(){

    	$bookings = Bookings::paginate();

    	return view('backend.bookings.index', compact('bookings'));
    }


}
