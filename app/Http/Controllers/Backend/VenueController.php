<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Venues;

class VenueContoller extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $venues = Venues::paginate('10');

        return view('backend.venues.index' , compact('venues'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       //

        return view('backend.venues.create' );
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'venue_name' => 'required|unique:venues|max:255',
            'capacity' => 'required',
            'days_of_work' => 'required',
        ]);

        $venues = new Venues();
        $venues->venue_name = $request->venue_name;
        $venues->capacity = $request->capacity;
        $venues->days_of_work = $request->days_of_work;
        $venues->address = $request->address;
        $venues->active = $request->active;
        
        if($venues->save()){
            $data = array('success' => true, 'message' => 'New Venue Successfully Added');
            return redirect('admin/venues')->with('data', $data);

        }else{

            $data = array('success' => false, 'message' => 'Something Went Wrong');
            return back()->with('data', $data);
        }




    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $venues = Venues::find($id);

        return view('backend.venues.edit' , compact('venues'));
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
         $request->validate([
            'venue_name' => 'required | max:255',
            'capacity' => 'required',
            'days_of_work' => 'required',
        ]);

        $venues = Venues::find($request->id);
        $venues->venue_name = $request->venue_name;
        $venues->capacity = $request->capacity;
        $venues->days_of_work = $request->days_of_work;
        $venues->address = $request->address;
        $venues->active = $request->active ?  $request->active : 0;
        
        if($venues->save()){
            $data = array('success' => true, 'message' => 'Venue Updated Successfully');
            return redirect('admin/venues')->with('data', $data);

        }else{

            $data = array('success' => false, 'message' => 'Something Went Wrong');
            return back()->with('data', $data);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
