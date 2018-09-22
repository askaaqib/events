<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ExcludeDate;
use App\Venues;


class ExcludeDateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $excludeDates = ExcludeDate::with('venues')->paginate('10');

        return view('backend.excludeDate.index' , compact('excludeDates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $venues = Venues::all()->pluck('venue_name','id');
        return view('backend.excludeDate.create' , compact('venues'));
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
            'venues_id' => 'required|unique:exclude_dates',
            'from_date' => 'required|max:255',
            'to_date' => 'required',
            'active' => 'required'
        ]);

        $excludeDate = new ExcludeDate();
        $excludeDate->from_date = $request->from_date;
        $excludeDate->venues_id = $request->venues_id;
        $excludeDate->to_date = $request->to_date;
        $excludeDate->active = $request->active;
        $excludeDate->reason = $request->reason;
        
        if($excludeDate->save()){
            $data = array('success' => true, 'message' => 'New Exclude Date Added Successfully');
            return redirect('admin/excludeDates')->with('data', $data);

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
        var_dump('expression');
        exit;
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
        $excludeDates = ExcludeDate::find($id);
        $venues = Venues::all()->pluck('venue_name', 'id');

        return view('backend.excludeDate.edit' , compact('excludeDates', 'venues'));
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
            'to_date' => 'required'
        ]);

        $excludeDate = ExcludeDate::find($request->id);;
        $excludeDate->from_date = $request->from_date;
        $excludeDate->to_date = $request->to_date;
        $excludeDate->active = $request->active;
        $excludeDate->reason = $request->reason;
        
        if($excludeDate->save()){
            $data = array('success' => true, 'message' => 'Exclude Date Updated Successfully');
            return redirect('admin/excludeDates')->with('data', $data);

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
        $excludeDate = ExcludeDate::find($id);
        $excludeDate->delete();

        $data = array('success' => true, 'message' => 'Exclude Date Deleted Successfully');
        return redirect('admin/excludeDates')->with('data', $data);
    }
}
