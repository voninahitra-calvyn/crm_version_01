<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;

/**
 * Class RegisterController
 * @package %%NAMESPACE%%\Http\Controllers\Auth
 */
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        return view('auth.inscription');
    }

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';
    // protected $redirectTo = '/staffs';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'prenom'     => 'required|max:255',
            'nom' => 'sometimes|required|max:255|unique:users',
            'email'    => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'terms'    => 'required',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $fields = [
            'statut'        => $data['statut'],
            'nom'        => $data['nom'],
            'prenom'    => $data['prenom'],
            'email'       => $data['email'],
            // 'date_connexion'    => $data['date_connexion'],
            // 'nom'    => $data['nom'],
            // 'prenom'    => $data['prenom'],
            // 'email2'    => $data['email2'],
            // 'titre'    => $data['titre'],
            // 'experience'    => $data['experience'],
            // 'competence'    => $data['competence'],
            // 'date_connexion'    => $data['date_connexion'],
            'password' => bcrypt($data['password']),
        ];
        // if (config('auth.providers.users.field', 'email') === 'username' && isset($data['username'])) {
            // $fields['username'] = $data['username'];
        // }
        return User::create($fields);
    }
}
