<?php

namespace App\Http\Livewire\Admin\Settings;

use Str;
use Livewire\Component;
use App\Models\Setting;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
use App\Http\Livewire\Traits\AlertMessage;

class SettingsEdit extends Component
{
    use AlertMessage,WithFileUploads;
    public $address, $stripe_key, $email, $email_2, $phone,$phone_2, $stripe_secret, $map, $logo,$setting, $opening_hour, $shipping_charge, $tax, $razor_pay_key, $razor_pay_secret, $payment_mode, $isEdit=false, $address_2, $footer_logo, $gst,$google_recaptcha_key, $google_recaptcha_secret;
    public $modeList =[];
    public function mount($setting = null)
    {
        if ($setting) {
            $this->setting = $setting;
            $this->fill($this->setting);
            $this->isEdit=true;
        }
        else
            $this->setting=new Setting;

        $this->modeList=[
            ['value'=>"", 'text'=> "Select Status"],
            ['value'=>'Sandbox', 'text'=> "Sandbox"],
            ['value'=>'Live', 'text'=> "Live"]
        ];
        
    }
    
    public function validationRuleForUpdate(): array
    {
        return[
                'email'=>['required','email','regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix'],
                'phone'=>['required'],
                'phone_2'=>['required'],
                'address'=>['required'],
                'address_2'=>['required'],
                'logo'=>['required'],
                'google_recaptcha_key'=>['required'],
                'google_recaptcha_secret'=>['required'],
                'map'=>['required'],
            ];
    }

    public function saveOrUpdate()
    {
        $this->setting->fill($this->validate($this->validationRuleForUpdate()))->save();

        if(gettype($this->logo) != 'string'){
            $image = time() . '-' . rand(1000, 9999) . '.' . $this->logo->getClientOriginalExtension();       
            $this->logo->storeAs('public/images',$image);
            $fileName = 'images/'.$image;
            if(isset($this->setting->logo))
            {
                @unlink(storage_path('app/public/' .$this->setting->logo));
            }
        }
        else{

            $fileName = $this->setting->logo;
        } 

        

        $this->setting->update([
            'logo' => $fileName,
        ]);
        
        $msgAction = 'Setting was '. ($this->isEdit ? 'updated' : 'added') . ' successfully';
        $this->showToastr("success",$msgAction);

        return redirect()->route('settings.edit');
    }

    public function render()
    {
        return view('livewire.admin.settings.settings-edit');
    }
}
