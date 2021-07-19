<?php

namespace App\Http\Controllers;

use App\Department;
use App\Logs;
use App\Program;
use App\UniversityInformation;
use App\UniversitySocial;
use App\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DepartmentController extends Controller
{
    public function universityviewdepartmentprograms($id){
        if(Department::find($id)->where('deleted', '0')->where('status', '1')->exists()){
            try {
                $department = Department::find($id)->where('deleted', '0')->where('status', '1')->first();
                $programs = Program::where('deleted', '0')
                    ->where('status', '1')
                    ->where('userid', $department->user->id)
                    ->where('departmentid', $id)
                    ->get();
                
                $universityInformation = UniversityInformation::where('userid', $department->user->id)->first();
                $universitySocials = UniversitySocial::where('userid', $department->user->id)->get();
                return view('/user/departments/programs', [
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
    public function universityviewdepartments($id){
        try {
            $departments = Department::where('deleted', '0')
                ->where('status', '1')
                ->where('userid', $id)
                ->get();
            
            $universityInformation = UniversityInformation::where('userid', $id)->first();
            $universitySocials = UniversitySocial::where('userid', $id)->get();
            return view('/user/departments/departments', [
                'departments' => $departments,
                'universityInformation' => $universityInformation,
                'universitySocials' => $universitySocials
            ]);
        } catch (\Throwable $th) {
            //throw $th;
            return redirect('/');
        }
    }

    public function viewdepartments(){
        try {
            $departments = Department::where('deleted', '0')
                ->where('status', '1')
                ->where('userid', Auth::user()->id)
                ->get();
            
            $universityInformation = UniversityInformation::where('userid', Auth::user()->id)->first();
            $universitySocials = UniversitySocial::where('userid', Auth::user()->id)->get();
            return view('/university/departments/departments', [
                'departments' => $departments,
                'universityInformation' => $universityInformation,
                'universitySocials' => $universitySocials
            ]);
        } catch (\Throwable $th) {
            //throw $th;
            return redirect('/');
        }
    }
    public function viewprograms($id){
        if(Department::find($id)->where('deleted', '0')->where('status', '1')->exists()){
            try {
                $programs = Program::where('deleted', '0')
                    ->where('status', '1')
                    ->where('userid', Auth::user()->id)
                    ->where('departmentid', $id)
                    ->get();
                
                $universityInformation = UniversityInformation::where('userid', Auth::user()->id)->first();
                $universitySocials = UniversitySocial::where('userid', Auth::user()->id)->get();
                return view('/university/departments/programs', [
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
    public function updatedepartments(Request $request){
       
                $validatedData = $request->validate([
                    'name' => 'required|max:50',
                    'description' => 'required|max:255',
                    'email' => 'required|email|max:100'
                ]);
                try {
                    
                    $eligibilitys = Department::where('id', $request->input('id'))->update([
                        'name' => $request->input('name'),
                        'email' => $request->input('email'),
                        'description' => $request->input('description'),
                        'status' => $request->input('status'),
                      
                    ]);

                    $log = Logs::create([
                        'log' => 'Updated Department University ['.$request->input('name').'].',
                        'description' => 'Updated Department University ['.$request->input('name').'] by #'.Auth::user()->id.' ('.Auth::user()->name.' [university]).',
                        'userid' => Auth::user()->id,
                    ]);
                    return redirect()->back()->with('success', 'Eligibility has been updated');
                } catch (\Throwable $th) {
                  //throw $th;
                  return redirect()->back()->with('error', 'Cannot Update the Eligibility, Check inputs and try again.');
                }
       
    }
    public function savedepartments(Request $request){
        
                $validatedData = $request->validate([
                    'name' => 'required|max:50',
                    'description' => 'required|max:255',
                    'email' => 'required|email|max:100',
                    'cover' => 'image|mimes:jpeg,png,jpg|max:2048|required',
                ]);
                try {
                    $name = time().$request->file('cover')->getClientOriginalName();
                    $url = $request->cover->move(public_path('university/departments/'),$name);
                    
                    
                    $eligibilitys = Department::create([
                        'name' => $request->input('name'),
                        'cover' => $name,
                        'email' => $request->input('email'),
                        'description' => $request->input('description'),
                        'userid' => Auth::user()->id,
                        'universityid' => Auth::user()->universityInformation->id

                    ]);

                    $log = Logs::create([
                        'log' => 'Added Department University ['.$request->input('name').'].',
                        'description' => 'Added Department University ['.$request->input('name').'] by #'.Auth::user()->id.' ('.Auth::user()->name.' [university]).',
                        'userid' => Auth::user()->id,
                    ]);
                    return redirect()->back()->with('success', 'Eligibility has been Added.');
                } catch (\Throwable $th) {
                  //throw $th;
                  return redirect()->back()->with('error', 'Cannot add the Eligibility, Check inputs and try again.');
                }
            
    }
    public function managedepartments(){
        
              try {
                $departments = Department::where('deleted', '0')
                    ->where('userid', Auth::user()->id)
                    ->get();
                
                return view('/university/departments/index', [
                    'departments' => $departments
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
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function show(Department $department)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function edit(Department $department)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Department $department)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy(Department $department)
    {
        //
    }
}
