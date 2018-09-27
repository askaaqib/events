<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Support\Facades\Auth as Auths;
use Illuminate\Http\Request;
use App\Exceptions\GeneralException;
use App\Http\Controllers\Controller;
use Hash;
use Redirect;
use Session;
use Validator;
use Illuminate\Support\Facades\Input;
use Auth;
use App\Helpers\Frontend\Auth\Socialite;
use App\Events\Frontend\Auth\UserLoggedIn;
use App\Events\Frontend\Auth\UserLoggedOut;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Repositories\Frontend\Auth\UserSessionRepository;
/**
 * Class LoginController.
 */
class EventLoginController extends Controller
{
    use AuthenticatesUsers;

    public function showEventLoginForm()
    {
        if(Auths::check()){
            return response()->json(['success' => true, 'message' => 'Already Logged In']);
        }
        return view('frontend.auth.event-login');
    }

  
    public function username()
    {
        return config('access.users.username');
    }

   
/**
     * The user has been authenticated.
     *
     * @param Request $request
     * @param         $user
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws GeneralException
     */
    protected function authenticated(Request $request, $user)
    {
        /*
         * Check to see if the users account is confirmed and active
         */
        if (! $user->isConfirmed()) {
            auth()->logout();

            // If the user is pending (account approval is on)
            if ($user->isPending()) {
                throw new GeneralException(__('exceptions.frontend.auth.confirmation.pending'));
            }

            // Otherwise see if they want to resent the confirmation e-mail

            throw new GeneralException(__('exceptions.frontend.auth.confirmation.resend', ['url' => route('frontend.auth.account.confirm.resend', $user->{$user->getUuidName()})]));
        } elseif (! $user->isActive()) {
            auth()->logout();
            throw new GeneralException(__('exceptions.frontend.auth.deactivated'));
        }

        event(new UserLoggedIn($user));

        // If only allowed one session at a time
        if (config('access.users.single_login')) {
            resolve(UserSessionRepository::class)->clearSessionExceptCurrent($user);
        }
        
        return response()->json(['success' => true, 'message' => 'success you are login']);
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
                'mobileNumber' => 'required|regex:/[0-9]{11}/|digits:11',
                'password' => 'required|max:255' 
        );

        $validator = Validator::make ( Input::all (), $rules );


        if ($validator->fails ()) {
            return response()->json(['success' => false, 'errors'=> $validator->errors() ]);
        } else {
            $Credentials = array (
                'mobileNumber' => $request->get('mobileNumber'),
                'password' => $request->get('password') ,
                'active' => 1,
                'confirmed' => 1
            );

            if (Auth::attempt($Credentials)) {
                $save_mobile = array('mobileNumber' => $request->get('mobileNumber'));
                session ($save_mobile);
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
