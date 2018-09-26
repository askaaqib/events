<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Bookings;
use App\Venues;
use App\Events;
use App\Models\Auth\User;
use App\Models\Auth\Role;

class BookingsController extends Controller
{
    public function index(){

    	$bookings = Bookings::with('venues','events','users')->paginate();
    	//dd($bookings);
    	return view('backend.bookings.index', compact('bookings'));
    }

    public function store(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'venue_id' => 'required',
            'students_count' => 'required',
            'book_date' => 'required',
        ]);

        $bookings = new Bookings();
        $event_id = Events::where('venues_id', $request->venue_id)->value('id');
        $bookings->event_id = $event_id;
        $bookings->students_count = $request->students_count;
        $bookings->venue_id = $request->venue_id;
        $bookings->customer_id = $request->customer_id;
        $bookings->book_date = $request->book_date;
        $bookings->students_grade = json_encode($request->students_grade);
        $bookings->gender = $request->gender;
        $bookings->need_food_meal = $request->need_food_meal;
        $bookings->special_needs = $request->special_needs;
        $status = $request->status ? $request->status : 0;
        $bookings->status = $status ;
        $students_file = $request->students_name_list;
        $students_file_name = rand(0,9999). $students_file->getClientOriginalName();
        $students_file_name = str_replace(' ', '', $students_file_name);
        $bookings->file_uploads = $students_file_name ;
      
        $students_file->move(public_path('uploads'),$students_file_name);

        if($bookings->save()){
            $data = array('success' => true, 'message' => 'New Booking Added Successfully');
            return redirect('admin/bookings')->with('data', $data);

        }else{

            $data = array('success' => false, 'message' => 'Error, Please Try Again');
            return back()->with('data', $data);
        }
    }

    public function edit($id){
        $bookings = Bookings::find($id);
        $venues = Venues::all()->pluck('venue_name','id');
        $events = Events::all()->pluck('event_name','id');
        $users = User::whereHas('roles',function($q){$q->where('name','user');})->pluck('first_name','id');

        return view('backend.bookings.edit', compact('bookings','venues','events','users'));
    }

    public function update(Request $request){
        //dd($request->all());
        $request->validate([
            'venue_id' => 'required',
            'students_count' => 'required',
            'book_date' => 'required',
        ]);
        $bookings = Bookings::find($request->id);
        $event_id = Events::where('venues_id', $request->venue_id)->value('id');
        $bookings->event_id = $event_id;
        $bookings->students_count = $request->students_count;
        $bookings->venue_id = $request->venue_id;
        $bookings->customer_id = $request->customer_id;
        $bookings->book_date = $request->book_date;
        $bookings->students_grade = json_encode($request->grades);
        $bookings->gender = $request->gender;
        $bookings->need_food_meal = $request->need_food_meal;
        $bookings->special_needs = $request->special_needs;
        $status = $request->status ? $request->status : 0;
        $bookings->status = $status ;
        $old_file = $request->students_name_list_old;
        $new_file = $request->students_name_list;
        if($new_file){
            $students_file = $new_file;
            $students_file_name = rand(0,9999). $students_file->getClientOriginalName();
            $students_file_name = str_replace(' ', '', $students_file_name);
            $bookings->file_uploads = $students_file_name ;
            
            unlink(public_path('uploads/').$old_file); // remove old file 
            $students_file->move(public_path('uploads'),$students_file_name); // upload new file


        }        

        if($bookings->save()){
            $data = array('success' => true, 'message' => 'Booking updated Successfully');
            return redirect('admin/bookings')->with('data', $data);

        }else{

            $data = array('success' => false, 'message' => 'Error, Please Try Again');
            return back()->with('data', $data);
        }
    }

    public function destroy($id)
    {
        
        $bookings = Bookings::find($id);
        //dd($bookings->file_uploads);
        unlink(public_path('uploads/').$bookings->file_uploads); // remove file
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

    public function create()
    {
        //
        $venues = Venues::all()->pluck('venue_name','id');
        $events = Events::all()->pluck('event_name','id');
        $users = User::whereHas('roles', function($q){$q->where('name', 'user');})->pluck('first_name','id');
        //dd($users);
        return view('backend.bookings.create', compact('venues','events','users'));
    }
}
