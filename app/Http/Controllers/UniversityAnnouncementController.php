<?php

namespace App\Http\Controllers;

use App\Logs;
use App\UniversityAnnouncement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UniversityAnnouncementController extends Controller
{
    public function updateannouncements(Request $request){
               
        $validatedData = $request->validate([
            'title' => 'required|max:13',
            'description' => 'required|max:100',
        ]);
        try {
            
            $eligibilitys = UniversityAnnouncement::where('id', $request->input('id'))->update([
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'status' => $request->input('status'),
            ]);

            $log = Logs::create([
                'log' => 'Updated UniversityAnnouncement University ['.$request->input('name').'].',
                'description' => 'Updated UniversityAnnouncement University ['.$request->input('name').'] by #'.Auth::user()->id.' ('.Auth::user()->name.' [university]).',
                'userid' => Auth::user()->id,
            ]);
            return redirect()->back()->with('success', 'UniversityAnnouncement has been updated');
        } catch (\Throwable $th) {
          throw $th;
          //return redirect()->back()->with('error', 'Cannot Update the UniversityAnnouncement!');
        }
    }
    public function saveannouncements(Request $request){
        $validatedData = $request->validate([
            'title' => 'required|max:13',
            'description' => 'required|max:255'
          ]);
          try {
            //dd(Auth::user()->universityInformation->id);
            $eligibilitys = UniversityAnnouncement::create([
              'title' => $request->input('title'),
              'description' => $request->input('description'),
              'userid' => Auth::user()->id,
            ]);
            
            $log = Logs::create([
              'log' => 'Added UniversityAnnouncement University ['.$request->input('name').'].',
              'description' => 'Added UniversityAnnouncement University ['.$request->input('name').'] by #'.Auth::user()->id.' ('.Auth::user()->name.' [university]).',
              'userid' => Auth::user()->id,
            ]);
            return redirect()->back()->with('success', 'UniversityAnnouncement has been Added.');
          } catch (\Throwable $th) {
            throw $th;
            //return redirect()->back()->with('error', 'Cannot add the UniversityAnnouncement!');
          }
    }
    public function manageannouncements(){
        try {
            $universityAnnouncements = UniversityAnnouncement::where('deleted', '0')
                                        ->where('userid', Auth::user()->id)
                                        ->orderBy('created_at', 'DESC')
                                        ->paginate(15);
            return view('/university/university_announcements/index', [
                'universityAnnouncements' => $universityAnnouncements
            ]);
        } catch (\Throwable $th) {
            //throw $th;
            return redirect('/');
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
        try {
            //code...
        } catch (\Throwable $th) {
            //throw $th;
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
     * @param  \App\UniversityAnnouncement  $universityAnnouncement
     * @return \Illuminate\Http\Response
     */
    public function show(UniversityAnnouncement $universityAnnouncement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UniversityAnnouncement  $universityAnnouncement
     * @return \Illuminate\Http\Response
     */
    public function edit(UniversityAnnouncement $universityAnnouncement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UniversityAnnouncement  $universityAnnouncement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UniversityAnnouncement $universityAnnouncement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UniversityAnnouncement  $universityAnnouncement
     * @return \Illuminate\Http\Response
     */
    public function destroy(UniversityAnnouncement $universityAnnouncement)
    {
        //
    }
}
