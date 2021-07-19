<?php

namespace App\Http\Controllers;

use App\Department;
use App\Program;
use App\UniversityAddmission;
use App\UniversityAnnouncement;
use App\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
  public function admin(){
    
        try {
          return view('admindashboard');
        } catch (\Throwable $th) {
          //throw $th;
        }
 
    
  }


  public function user(){
  
        try {
          //$programs = 
          //dd();
          return view('userdashboard', [
            'programs' => Program::where('status', 1)->where('deleted', 0)->inRandomOrder()->limit(5)->get(),
            'universityAnnouncements' => UniversityAnnouncement::where('deleted', '0')->orderBy('created_at', 'DESC')->limit(15)->get(),
            'univeristyAddmissions' => UniversityAddmission::where('deleted', '0')->inRandomOrder()->limit(5)->get(),
            'deprtments' => Department::where('deleted', '0')->where('status', '1')->inRandomOrder()->limit(5)->get(),
          ]);
        } catch (\Throwable $th) {
          //throw $th;
        }
      
    
  }

  public function university(){
    
        try {
          return view('universitydashboard');
        } catch (\Throwable $th) {
          //throw $th;
        }
      
    
  }
  // Dashboard - Analytics
  public function dashboardAnalytics()
  {
    $pageConfigs = ['pageHeader' => false];

    return view('/content/dashboard/dashboard-analytics', ['pageConfigs' => $pageConfigs]);
  }

  // Dashboard - Ecommerce
  public function dashboardEcommerce()
  {
    $pageConfigs = ['pageHeader' => false];

    return view('/content/dashboard/dashboard-ecommerce', ['pageConfigs' => $pageConfigs]);
  }
}
