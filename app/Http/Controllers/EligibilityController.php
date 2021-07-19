<?php

namespace App\Http\Controllers;

use App\Eligibility;
use App\Logs;
use App\Program;
use App\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EligibilityController extends Controller
{
    public function updateeligibilities(Request $request){
       
                $validatedData = $request->validate([
                    'degree' => 'required|max:50',
                    'marks' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:1|max:100',
                    'description' => 'required|max:100',
                    'programid' => 'required'
                ]);
                try {
                    
                    $eligibilitys = Eligibility::where('id', $request->input('id'))->update([
                        'degree' => $request->input('degree'),
                        'marks' => $request->input('marks'),
                        'description' => $request->input('description'),
                        'status' => $request->input('status'),
                        'programid' => $request->input('programid')

                    ]);

                    $log = Logs::create([
                        'log' => 'Updated Eligibility University ['.$request->input('name').'].',
                        'description' => 'Updated Eligibility University ['.$request->input('name').'] by #'.Auth::user()->id.' ('.Auth::user()->name.' [university]).',
                        'userid' => Auth::user()->id,
                    ]);
                    return redirect()->back()->with('success', 'Eligibility has been updated');
                } catch (\Throwable $th) {
                  //throw $th;
                  return redirect()->back()->with('error', 'Cannot Update the Eligibility, Check inputs and try again.');
                }
  
    }
    public function saveeligibilities(Request $request){
       
                $validatedData = $request->validate([
                    'degree' => 'required|max:50',
                    'marks' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:1|max:100',
                    'description' => 'required|max:100',
                    'programid' => 'required'
                ]);
                try {
                    
                    $eligibilitys = Eligibility::create([
                        'degree' => $request->input('degree'),
                        'marks' => $request->input('marks'),
                        'description' => $request->input('description'),
                        'userid' => Auth::user()->id,
                        'universityid' => Auth::user()->universityInformation->id,
                        'programid' => $request->input('programid')
                    ]);

                    $log = Logs::create([
                        'log' => 'Added Eligibility University ['.$request->input('name').'].',
                        'description' => 'Added Eligibility University ['.$request->input('name').'] by #'.Auth::user()->id.' ('.Auth::user()->name.' [university]).',
                        'userid' => Auth::user()->id,
                    ]);
                    return redirect()->back()->with('success', 'Eligibility has been Added.');
                } catch (\Throwable $th) {
                  //throw $th;
                  return redirect()->back()->with('error', 'Cannot add the Eligibility, Check inputs and try again.');
                }

    }
    public function manageeligibilities(){
        
              try {
                $eligibilitys = Eligibility::where('deleted', '0')
                    ->where('userid', Auth::user()->id)
                    ->get();
                $programs = Program::where('userid', Auth::user()->id)->where('deleted', '0')->where('status', '1')->get();
                
                return view('/university/eligibilities/index', [
                    'eligibilitys' => $eligibilitys,
                    'programs' => $programs
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
     * @param  \App\Eligibility  $eligibility
     * @return \Illuminate\Http\Response
     */
    public function show(Eligibility $eligibility)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Eligibility  $eligibility
     * @return \Illuminate\Http\Response
     */
    public function edit(Eligibility $eligibility)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Eligibility  $eligibility
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Eligibility $eligibility)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Eligibility  $eligibility
     * @return \Illuminate\Http\Response
     */
    public function destroy(Eligibility $eligibility)
    {
        //
    }
}
