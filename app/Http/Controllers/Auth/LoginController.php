<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeMail;

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
  protected $redirectTo = RouteServiceProvider::HOME;

  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->middleware('guest')->except('logout');
  }

  public function redirectToProvider()
  {
    return Socialite::driver('google')->redirect();
  }

  public function handleProviderCallback()
  {
    $user = Socialite::driver('google')->user();
    $u = User::firstOrCreate([
      'email' => $user->email,
    ], [
      'name' => $user->name,
      'password' => bcrypt(Str::random(20)),
    ]);

    if (empty($u->customToken)) {

      $u->customToken = Str::random(300);
      $u->save();
    }



    Auth::login($u);
    return redirect('/');
    ## End Auth By Google
  }

  public function redirectToProviderFace()
  {
    return Socialite::driver('facebook')->redirect();
  }

  public function handleProviderCallbackFace()
  {
    $user = Socialite::driver('facebook')->user();
    $u = User::firstOrCreate([
      'email' => $user->email,
    ], [
      'name' => $user->name,
      'password' => bcrypt(Str::random(20)),
    ]);

    $u->customToken = Str::random(300);
    $u->save();

    Auth::login($u);
    return redirect('/');
    ## End Auth By Google
  }

  public function login_api()
  {
    if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
      $user = Auth::user();
      return response()->json([
        'success' => true,
        'user' => $user
      ]);
    } else {
      return response()->json([
        'success' => false,
        'message' => 'Invalid Email or Password',
      ], 401);
    }
  }

  public function facebook_login_api(Request $request)
  {

    //check if email exist

    $new_token = '0';

    $user = User::firstOrCreate(
      ['email' => $request->email,],
      [
        'name' => $request->name,
        'password' => bcrypt($request->id),
      ]
    );

    if (empty($user->customToken)) {
      $new_token = '1';
      $user->customToken = Str::random(300);
      $user->save();
    }

    Auth::login($user);

    return response()->json([
      'success' => true,
      'new_token' => $new_token,
      'user' => $user
    ]);
  }

  public function isLoggedIn_api()
  {
    if (Auth::check())
      return response()->json([
        'success' => true,
      ]);
    else
      return response()->json([
        'success' => false,
      ]);
  }

  public function logout_api(Request $request)
  {
    if (Auth::user()) {
      $user = Auth::user()->token();
      $user->revoke();

      return response()->json([
        'success' => true,
        'message' => 'Logout successfully'
      ]);
    } else {
      return response()->json([
        'success' => false,
        'message' => 'Unable to Logout'
      ]);
    }
  }
}
