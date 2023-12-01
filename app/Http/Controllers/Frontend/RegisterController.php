<?php

namespace App\Http\Controllers\Frontend;

use Mail;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use App\Rules\FullNameRule;
use App\Mail\RegistrationMail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function registerView(Request $request)
    {
        if(Auth::user() && Auth::user()->hasRole('CLIENT'))
        {
            return redirect()->route('home');
        }
        $data['title'] = 'Sign Up';
        return view('frontend.pages.register', $data);
    }
    public function register(Request $request)
	{
		$rules = [
            'name' => 'required',
            'term_condition' => 'required',
            'phone' => 'required|unique:users',
            'email' => 'required|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,4}$/ix|unique:users',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $validator_error = $validator->errors();
            return response ()->json (['error'=>$validator_error,'code'=>0]);
        }

        $first_name = '';
		$last_name = null;
		$full_name = explode(" ",$request->name);
		$first_name = $full_name[0];
		if(count($full_name)>1)
		{
			$last_name = $full_name[1];
		}
        try {
            $user = User::create([
            	'first_name' => $first_name,
            	'last_name' => $last_name,
            	'name' => $request->name,
                'email' => $request->email,
            	'phone' => $request->phone,
            	'password' => $request->password,
            ]);
            $user->assignRole('CLIENT');


            $data['name'] = $user->full_name;
            $data['email'] = $user->email;
            Mail::to($user->email)->send(new RegistrationMail($data));
            Auth::login($user, true);
            Session::flash('success','Registration Successfully');
            return response ()->json (['code'=>1]);

        } catch (\Exception $e) {
        	return redirect()->back()->with('error',$e->getMessage());
        }
	}
}
