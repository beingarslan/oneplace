<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use App\UserDetail;
use App\UserRole;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

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
   * Where to redirect users after registration.
   *
   * @var string
   */
  protected $redirectTo = '/';

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
      'name' => ['required', 'string', 'max:255'],
      'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
      'password' => ['required', 'string', 'min:8', 'confirmed'],
    ]);
  }

  /**
   * Create a new user instance after a valid registration.
   *
   * @param  array  $data
   * @return \App\User
   */
  protected function create(array $data)
  {
    
    $userid = rand(rand(1,500),rand(501,1000)).rand(rand(1,500),rand(501,1000)).rand(rand(1,500),rand(501,1000));
    while (User::where('userid',$userid)->exists()) {
      $userid = rand(rand(1,500),rand(501,1000)).rand(rand(1,500),rand(501,1000)).rand(rand(1,500),rand(501,1000));
    }

    
    $user =  User::create([
      'name' => $data['name'],
      'email' => $data['email'],
      'password' => Hash::make($data['password']),
      'userid' => $userid
    ]);
    $user_role = new UserRole();
    $user_role->name = 'user';
    $user_role->userid = $user->id;
    $user_role->save();
    UserDetail::create([
      'userid' => $user->id,
      'image' => "default.png"
    ]);
    return $user;
  }

  // Register
  public function showRegistrationForm()
  {
    $pageConfigs = ['blankPage' => true];

    return view('/auth/register', [
      'pageConfigs' => $pageConfigs
    ]);
  }
}
