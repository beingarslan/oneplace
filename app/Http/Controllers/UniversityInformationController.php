<?php

namespace App\Http\Controllers;

use App\Logs;
use App\UniversityInformation;
use App\User;
use App\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Rules\MatchOldPassword;
use App\Social;
use Illuminate\Support\Facades\Hash;

class UniversityInformationController extends Controller
{
  public function updateabout(Request $request){
 
        try {
          //dd($request);
          $validatedData = $request->validate([
            'about' => 'required|max:254',
          ]);
          $name = UniversityInformation::where('id', $request->input('id'))->update([
            'about' => $request->input('about')
          ]);

          
          
          $log = Logs::create([
            'log' => 'Updated Bio University ['.$request->input('name').'] Request.',
            'description' => 'Update Bio University ['.$request->input('name').'] Requested by #'.Auth::user()->id.' ('.Auth::user()->name.' [university]).',
            'userid' => Auth::user()->id,
          ]);
          return redirect()->back()->with('success', 'Bio has been updated has been updated');
        } catch (\Throwable $th) {
          //throw $th;
          return redirect()->back()->with('error', 'Cannot update the bio, try again.');
        }

  }
  public function updatepassword(Request $request){
    
        try {
          $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);
   
        User::where('userid', Auth::user()->id)->update(['password'=> Hash::make($request->new_password)]);
        $log = Logs::create([
          'log' => 'Updated Password University ['.$request->input('name').'].',
          'description' => 'Update Password University ['.$request->input('name').'] by #'.Auth::user()->id.' ('.Auth::user()->name.' [university]).',
          'userid' => Auth::user()->id,
        ]);
          return redirect()->back()->with('success', 'Password has been updated has been updated');
        } catch (\Throwable $th) {
          //throw $th;
          return redirect()->back()->with('error', 'Cannot update the password');

        }

  }
  public function updateprofile(Request $request){
    
        try {
          //dd($request);
          $validatedData = $request->validate([
            'name' => 'required|max:100',
            'username' => 'required|max:100',
            'email' => 'required|max:100',
            'primary_phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:17',
            'website' => 'required|max:255|url',
            'date_of_established' => 'required',
            'address' => 'required|max:300',
          ]);
          $name = UniversityInformation::where('id', $request->input('id'))->update([
            'name' => $request->input('name'),
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'primary_phone' => $request->input('primary_phone'),
            'website' => $request->input('website'),
            'date_of_established' => $request->input('date_of_established'),
            'address' => $request->input('address')
          ]);

          
          User::find(auth()->user()->id)->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'email_verified_at' => null,
          ]);
          $log = Logs::create([
            'log' => 'Updated Profile University ['.$request->input('name').'] Request.',
            'description' => 'Update Profile University ['.$request->input('name').'] Requested by #'.Auth::user()->id.' ('.Auth::user()->name.' [university]).',
            'userid' => Auth::user()->id,
          ]);
          return redirect()->back()->with('success', 'Profile has been updated has been updated');
        } catch (\Throwable $th) {
          //throw $th;
          return redirect()->back()->with('error', 'Cannot update the profile, try again.');
        }
 
  } 
    public function uploadlogo(Request $request){
   
              try {
                //dd($request);
                $validatedData = $request->validate([
                    'logo' => 'mimes:jpeg,png,jpg,pdf|max:2048',
                ]);
                $name = time().$request->file('logo')->getClientOriginalName();
                $url = $request->logo->move(public_path('university/logo/'),$name);
                
                $request_updated = UniversityInformation::where('id', $request->input('id'))->update([
                    'logo' => $name 
                ]);
                $log = Logs::create([
                    'log' => 'University ['.Auth::user()->name.'] logo updated.',
                    'description' => 'University ['.Auth::user()->name.'] updated their logo.',
                    'userid' => Auth::user()->id,
                  ]);
                return redirect()->back()->with('success', 'Logo has been updated');
              } catch (\Throwable $th) {
                throw $th;
                //return redirect()->back()->with('error', 'Cannot upload the logo');
              }
            

    }
    public function editprofile(){
        
              try {
                $universityInformation = UniversityInformation::where('status', '1')
                    ->where('deleted', '0')
                    ->where('userid', Auth::user()->id)
                    ->first();
                
                $socials = Social::where('status', '1')->where('deleted', '0')->get();
                return view('/university/profile/editprofile', [
                    'universityInformation' => $universityInformation,
                    'socials' => $socials
                ]);
              } catch (\Throwable $th) {
                //throw $th;
              }
            
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\UniversityInformation  $universityInformation
     * @return \Illuminate\Http\Response
     */
    public function show(UniversityInformation $universityInformation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UniversityInformation  $universityInformation
     * @return \Illuminate\Http\Response
     */
    public function edit(UniversityInformation $universityInformation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UniversityInformation  $universityInformation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UniversityInformation $universityInformation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UniversityInformation  $universityInformation
     * @return \Illuminate\Http\Response
     */
    public function destroy(UniversityInformation $universityInformation)
    {
        //
    }
}
