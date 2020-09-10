<?php

namespace App\Http\Controllers\Auth;

use App\Home;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers {
        attemptLogin as attemptLoginAtAuthenticatesUsers;
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('auth.connexion');
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';
    // protected $redirectTo = '/staffs';
    // protected $redirectTo = '/rendez-vous/brut';
    // protected $redirectTo = '/agendas';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    /**
     * Returns field name to use at login.
     *
     * @return string
     */
    public function username()
    {
        return config('auth.providers.users.field', 'email');
    }

    /**
     * Attempt to log the user into the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function attemptLogin(Request $request)
    {
        /*
		if ($this->username() === 'email') {
            return $this->attemptLoginAtAuthenticatesUsers($request);
        }
        if (! $this->attemptLoginAtAuthenticatesUsers($request)) {
            return $this->attempLoginUsingUsernameAsAnEmail($request);
        }
        return false;
		*/
		if ($this->attempLoginUsingUsername($request) === null){
			return $this->attempLoginUsingUsername($request);
		}else{
			return $this->attemptLoginAtAuthenticatesUsers($request);
		}
		return false;	
    }

    /**
     * Attempt to log the user into application using username as an email.
     *
     * @param \Illuminate\Http\Request $request
     * @return bool
     */
    protected function attempLoginUsingUsernameAsAnEmail(Request $request)
    {
        return $this->guard()->attempt(
            ['email' => $request->input('username'), 'password' => $request->input('password')],
            $request->has('remember')
        );
    }

    /**
     * Attempt to log the user into application using username as an email.
     *
     * @param \Illuminate\Http\Request $request
     * @return bool
     */
    protected function attempLoginUsingUsername(Request $request)
    {
        return $this->guard()->attempt(
            ['username' => $request->input('email'), 'password' => $request->input('password')],
            $request->has('remember')
        );
    }

    public function login(Request $request)
    {
        $home = Home::all();
        if($home->count()) {
            // $note1=1;
            // $note2=2;
            foreach ($home as $key => $value) {
                $_id=$value->_id;
                $note1=$value->note1;
                $note2=$value->note2;
            }
        }else{
            $_id=null;
            $note1=null;
            $note2=null;
        }

        $input = $request->all();
        $this->validate($request,[
           'email' => 'required',
           'password' => 'required',
        ]);
        $fieldType = filter_var($request->email,FILTER_VALIDATE_EMAIL)? 'email' : 'username';
        if (auth()->attempt([
            $fieldType => $input['email'],
            'password' =>$input['password']
        ])){
            if (auth()->user()->etat=="Inactif"){
                $errorInactif = "inactif";
                return view('auth.connexion', compact('errorInactif'));
            }
            return view('home.index', compact('home','_id','note1','note2'));        }
        else{
            $error1="error";

            return view('auth.connexion', compact('error1'));
           /* return response()->json([
                'error' => 'Credentials do not match our database.'
            ], 401);
            return redirect()->route('login')
                        ->with('error',"Identifiants invalid");*/
        }
    }
    /*
 public function login(Request $request)
    {
        $this->validateLogin($request);

        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if($this->guard()->validate($this->credentials($request))) {
            if(Auth::attempt(['email' => $request->email, 'password' => $request->password, 'is_activated' => 1])) {
                // return redirect()->intended('dashboard');
            }  else {
                $this->incrementLoginAttempts($request);
                return response()->json([
                    'error' => 'This account is not activated.'
                ], 401);
            }
        } else {
            // dd('ok');
            $this->incrementLoginAttempts($request);
            return response()->json([
                'error' => 'Credentials do not match our database.'
            ], 401);
        }
    }
*/

}
