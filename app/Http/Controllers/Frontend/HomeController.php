<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Venues;
use App\Events;
use App\Bookings;
use Auth;
use DB;
use validator;
use Carbon\Carbon;
use App\ExcludeDate;
use App\RiseCapacity;
/**
 * Class HomeController.
 */
class HomeController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
    	$venues = Venues::where('active',1)->get();
      
      return view('frontend.index', compact('venues'));
    }

   public function calendarDates(Request $request){

   	if($request->date)
   		$dt= Carbon::createFromFormat('Y-m-d',$request->date);
   	else
   		$dt = Carbon::now();

   	$date = $dt->format('m');

   	$getbookings = Bookings::where('bookings.venue_id' , $request->id)
   					->selectRaw("SUM(bookings.students_count) as seats, Date(bookings.book_date) as book_date, (venues.capacity) as capacity ")
   					->whereMonth('bookings.book_date', '>=', $date)
   					->leftJoin('venues', 'venues.id', '=', 'bookings.venue_id')
   					->groupBy('book_date')
   					->get();
    $getVenue = Venues::where('id',$request->id)->value('capacity');        
   	// SELECT sum(students_count), date(book_date) FROM `bookings` where  Group by book_date
    $data = array('capacity' => $getVenue, 'bookings' => $getbookings);
   	return response()->json($data);
   }

   public function checkBookings(Request $request){

    $id = Auth::id();

    $getbookings = Bookings::where('customer_id',$id)->where('status', 0)->get();

    if(count($getbookings) > 0){
      $response_data = array(
        'success' => true,
        'data' => $getbookings
      );
    }else{
      $response_data = array(
        'success' => false,
        'data' => ''
      );
    }
    return response()->json($response_data);


   }

    public function getReservation(){
      return view('frontend.user.eventreservation');
   }

   public function downloadForm(){

    ob_end_clean();
    $headers = array(
        'Content-Type: image/png',
    );
    return response()->download(storage_path() . '/parser.docx', 'final.docx', $headers);
   }

   public function makeReservation(Request $request){

       //var_dump($request->file()); 

       $valid = validator($request->all(), [
        'students_count_reservation' => 'required',
        'gender' => 'required',
        'special_needs' => 'required',
        'need_food' => 'required',
        'students_grade' => 'required',
        'students_name_list' => 'required|mimes:doc,docx,pdf,xls,xlsx',
    ]);

    if ($valid->fails()) {
        $jsonError=response()->json($valid->errors()->all(), 400);
        return \Response::json($jsonError);
    }
    else{
      //dd($request->all());
      $bookings = new Bookings();
      $event_id = Events::where('venues_id', $request->reservation_venue_id)->value('id');
      $bookings->book_date = $request->chosen_date;
      $bookings->event_id = $event_id;
      $bookings->customer_id = auth()->user()->id;
      $bookings->students_count = $request->students_count_reservation;
      $bookings->gender = $request->gender;
      $bookings->special_needs = $request->special_needs;
      $bookings->need_food_meal = $request->need_food;
      $bookings->students_grade = json_encode($request->students_grade);
      $bookings->venue_id = $request->reservation_venue_id;
      $students_file = $request->students_name_list;
      $students_file_name = rand(0,9999). $students_file->getClientOriginalName();
      $students_file_name = str_replace(' ', '', $students_file_name);
      $bookings->file_uploads = $students_file_name ;
      
      $students_file->move(public_path('uploads'),$students_file_name);

      if($bookings->save()){
          return response()->json(["success" => true, "message"=> "Reservation Successfull"]);

      }else{
          return response()->json(["success" => false, "message"=> "Error, Please Try Again"]);
      }
   }
  }

  public function ReservationSuccess(){
    return view('frontend.reservationsuccess');
  }

  public function getExcludeDates(Request $request){
    $data = ExcludeDate::where('active', 1)
            ->where('venues_id', $request->venue_id)
            ->get()->toArray();
    $collection = collect($data);

    $data =  $collection->map(function ($dates) {
        return [
          'from_date' => $dates['from_date'], 
          'to_date' => $dates['to_date'],
          'venues_id' => $dates['venues_id'],
      ];
    });
     if(count($data) > 0){
      $response_data = array(
        'success' => true,
        'data' => $data
      );
    }else{
      $response_data = array(
        'success' => false,
        'data' => ''
      );
    }
    return response()->json($response_data);

  }

public function getRiseCapacity(Request $request){
    $data = DB::select(DB::raw('SELECT * from rise_capacity LEFT JOIN events on events.id = rise_capacity.events_id where rise_capacity.active = 1 AND events.venues_id ='.$request->venue_id));

    // $collection = collect($data);

    // $data =  $collection->map(function ($dates) {
    //     return [
    //       'from_date' => $dates['from_date'], 
    //       'to_date' => $dates['to_date'],
    //       'events_id' => $dates['events_id'],
    //       'rise_capacity' => $dates['rise_capacity'],
    //   ];
    // });
     if(count($data) > 0){
      $response_data = array(
        'success' => true,
        'data' => $data
      );
    }else{
      $response_data = array(
        'success' => false,
        'data' => ''
      );
    }
    return response()->json($response_data);

  }
public function getWorkDays(Request $request){
   $venues = Venues::where('id', $request->venue_id)
            ->pluck('days_of_work');
   $days_of_work =         unserialize(base64_decode($venues));
   $days_of_work = array_filter($days_of_work,'strlen');
   return array_values($days_of_work);         
}
}
