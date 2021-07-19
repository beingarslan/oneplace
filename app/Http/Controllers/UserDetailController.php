<?php

namespace App\Http\Controllers;

use App\User;
use App\UserDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserDetailController extends Controller
{
    public function detailsedit(){
        $userDetail = UserDetail::where('userid', Auth::user()->id)->first();

        return view('user/profile/userdetails', [
            'userDetail' => $userDetail
        ]);
    }
    public function updateprofile(Request $request){
        $validatedData = $request->validate([
            'full_name' => 'required|max:100',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:17',
            'city' => 'required|max:100',
            'address' => 'required|max:200',
            'gender' => 'required|max:100',
            'ssc_degree' => 'required|max:100',
            'ssc_board' => 'required|max:100',
            'ssc_institue' => 'required|max:100',
            'ssc_passing_year' => 'required|max:100',
            'ssc_roll_number' => 'required|max:100',
            'ssc_obt_marks' => 'required|max:100',
            'ssc_total_marks' => 'required|max:100',
            'hssc_degree' => 'required|max:100',
            'hssc_group' => 'required|max:100',
            'hssc_board' => 'required|max:100',
            'hssc_institue' => 'required|max:100',
            'hssc_passing_year' => 'required|max:100',
            'hssc_roll_number' => 'required|max:100',
            'hssc_obt_marks' => 'required|max:100',
            'hssc_total_marks' => 'required|max:100',
        ]);
        try {
            //dd($request);
            // $ssc_document = time() . $request->file('ssc_document')->getClientOriginalName();
            // $url = $request->ssc_document->move(public_path('user/ssc_document/'), $ssc_document);

            // $hssc_document = time() . $request->file('hssc_document')->getClientOriginalName();
            // $url = $request->hssc_document->move(public_path('user/hssc_document/'), $hssc_document);

            
            $name = UserDetail::where('userid', Auth::user()->id)->update(
                [
                    'full_name' => $request->input('full_name'),
                    'phone' => $request->input('phone'),
                    'city' => $request->input('city'),
                    'address' => $request->input('address'),
                    'gender' => $request->input('gender'),
                    'ssc_degree' => $request->input('ssc_degree'),
                    'ssc_board' => $request->input('ssc_board'),
                    'ssc_institue' => $request->input('ssc_institue'),
                    'ssc_passing_year' => $request->input('ssc_passing_year'),
                    'ssc_passing_year' => $request->input('ssc_passing_year'),
                    'ssc_roll_number' => $request->input('ssc_roll_number'),
                    'ssc_obt_marks' => $request->input('ssc_obt_marks'),
                    'ssc_total_marks' => $request->input('ssc_total_marks'),
                    'hssc_degree' => $request->input('hssc_degree'),
                    'hssc_group' => $request->input('hssc_group'),
                    'hssc_board' => $request->input('hssc_board'),
                    'hssc_institue' => $request->input('hssc_institue'),
                    'hssc_passing_year' => $request->input('hssc_passing_year'),
                    'hssc_roll_number' => $request->input('hssc_roll_number'),
                    'hssc_obt_marks' => $request->input('hssc_obt_marks'),
                    'hssc_total_marks' => $request->input('hssc_total_marks'),
                ]
            );

            $user = User::where('id', Auth::user()->id)->update([
                'profile' => "Complete"
            ]);
  
            
           
            return redirect()->back()->with('success', 'Profile has been updated has been updated');
          } catch (\Throwable $th) {
            throw $th;
            //return redirect()->back()->with('error', 'Cannot update the profile, try again.');
          }
    }
    public function uploadlogo(Request $request)
    {

        try {
            //dd($request);
            $validatedData = $request->validate([
                'logo' => 'mimes:jpeg,png,jpg,pdf|max:2048',
            ]);
            $name = time() . $request->file('logo')->getClientOriginalName();
            $url = $request->logo->move(public_path('user/logo/'), $name);

            $request_updated = UserDetail::where('userid', $request->input('userid'))->update([
                'image' => $name
            ]);
            
            return redirect()->back()->with('success', 'Logo has been updated');
        } catch (\Throwable $th) {
            throw $th;
            //return redirect()->back()->with('error', 'Cannot upload the logo');
        }
    }
}
