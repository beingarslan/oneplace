<?php

namespace App\Http\Controllers;

use App\Logs;
use App\Program;
use App\UniversityAddmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UniversityAddmissionController extends Controller
{

    public function saveaddmissions(Request $request){
        $validatedData = $request->validate([
            'last_date' => 'required',
            'description' => 'required|max:255',
            'cover' => 'mimes:jpeg,png,jpg,pdf|max:10000',
            'programid' => 'required'
          ]);
          try {
            $name = time().$request->file('cover')->getClientOriginalName();
            $url = $request->cover->move(public_path('university/admissions/'),$name);
            //dd(Auth::user()->universityInformation->id);
            $eligibilitys = UniversityAddmission::create([
              'last_date' => $request->input('last_date'),
              'description' => $request->input('description'),
              'userid' => Auth::user()->id,
              'cover' => $name,
              'programid' => $request->input('programid'),
            ]);
            
            $log = Logs::create([
              'log' => 'Added UniversityAddmission University ['.$request->input('name').'].',
              'description' => 'Added UniversityAddmission University ['.$request->input('name').'] by #'.Auth::user()->id.' ('.Auth::user()->name.' [university]).',
              'userid' => Auth::user()->id,
            ]);
            return redirect()->back()->with('success', 'UniversityAddmission has been Added.');
          } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', 'Cannot add the UniversityAddmission!');
          }
    }

    public function manageaddmissions(){
        try {
            $univeristyAddmissions = UniversityAddmission::where('deleted', '0')
                                        ->where('userid', Auth::user()->id)
                                        ->orderBy('created_at', 'DESC')
                                        ->paginate(15);
            $programs = Program::where('deleted', '0')
                                ->where('userid', Auth::user()->id)
                                ->get();
            return view('/university/addmissions/index', [
                'univeristyAddmissions' => $univeristyAddmissions,
                'programs' => $programs
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

   
   
}
