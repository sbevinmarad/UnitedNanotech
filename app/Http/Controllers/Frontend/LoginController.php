<?php

namespace App\Http\Controllers\Frontend;

use Auth;
use Hash;
use Log;
use Validator;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function loginView(Request $request)
    {
        if(Auth::user() && Auth::user()->hasRole('CLIENT'))
        {
            return redirect()->route('home');
        }
        $data['title'] = 'Login';
        return view('frontend.pages.login', $data);
    }
    public function login(Request $request)
    {
    	$rules = [
            'email' => 'required',
            'password' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(["error" => $validator->errors(),'code'=>0]);
        }
        try {

            $user = User::role('CLIENT')->where(['email'=> $request->email,'active' => 1])->first();

            if (!$user || !Hash::check($request->password, $user->password)) {
                $deactive_user = User::where(['email'=> $request->email,'active' => 0])->exists();

                if($deactive_user){
                    return response ()->json (['error'=>['custom_error' => 'User is not active.Please contact to admin'],'code'=>0]);
                }
                else{
                    return response ()->json (['error'=>['custom_error' => 'Your email/password combination was incorrect.'],'code'=>0]);
                }
            }
            else{
                $credentials = ['email' => $request->email, 'password' => $request->password, 'active' => 1];

                if (\Illuminate\Support\Facades\Auth::attempt($credentials)) {
                    Session::flash('success','Logged In Successfully');
                    return response ()->json (['code'=>1]);
                }
            }

        } catch (\Exception $e) {
            Log::error(" :: EXCEPTION :: " . $e->getMessage() . "\n" . $e->getTraceAsString());
            abort(500);
        }
    }

    public function logout(Request $request)
    {
      Auth::logout();
      return redirect()->route('home')->with('success','Logout Successfully');
    }
}
