<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Setting;
class Recaptcha implements Rule
{
    public $setting;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->setting = Setting::first();
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value) {
        $data = array('secret' => $this->setting->google_recaptcha_secret,
            'response' => $value);
  
        try {
            $verify = curl_init();
            curl_setopt($verify, CURLOPT_URL, 
"https://www.google.com/recaptcha/api/siteverify");
            curl_setopt($verify, CURLOPT_POST, true);
            curl_setopt($verify, CURLOPT_POSTFIELDS, 
                        http_build_query($data));
            curl_setopt($verify, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($verify, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($verify);
  
            return json_decode($response) -> success;
        }
        catch (\Exception $e) {
            return false;
        }
    }
  
    public function message() {
        return 'ReCaptcha verification failed.';
    }
}
