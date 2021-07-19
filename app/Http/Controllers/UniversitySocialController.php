<?php

namespace App\Http\Controllers;

use App\Logs;
use App\Social;
use App\UniversitySocial;
use App\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UniversitySocialController extends Controller
{
    public function saveuniversitysocials(Request $request){
        
              try {
                
                $socials = Social::where('status', '1')->where('deleted', '0')->get();
                
                foreach ($socials as $value) {
                  $name = UniversitySocial::updateOrCreate([
                    //Add unique field combo to match here
                    //For example, perhaps you only want one entry per user:
                    'userid'   => Auth::user()->id,
                    'socialid' => $value->id,
                  ],[
                      'url'     => $request->get('social'.$value->id),
                      'userid' => Auth::user()->id,
                      'universityid' => Auth::user()->universityInformation->id,
                      'socialid' => $value->id                      
                  ]);                  
                }
        
                
                
                $log = Logs::create([
                  'log' => 'Updated Socials University ['.Auth::user()->name.'].',
                  'description' => 'Update Socials University ['.Auth::user()->name.'] Requested by #'.Auth::user()->id.' ('.Auth::user()->name.' [university]).',
                  'userid' => Auth::user()->id,
                ]);
                return redirect()->back()->with('success', 'Socials has been updated has been updated');
              } catch (\Throwable $th) {
                //dd($th);
                return redirect()->back()->with('error', 'Cannot update the Socials, try again.');
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
     * @param  \App\UniversitySocial  $universitySocial
     * @return \Illuminate\Http\Response
     */
    public function show(UniversitySocial $universitySocial)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UniversitySocial  $universitySocial
     * @return \Illuminate\Http\Response
     */
    public function edit(UniversitySocial $universitySocial)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UniversitySocial  $universitySocial
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UniversitySocial $universitySocial)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UniversitySocial  $universitySocial
     * @return \Illuminate\Http\Response
     */
    public function destroy(UniversitySocial $universitySocial)
    {
        //
    }
}
