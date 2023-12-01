<?php

namespace App\Http\Controllers\Frontend;

use Mail;
use App\Models\Cms;
use App\Models\User;
use App\Models\Seo;
use App\Models\Banner;
use App\Models\Setting;
use App\Models\Slider;
use App\Models\Gallery;
use App\Models\Testimonial;
use App\Models\Category;
use App\Models\Product;
use App\Models\WorkProcess;
use App\Models\Investor;
use App\Rules\Recaptcha;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\ContactMailSendToUser;
use App\Mail\ContactMailSendToAdmin;
use App\Mail\CarrerMail;
use App\Mail\BookingMailToAdmin;
use App\Mail\BookingMailToUser;
class HomeController extends Controller
{
	public function index()
    {
    	$data['title'] = 'Home';
        $data['banner'] = Banner::where('slug','home')->where('active', 1)->first();
        $data['seo'] = Seo::where('slug','home')->first();
        $data['homeCms'] = Cms::where('active', 1)->where('slug','home')->first();
        $data['aboutUs'] = Cms::where('active', 1)->where('slug','about-us')->first();
        $data['testimonials'] = Testimonial::where('active', 1)->latest()->get();
        
        $data['products'] = Product::where('active', 1)->orderBy('id', 'asc')->take(6)->get();
        $data['galleries'] = Gallery::where('active', 1)->orderBy('id', 'asc')->take(6)->get();
        $data['categories'] = Category::where('active', 1)->orderBy('id', 'asc')->take(4)->get();
        $data['sliders'] = Slider::where('active', 1)->latest()->get();
        
    	return view('frontend.pages.home', $data);
    }

    

    public function contactUs()
    {
    	$data['title'] = 'Contact Us';
        $data['homeCms'] = Cms::with('cmsGalleries')->where('active', 1)->where('slug','home')->first();
        $data['banner'] = Banner::where('slug','contact-us')->where('active', 1)->first();
        $data['seo'] = Seo::where('slug','contact-us')->first();
        $data['contactUs'] = Cms::where('active', 1)->where('slug','contact-us')->first();
    	return view('frontend.pages.contact_us', $data);
    }

    

    public function visionStatement()
    {
        $data['banner'] = Banner::where('slug','vision-statement')->where('active', 1)->first();
        $data['seo'] = Seo::where('slug','vision-statement')->first();
        $data['cms'] = Cms::where('active', 1)->where('slug','vision-statement')->first();
        return view('frontend.pages.vision_statement', $data);
    }

    public function missionStatement()
    {
        $data['seo'] = Seo::where('slug','mission-statement')->first();
        $data['cms'] = Cms::where('active', 1)->where('slug','mission-statement')->first();
        $data['banner'] = Banner::where('slug','mission-statement')->where('active', 1)->first();
        return view('frontend.pages.mission_statement', $data);
    }

    public function founderMessage()
    {
        $data['banner'] = Banner::where('slug','founder-message')->where('active', 1)->first();
        $data['seo'] = Seo::where('slug','founder-message')->first();
        $data['cms'] = Cms::where('active', 1)->where('slug','founder-message')->first();
        return view('frontend.pages.founder_message', $data);
    }

    public function ourTeam()
    {
        $data['banner'] = Banner::where('slug','our-team')->where('active', 1)->first();
        $data['seo'] = Seo::where('slug','our-team')->first();
        $data['cms'] = Cms::where('active', 1)->where('slug','our-team')->first();
        return view('frontend.pages.our_team', $data);
    }
    public function investors()
    {
        $data['banner'] = Banner::where('slug','investors')->where('active', 1)->first();
        $data['seo'] = Seo::where('slug','investors')->first();
        $data['investors'] = Investor::where('active', 1)->orderBy('id','asc')->get();
        return view('frontend.pages.investors', $data);
    }

    public function ourClients()
    {
        $data['banner'] = Banner::where('slug','our-clients')->where('active', 1)->first();
        $data['seo'] = Seo::where('slug','our-clients')->first();
        $data['cms'] = Cms::where('active', 1)->where('slug','our-clients')->first();
        return view('frontend.pages.our_clients', $data);
    }

    public function ourPresence()
    {
        $data['banner'] = Banner::where('slug','our-presence')->where('active', 1)->first();
        $data['seo'] = Seo::where('slug','our-presence')->first();
        $data['cms'] = Cms::where('active', 1)->where('slug','our-presence')->first();
        return view('frontend.pages.our_presence', $data);
    }

    public function infrastructure()
    {
        $data['banner'] = Banner::where('slug','infrastructure')->where('active', 1)->first();
        $data['seo'] = Seo::where('slug','infrastructure')->first();
        $data['cms'] = Cms::where('active', 1)->where('slug','infrastructure')->first();
        return view('frontend.pages.infrastructure', $data);
    }

    public function carrer()
    {
        $data['banner'] = Banner::where('slug','carrer')->where('active', 1)->first();
        $data['seo'] = Seo::where('slug','carrer')->first();
        $data['cms'] = Cms::where('active', 1)->where('slug','carrer')->first();
        return view('frontend.pages.carrer', $data);
    }
   

    public function termCondition()
    {
        $data['title'] = 'Term and Conditions';
        $data['banner'] = Banner::where('slug','terms-and-conditions')->where('active', 1)->first();
        $data['seo'] = Seo::where('slug','terms-and-conditions')->first();
        $data['cms'] = Cms::where('active', 1)->where('slug','terms-and-conditions')->first();
        return view('frontend.pages.term_and_condition', $data);
    }

    

    public function testimonials()
    {
    	$data['title'] = 'testimonials';
        $data['seo'] = Seo::where('slug','testimonials')->first();
        $data['banner'] = Banner::where('slug','testimonials')->where('active', 1)->first();
        $data['testimonials'] = Testimonial::where('active', 1)->latest()->get();
    	return view('frontend.pages.testimonials', $data);
    }

    

    public function gallery()
    {
        $data['title'] = 'galleries';
        $data['seo'] = Seo::where('slug','gallery')->first();
        $data['banner'] = Banner::where('slug','gallery')->where('active', 1)->first();
        $data['galleries'] = Gallery::where('active', 1)->latest()->get();
        return view('frontend.pages.gallery', $data);
    }

    public function contactForm(Request $request)
    {
        $data = $request->validate([
            'name' =>'required',
            'email' =>'required|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,4}$/ix',
            'phone' =>'required',
            'message' =>'required',
            'g-recaptcha-response' =>['required',new Recaptcha()],
        ],['g-recaptcha-response.required' => 'This captcha field is required']);

        $admin = Setting::first();
        
        
        Mail::to($admin->email)->send(new ContactMailSendToAdmin($data));
                
        
        $mail_data  = ['email' => $request->email];
        Mail::to($request->email)->send(new ContactMailSendToUser($mail_data));

        return redirect()->back()->with('success', 'Mail Send Successfully');

    }

    public function carrerForm(Request $request)
    {
        $data = $request->validate([
            'name' =>'required',
            'email' =>'required|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,4}$/ix',
            'phone' =>'required',
            'document' =>'required',
            'applied_for' =>'required',
            'cover_letter' =>'required',
            'g-recaptcha-response' =>['required',new Recaptcha()],
        ],['g-recaptcha-response.required' => 'This captcha field is required']);

        $admin = Setting::first();
        
        
        Mail::to($admin->email)->send(new CarrerMail($data));
                
        
        $mail_data  = ['email' => $request->email];
        Mail::to($request->email)->send(new ContactMailSendToUser($mail_data));

        return redirect()->back()->with('success', 'Mail Send Successfully');

    }

    
    

}
