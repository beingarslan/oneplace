<?php

namespace App\Http\Controllers;

use App\Logs;
use App\Social;
use App\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SocialController extends Controller
{
    public function updatesocials(Request $request){
        
              try {
                $validatedData = $request->validate([
                    'name' => 'required|max:100',
                    'icon' => 'required|max:100',
                    'tag' => 'required|max:100'
                  ]);
                $socials = Social::where('id', $request->input('id'))->update([
                    'name' => $request->input('name'),
                    'icon' => $request->input('icon'),
                    'tag' => $request->input('tag'),
                ]);
                $log = Logs::create([
                    'log' => 'Social ['.$request->input('name').'] Updated.',
                    'description' => 'Social ['.$request->input('name').'] Updated by #'.Auth::user()->id.' ('.Auth::user()->name.' [admin]).',
                    'userid' => Auth::user()->id,
                  ]);
                  return redirect()->back()->with('success', 'Social has been updated has been updated');
              } catch (\Throwable $th) {
                //throw $th;
                
                return redirect()->back()->with('error', 'Cannot update Social, try again.');
              }
    
    }
    public function savesocials(Request $request){
        
              try {
                $validatedData = $request->validate([
                    'name' => 'required|max:100',
                    'icon' => 'required|max:100',
                    'tag' => 'required|max:100'
                  ]);
                $socials = Social::create($validatedData);

                $log = Logs::create([
                    'log' => 'Social ['.$request->input('name').'] Added.',
                    'description' => 'Social ['.$request->input('name').'] Added by #'.Auth::user()->id.' ('.Auth::user()->name.' [admin]).',
                    'userid' => Auth::user()->id,
                  ]);
                  return redirect()->back()->with('success', 'Social has been added has been updated');
              } catch (\Throwable $th) {
                //throw $th;
                
                return redirect()->back()->with('error', 'Cannot add Social, try again.');
              }
     
    }
    public function managesocials(){
       
              try {
                  
                $socials = Social::where('status', '1')->where('deleted', '0')->get();
                return view('/admin/socials/index', [
                    'socials' => $socials
                ]);
              } catch (\Throwable $th) {
                throw $th;
                //abort(404);
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
     * @param  \App\Social  $social
     * @return \Illuminate\Http\Response
     */
    public function show(Social $social)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Social  $social
     * @return \Illuminate\Http\Response
     */
    public function edit(Social $social)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Social  $social
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Social $social)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Social  $social
     * @return \Illuminate\Http\Response
     */
    public function destroy(Social $social)
    {
        //
    }
}
