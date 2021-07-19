<?php

namespace App\Http\Controllers;

use App\AppliedAdmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppliedAdmissionController extends Controller
{
    public function appliedadmission(Request $request){
        try {
            $application = AppliedAdmission::updateOrCreate(
                [
                    'userid' => Auth::user()->id,
                    'university_addmissionid' => $request->input('univeristy_addmissionid')
                ],
                [
                    'userid' => Auth::user()->id,
                    'university_addmissionid' => $request->input('univeristy_addmissionid')
                ]
            );

            return view('user/appliedadmissions/success', [
                'application' => $application
            ])->with('success', 'Your application has been submitted');
        } catch (\Throwable $th) {
            throw $th;
        }


    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $applications = AppliedAdmission::where('userid', Auth::user()->id)->get();
            return view('user/appliedadmissions/index', [
                'applications' => $applications
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }

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
     * @param  \App\AppliedAdmission  $appliedAdmission
     * @return \Illuminate\Http\Response
     */
    public function show(AppliedAdmission $appliedAdmission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AppliedAdmission  $appliedAdmission
     * @return \Illuminate\Http\Response
     */
    public function edit(AppliedAdmission $appliedAdmission)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AppliedAdmission  $appliedAdmission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AppliedAdmission $appliedAdmission)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AppliedAdmission  $appliedAdmission
     * @return \Illuminate\Http\Response
     */
    public function destroy(AppliedAdmission $appliedAdmission)
    {
        //
    }
}
