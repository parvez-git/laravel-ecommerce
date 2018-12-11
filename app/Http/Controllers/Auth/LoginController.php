<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('github')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
        $githubuser = Socialite::driver('github')->user();

        $existuser = User::where('email',$githubuser->email)->first();

        if($existuser){

            Auth::login($existuser);

            return redirect()->route('home');

        } else {

            $user = User::create([
                'name'      => $githubuser->name,
                'email'     => $githubuser->email,
                'password'  => Hash::make('123456'),
            ]);

            Auth::login($user);
            
            return redirect()->route('home');
        }
    }

    

    // REDIRECT AUTHENTICATED USER TO ADMIN or HOME 

    public function authenticated()
    {
        if(Auth::check() && Auth::user()->admin) {
            
            return redirect('/admin');
        }

        return redirect('/home');
    }
}
