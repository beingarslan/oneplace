<?php

namespace App\Http\Controllers;

use App\Department;
use App\Program;
use App\Social;
use App\UniversityAddmission;
use App\UniversityAnnouncement;
use App\UniversityInformation;
use App\UniversitySocial;
use App\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UniversityProfileController extends Controller
{

  public function userviewuniversities(){
    try {
    

              
        $universityInformations = UniversityInformation::where('deleted', '0')->where('status', '1')->paginate(15);
       
        return view('/user/university/userviewuniversities', [
            'universityInformations' => $universityInformations,

        ]);
      
    } catch (\Throwable $th) {
      //throw $th;
        return redirect('/');
    }
  }

  public function userviewuniversityprofile($id){

    try {
      if(UniversityInformation::where('userid', $id)->exists()){

              
        $universityInformation = UniversityInformation::where('userid', $id)->first();
        $universitySocials = UniversitySocial::where('userid', $id)->get();
        $programs = Program::where('userid', $id)->where('deleted', '0')->where('status', '1')->get();
        $deprtments = Department::where('userid', $id)->where('deleted', '0')->where('status', '1')->get();
        $universityAnnouncements = UniversityAnnouncement::where('deleted', '0')
                                ->where('userid', $id)
                                ->orderBy('created_at', 'DESC')
                                ->paginate(15);
        $univeristyAddmissions = UniversityAddmission::where('deleted', '0')
                                ->where('userid', $id)
                                ->orderBy('created_at', 'DESC')
                                ->paginate(15);
        return view('/user/university/viewprofile', [
            'universityInformation' => $universityInformation,
            'universitySocials' => $universitySocials,
            'programs' => $programs,
            'deprtments' => $deprtments,
            'universityAnnouncements' => $universityAnnouncements,
            'univeristyAddmissions' => $univeristyAddmissions
        ]);
      }
      else {
        return redirect('/');
      }
    } catch (\Throwable $th) {
      //throw $th;
        return redirect('/');
    }


  }

    public function viewprofile(){
        
              try {
                
                $universityInformation = UniversityInformation::where('userid', Auth::user()->id)->first();
                $universitySocials = UniversitySocial::where('userid', Auth::user()->id)->get();
                $programs = Program::where('userid', Auth::user()->id)->where('deleted', '0')->where('status', '1')->get();
                $deprtments = Department::where('userid', Auth::user()->id)->where('deleted', '0')->where('status', '1')->get();
                $universityAnnouncements = UniversityAnnouncement::where('deleted', '0')
                                        ->where('userid', Auth::user()->id)
                                        ->orderBy('created_at', 'DESC')
                                        ->paginate(15);
                $univeristyAddmissions = UniversityAddmission::where('deleted', '0')
                                        ->where('userid', Auth::user()->id)
                                        ->orderBy('created_at', 'DESC')
                                        ->paginate(15);
                return view('/university/profile/viewprofile', [
                    'universityInformation' => $universityInformation,
                    'universitySocials' => $universitySocials,
                    'programs' => $programs,
                    'deprtments' => $deprtments,
                    'universityAnnouncements' => $universityAnnouncements,
                    'univeristyAddmissions' => $univeristyAddmissions
                ]);
              } catch (\Throwable $th) {
                //throw $th;
              }
            
            
    }
}
