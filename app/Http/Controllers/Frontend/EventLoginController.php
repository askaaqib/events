<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Exceptions\GeneralException;
use App\Http\Controllers\Controller;
use Hash;
use Redirect;
use Session;
use Validator;
use Illuminate\Support\Facades\Input;

/**
 * Class LoginController.
 */
class EventLoginController extends Controller
{

    public function showEventLoginForm()
    {
        if(Auth::check()){
            return response()->json(['success' => true, 'message' => 'Already Logged In']);
        }
        return view('frontend.auth.event-login');
    }

  
    public function username()
    {
        return config('access.users.username');
    }

   

    /**
     * Log the user out of the application.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        /*
         * Remove the socialite session variable if exists
         */
        if (app('session')->has(config('access.socialite_session_name'))) {
            app('session')->forget(config('access.socialite_session_name'));
        }

        /*
         * Remove any session data from backend
         */
        app()->make(Auth::class)->flushTempSession();

        /*
         * Fire event, Log out user, Redirect
         */
        event(new UserLoggedOut($request->user()));

        /*
         * Laravel specific logic
         */
        $this->guard()->logout();
        $request->session()->invalidate();

        return redirect()->route('frontend.index');
    }


    public function eventlogin(Request $request) {



        $rules = array (
                'email' => 'required|email',
                'password' => 'required|max:255' 
        );

        $validator = Validator::make ( Input::all (), $rules );


        if ($validator->fails ()) {
            return response()->json(['success', false, 'errors'=>$validator->errors()]);
        } else {
            $Credentials = array (
                'email' => $request->get('email'),
                'password' => $request->get('password') ,
                'active' => 1,
                'confirmed' => 1
            );

            if (Auth::attempt($Credentials)) {
                $save_email = array('email' => $request->get('email'));
                session ($save_email);
                return response()->json(['success' => true, 'message' => "Successfully Logged In"]);
            } else {
                return response()->json(['success'=> false, 'message' => "Invalid Credentials , Please try again."]);
            }
        }
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logoutAs()
    {
        // If for some reason route is getting hit without someone already logged in
        if (! auth()->user()) {
            return redirect()->route('frontend.auth.login');
        }

        // If admin id is set, relogin
        if (session()->has('admin_user_id') && session()->has('temp_user_id')) {
            // Save admin id
            $admin_id = session()->get('admin_user_id');

            app()->make(Auth::class)->flushTempSession();

            // Re-login admin
            auth()->loginUsingId((int) $admin_id);

            // Redirect to backend user page
            return redirect()->route('admin.auth.user.index');
        } else {
            app()->make(Auth::class)->flushTempSession();

            // Otherwise logout and redirect to login
            auth()->logout();

            return redirect()->route('frontend.auth.login');
        }
    }
}
