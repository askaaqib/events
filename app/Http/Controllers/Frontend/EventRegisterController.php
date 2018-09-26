<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Helpers\Frontend\Auth\Socialite;
use App\Events\Frontend\Auth\UserRegistered;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Repositories\Frontend\Auth\UserRepository;
use Validator;
use Illuminate\Support\Facades\Input;

/**
 * Class RegisterController.
 */
class EventRegisterController extends Controller
{

    /**
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * RegisterController constructor.
     *
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Where to redirect users after login.
     *
     * @return string
     */

    public function showEventRegistrationForm()
    {
        abort_unless(config('access.registration'), 404);

        return view('frontend.auth.event-register')
            ->withSocialiteLinks((new Socialite)->getSocialLinks());
    }


    /**
     * @param RegisterRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Throwable
     */
    public function register(RegisterRequest $request)
    {
        
        $rules = array(
                'name'             => 'required',                        // just a normal required validation
                'email'            => 'required|email|unique:users',     // required and must be unique in the ducks table
                'mobileNumber'     => 'required|digits:11', // required and must be unique in the ducks table
                'password'         => 'required',
                'password_confirmation' => 'required|same:password'           // required and has to match the password field
            );

        $request->first_name= '';
        $request->last_name= '';

            // do the validation ----------------------------------
            // validate against the inputs from our form
            $validator = Validator::make(Input::all(), $rules);
            
            // check if the validator failed -----------------------
            if ($validator->fails()) {

                // get the error messages from the validator
                $messages = $validator->messages();

                // redirect our user back to the form with the errors from the validator
                return response()->json(['success' => false, 'errors'=>$validator->errors()]);
            }
            else{
                $user = $this->userRepository
                ->create($request->only('name', 'email', 
                            'password', 'address', 
                            'mobileNumber', 'schoolName', 
                            'schoolPhone',  'job' ,'first_name', 'last_name'
                        )
                    );

                // If the user must confirm their email or their account requires approval,
                // create the account but don't log them in.
                if (config('access.users.confirm_email') || config('access.users.requires_approval')) {
                    event(new UserRegistered($user));
                    $message =  config('access.users.requires_approval') ?
                            __('exceptions.frontend.auth.confirmation.created_pending') :
                            __('exceptions.frontend.auth.confirmation.created_confirm');
                    $data = array('success'=>true, 'message' => $message);

                    return response()->json($data);
         
                } else {
                    auth()->login($user);

                    event(new UserRegistered($user));

                    $message = 'Already Registered';
                    $data = array('success'=>true, 'message' => $message);
                    return response()->json($data);
                }
            }

        
    }
}
