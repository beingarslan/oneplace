<?php

namespace App\Http\Controllers;

use App\Logs;
use App\UniversityInformation;
use App\UniversityRequest;
use App\User;
use App\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class UniversityRequestController extends Controller
{
  public function accept(Request $request){
  
        try {
          $universityRequests = UniversityRequest::where('id', $request->input('id'))->update([
            'deleted' => '1'
          ]);
          $universityRequest = UniversityRequest::where('id', $request->input('id'))->first();
          $userid = rand(rand(1,500),rand(501,1000)).rand(rand(1,500),rand(501,1000)).rand(rand(1,500),rand(501,1000));
          while (User::where('userid',$userid)->exists()) {
            $userid = rand(rand(1,500),rand(501,1000)).rand(rand(1,500),rand(501,1000)).rand(rand(1,500),rand(501,1000));
          }

          
          $universityRequests = User::create([
            'name' => $universityRequest->university_name,
            'email' => $universityRequest->university_email,
            'password' => Hash::make($userid.$userid),
            'userid' => $userid
          ]);
          $user_role = new UserRole();
          $user_role->name = 'university';
          $user_role->userid = $universityRequests->id;
          $user_role->save();
          $universityRequests = UniversityInformation::create([
            'logo' => 'default.png',
            'cover' => 'default.jpg',
            'name' => $universityRequest->university_name,
            'email' => $universityRequest->university_email,
            'address' => $universityRequest->university_address,
            'website' => $universityRequest->university_website,
            'userid' => $universityRequests->id,
          ]);
          $log = Logs::create([
            'log' => 'Approved University ['.$universityRequests->name.'] Request.',
            'description' => 'Approved University ['.$universityRequests->name.'] Request by #'.Auth::user()->id.' ('.Auth::user()->name.' [admin]).',
            'userid' => Auth::user()->id,
          ]);
          $user = User::where('email', $universityRequest->university_email)->first();
          $token = Password::getRepository()->create($user);
          $user->sendPasswordResetNotification($token);
          return redirect()->back()->with('success', 'University has been Accepted');
        } catch (\Throwable $th) {
          throw $th;
        }

  }
    public function univeristyrequests(){
        
              try {
                $universityRequests = UniversityRequest::where('status', '1')->where('deleted', '0')->get();
                return view('/admin/manageuniversity/requests', [
                    'universityRequests' => $universityRequests
                ]);
              } catch (\Throwable $th) {
                //throw $th;
              }
  
    }
    public function new(){
        $pageConfigs = ['blankPage' => true];
        $breadcrumbs = [['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Layouts"], ['name' => "Layout Blank"]];
        return view('universityrequests.new', ['pageConfigs' => $pageConfigs, 'breadcrumbs' => $breadcrumbs]);
        
    }
    public function save(Request $request){
      $validatedData = $request->validate([
        'university_name' => 'required|max:100',
        'university_email' => 'required|max:100',
        'university_website' => 'required|max:100',
        'university_address' => 'required|max:255',
        'description' => 'required|max:255',
        'letter' => 'mimes:jpeg,png,jpg,pdf|max:2048',
    ]);
            try {
                
                
                
                //dd($validatedData); 
                //return response()->json('Form is successfully validated and data has been saved');
                    
                    


                        
                    
                $name = time().$request->file('letter')->getClientOriginalName();
                $url = $request->letter->move(public_path('letters/'),$name);
                
                // $validatedData[6]->letter = $name;  
                $request_added = UniversityRequest::create($validatedData);
                $request_updated = UniversityRequest::where('id', $request_added->id)->update([
                    'letter' => $name 
                ]);
               
                
                return redirect()->back()->with('success', 'Your application has been subitten, You will be nitified by email!');
                
            
            } catch (\Throwable $th) {
                throw $th;
                //return redirect()->back()->with('error', 'Error While uploading the file');
                
            }
        
        
    }
}
