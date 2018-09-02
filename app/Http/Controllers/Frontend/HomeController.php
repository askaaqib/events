<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Venues;
use App\Bookings;
use Auth;
use DB;
use validator;
use Carbon\Carbon;
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
    	$venues = Venues::all();

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
   	// SELECT sum(students_count), date(book_date) FROM `bookings` where  Group by book_date

   	return response()->json($getbookings);
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
    
       $valid = validator($request->all(), [
        'students_count_reservation' => 'required|number',
        'gender' => 'required|string',
        'days_of_work' => 'required|string',
    ]);

    if ($valid->fails()) {
        $jsonError=response()->json($valid->errors()->all(), 400);
        return \Response::json($jsonError);
    }

     
   }

}
