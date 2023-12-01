<?php

namespace App\Http\Controllers\Frontend;

use Auth;
use Hash;
use App\Models\Banner;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\User;
use App\Models\State;
use App\Models\Country;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    public function profile()
    {
        $data['title'] = 'My Account';
        $data['user'] = Auth::user();
        $data['banner'] = Banner::where('slug','my-account')->where('active', 1)->first();
        $data['state_list'] = State::get();;
        $data['orders'] = Order::where('user_id',Auth::user()->id)->where('active', 1)->orderBy('id', 'desc')->get();
        /*$data['orders'] = OrderDetails::with('order')->whereRelation('order', 'active', 1)->where('user_id',Auth::user()->id)->orderBy('id', 'desc')->get();*/
        return view('frontend.pages.profile', $data);
    }

    public function changePassword()
    {
        $data['title'] = 'Change Password';
        return view('frontend.pages.change_password', $data);
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required|min:6',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6',
        ]);
        $user = Auth::user();
        if (Hash::check($request->old_password, $user->password)) {
            $user->password = $request->password;
            $user->save();

            return redirect()->route('user.profile')->with('success', 'Password Change Successfully');

        } else {
            return redirect()->route('user.profile')->with('error', 'Invalid old password');
        } 
    }
    public function profileUpdate(Request $request)
    {
    	$user = Auth::user();
    	$data = $request->validate([
    		'name' => 'required',
    		'phone' => 'required|unique:users,phone,'.$user->id,
    		'address' => 'required',
    		'city' => 'required',
    		'pin_code' => 'required',
            'state_id' => 'required',
            'district' => 'required',
    		'road' => 'nullable',
    	]);

    	if($request->hasFile('profile_image')){
            $image = time() . '-' . rand(1000, 9999) . '.' . $request->profile_image->getClientOriginalExtension();       
            $request->profile_image->storeAs('public/profile_images',$image);
            $fileName = 'profile_images/'.$image;
            if(isset($user->profile_photo_path))
            {
                @unlink(storage_path('app/public/' .$user->profile_photo_path));
            }
        }
        else{

            $fileName = $user->profile_photo_path;
        } 

    	$first_name = '';
		$last_name = null;
		$full_name = explode(" ",$request->name);
		$first_name = $full_name[0];
		if(count($full_name)>1)
		{
			$last_name = $full_name[1];
		}
    	$user->update([
    		'first_name' => $first_name,
        	'last_name' => $last_name,
        	'name' => $request->name,
            'phone' => $request->phone,
        	'address' => $request->address,
        	'city' => @$request->city,
        	'profile_photo_path' => $fileName,
        	'pin_code' => @$request->pin_code,
        	'state_id' => @$request->state_id,
        	'district' => @$request->district,
            'road' => @$request->road,
    	]);

    	
        return redirect()->route('user.profile')->with('success','Profile Update Successfully');
    }
}
