<?php

namespace App\Http\Controllers;

use App\Department;
use App\Eligibility;
use App\Logs;
use App\Program;
use App\UniversityInformation;
use App\UniversitySocial;
use App\User;
use App\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProgramController extends Controller
{

  public function universityviewprogram($id){
    if(Program::find($id)->where('deleted', '0')->where('status', '1')->exists()){
      try {
        $program = Program::where('id', $id)->first();
        $eligibilities = Eligibility::where('programid', $program->id)->where('deleted', '0')->where('status', '1')->get();
        $departments = Department::where('status', '1')->where('deleted', '0')->get();
        //dd($eligibilities);
        return view('/user/programs/program', [
          'program' => $program,
          'eligibilities' => $eligibilities,
          'departments' => $departments
        ]);
      } catch (\Throwable $th) {
        //throw $th;
      }
    }
    else {
      return redirect('/');
    }
  }
  public function universityviewprograms($id){
    if(UniversityInformation::where('userid', $id)->where('deleted', '0')->exists()){
      try {
          $programs = Program::where('deleted', '0')
              ->where('status', '1')
              ->where('userid', $id)
              ->get();
          
          $universityInformation = UniversityInformation::where('userid', $id)->first();
          $universitySocials = UniversitySocial::where('userid', $id)->get();
          return view('/user/programs/programs', [
              'programs' => $programs,
              'universityInformation' => $universityInformation,
              'universitySocials' => $universitySocials
          ]);
      } catch (\Throwable $th) {
          //throw $th;
          return redirect('/');
      }
    }
    else {
      return redirect('/');
    }
  }

  public function viewprograms(){
    
        try {
            $programs = Program::where('deleted', '0')
                ->where('status', '1')
                ->where('userid', Auth::user()->id)
                ->get();
            
            $universityInformation = UniversityInformation::where('userid', Auth::user()->id)->first();
            $universitySocials = UniversitySocial::where('userid', Auth::user()->id)->get();
            return view('/university/programs/programs', [
                'programs' => $programs,
                'universityInformation' => $universityInformation,
                'universitySocials' => $universitySocials
            ]);
        } catch (\Throwable $th) {
            //throw $th;
            return redirect('/');
        }
   
}
  public function updateprogram(Request $request){
    $validatedData = $request->validate([
      'name' => 'required|max:50',
      'description' => 'required|max:255',
      'departmentid' => 'required',
      'criteria' => 'required|max:255',
      'award_of_degree' => 'required|max:255',
      'more_info' => 'required|max:255'
     ]);
     try {
       $eligibilitys = Program::where('id', $request->input('id'))->update([
          'name' => $request->input('name'),
          'description' => $request->input('description'),
          'status' => $request->input('status'),
          'departmentid' => $request->input('departmentid'),
          'criteria' => $request->input('criteria'),
          'award_of_degree' => $request->input('award_of_degree'),
          'more_info' => $request->input('more_info')
        ]);
        $log = Logs::create([
          'log' => 'Updated Program University ['.$request->input('name').'].',
            'description' => 'Updated Program University ['.$request->input('name').'] by #'.Auth::user()->id.' ('.Auth::user()->name.' [university]).',
            'userid' => Auth::user()->id,
        ]);
        return redirect()->back()->with('success', 'Program has been updated');
      } catch (\Throwable $th) {
        throw $th;
        //return redirect()->back()->with('error', 'Cannot Update the Program, Check inputs and try again.');
      }
  }
  public function viewprogram($id){
    if(Program::find($id)->where('deleted', '0')->where('status', '1')->exists()){
      try {
        $program = Program::where('id', $id)->first();
        $eligibilities = Eligibility::where('programid', $program->id)->where('deleted', '0')->where('status', '1')->get();
        $departments = Department::where('status', '1')->where('deleted', '0')->get();
        //dd($eligibilities);
        return view('/university/programs/viewprogram', [
          'program' => $program,
          'eligibilities' => $eligibilities,
          'departments' => $departments
        ]);
      } catch (\Throwable $th) {
        //throw $th;
      }
    }
    else {
      return redirect('/');
    }
  }
    public function updateprograms(Request $request){
      //dd($request);
      $validatedData = $request->validate([
        'name' => 'required|max:50',
        'description' => 'required|max:255',
        'departmentid' => 'required'
       ]);
       try {
         $eligibilitys = Program::where('id', $request->input('id'))->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'status' => $request->input('status'),
            'departmentid' => $request->input('departmentid')
          ]);
          $log = Logs::create([
            'log' => 'Updated Program University ['.$request->input('name').'].',
              'description' => 'Updated Program University ['.$request->input('name').'] by #'.Auth::user()->id.' ('.Auth::user()->name.' [university]).',
              'userid' => Auth::user()->id,
          ]);
          return redirect()->back()->with('success', 'Program has been updated');
        } catch (\Throwable $th) {
          throw $th;
          //return redirect()->back()->with('error', 'Cannot Update the Program, Check inputs and try again.');
        }
    }
    public function saveprograms(Request $request){
      
      $validatedData = $request->validate([
        'name' => 'required|max:50',
        'description' => 'required|max:255',
        'departmentid' => 'required',
      ]);
      try {
        
        $eligibilitys = Program::create([
          'name' => $request->input('name'),
          'description' => $request->input('description'),
          'userid' => Auth::user()->id,
          'departmentid' => $request->input('departmentid'),
        ]);
        
        $log = Logs::create([
          'log' => 'Added Department University ['.$request->input('name').'].',
          'description' => 'Added Department University ['.$request->input('name').'] by #'.Auth::user()->id.' ('.Auth::user()->name.' [university]).',
          'userid' => Auth::user()->id,
        ]);
        return redirect()->back()->with('success', 'Program has been Added.');
      } catch (\Throwable $th) {
        //throw $th;
        return redirect()->back()->with('error', 'Cannot add the Program, Check inputs and try again.');
      }
    }
    public function manageprograms(){
      try {
        $programs = Program::where('deleted', '0')
          ->where('userid', Auth::user()->id)
          ->get();
        $departments = Department::where('status', '1')->where('deleted', '0')->get();
                
        return view('/university/programs/index', [
          'programs' => $programs,
          'departments' => $departments
        ]);
      } catch (\Throwable $th) {
                //throw $th;
        abort(404);
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
     * @param  \App\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function show(Program $program)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function edit(Program $program)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Program $program)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function destroy(Program $program)
    {
        //
    }
}
