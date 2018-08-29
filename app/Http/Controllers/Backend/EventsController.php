<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Events;
use App\Venues;

class EventsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $events = Events::with('venues')->paginate();

        return view('backend.events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $venues = Venues::all()->pluck('venue_name','id');
        return view('backend.events.create' , compact('venues'));
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
            'venues_id' => 'required',
            'event_name' => 'required|unique:events|max:255',
            'start_date' => 'required',
        ]);

        $events = new Events();
        $events->event_name = $request->event_name;
        $events->venues_id = $request->venues_id;
        $events->start_date = $request->start_date;
        $events->active = $request->active;
        
        if($events->save()){
            $data = array('success' => true, 'message' => 'New Event Added Successfully');
            return redirect('admin/events')->with('data', $data);

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
        $events = Events::find($id);
        $venues = Venues::all()->pluck('venue_name', 'id');

        return view('backend.events.edit' , compact('events', 'venues'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'venues_id' => 'required',
            'event_name' => 'required',
            'start_date' => 'required',
        ]);

        $events = Events::find($request->id);
        $events->venues_id = $request->venues_id;
        $events->event_name = $request->event_name;
        $events->start_date = $request->start_date;
        $events->active = $request->active;
        
        if($events->save()){
            $data = array('success' => true, 'message' => 'Event Updated Successfully');
            return redirect('admin/events')->with('data', $data);

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
        $events = Events::find($id);
        $events->delete();

        $data = array('success' => true, 'message' => 'Event Deleted Successfully');
        return redirect('admin/events')->with('data', $data);
    }
}
