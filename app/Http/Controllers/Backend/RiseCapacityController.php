<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\RiseCapacity;
use App\Events;

class RiseCapacityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $riseCapacity = RiseCapacity::with('events')->paginate('10');

        return view('backend.riseCapacity.index' , compact('riseCapacity'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $events = Events::all()->pluck('event_name','id');
        return view('backend.riseCapacity.create' , compact('events'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'events_id' => 'required',
            'from_date' => 'required',
            'to_date' => 'required',
            'active' => 'required',
            'capacity' => 'required'
        ]);

        $riseCapacity = new RiseCapacity();
        $riseCapacity->from_date = $request->from_date;
        $riseCapacity->events_id = $request->events_id;
        $riseCapacity->to_date = $request->to_date;
        $riseCapacity->active = $request->active;
        $riseCapacity->rise_capacity = $request->capacity;
        
        if($riseCapacity->save()){
            $data = array('success' => true, 'message' => 'New Exclude Date Added Successfully');
            return redirect('admin/riseCapacity')->with('data', $data);

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
        $riseCapacity = RiseCapacity::find($id);
        $events = Events::all()->pluck('event_name', 'id');

        return view('backend.riseCapacity.edit' , compact('riseCapacity', 'events'));
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
         $request->validate([
            'from_date' => 'required|max:255',
            'to_date' => 'required',
            'capacity' => 'required'
        ]);


        $riseCapacity = RiseCapacity::find($request->id);
        $riseCapacity->from_date = $request->from_date;
        $riseCapacity->to_date = $request->to_date;
        $riseCapacity->active = $request->active;
        $riseCapacity->rise_capacity = $request->capacity;
        
        if($riseCapacity->save()){
            $data = array('success' => true, 'message' => 'Rice Capacity Updated Successfully');
            return redirect('admin/riseCapacity')->with('data', $data);

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
        $riseCapacity = RiseCapacity::find($id);
        $riseCapacity->delete();

        $data = array('success' => true, 'message' => 'Rise Capacity Deleted Successfully');
        return redirect('admin/riseCapacity')->with('data', $data);
    }
}
