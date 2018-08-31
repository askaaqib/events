<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Bookings;

class BookingsController extends Controller
{
    public function index(){

    	$bookings = Bookings::with('venues','events','users')->paginate();
    	
    	return view('backend.bookings.index', compact('bookings'));
    }

    public function destroy($id)
    {
        
        $bookings = Bookings::find($id);
        $bookings->delete();

        $data = array('success' => true, 'message' => 'Bookings Deleted Successfully');
        return redirect('admin/bookings')->with('data', $data);
    }

    public function updateStatus($id){
    	
    	$bookings = Bookings::find($id);
    	$bookings->status = 1;

    	if($bookings->save()){
    		$data = array('success' => true, 'message' => 'Status Updated Successfully');
        	return redirect('admin/bookings')->with('data', $data);
    	}
    	
    }
}
