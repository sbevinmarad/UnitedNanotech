<?php

namespace App\Http\Livewire\Admin\Address;

use Str;
use Image;
use Livewire\Component;
use App\Models\Address;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
use App\Http\Livewire\Traits\AlertMessage;

class AddressCreateEdit extends Component
{
	use AlertMessage,WithFileUploads;
    public $title,$active=1,$address_details,$address, $opening_hour;
    public $isEdit=false;
    public $statusList=[];

    public function mount($address = null)
    {
        if ($address) {
            $this->address = $address;
            $this->fill($this->address);
            $this->isEdit=true;
        }
        else
            $this->address=new Address;
        
        $this->statusList=[
            ['value'=>"", 'text'=> "Select Status"],
            ['value'=>1, 'text'=> "Active"],
            ['value'=>0, 'text'=> "Inactive"]
        ];
    }
    public function validationRuleForSave(): array
    {
        return
            [
                'title'=>['required'],
                'active'=>['required'],
                'address_details'=>['required'],
                'opening_hour'=>['required'],
            ];
    }
    public function validationRuleForUpdate(): array
    {
        return[
        		'title'=>['required'],
                'active'=>['required'],
                'address_details'=>['required'],
                'opening_hour'=>['required'],
            ];
    }

    public function saveOrUpdate()
    {
        $this->address->fill($this->validate($this->isEdit ? $this->validationRuleForUpdate() : $this->validationRuleForSave()))->save();

        
        
        $msgAction = 'Address was '. ($this->isEdit ? 'updated' : 'added') . ' successfully';
        $this->showToastr("success",$msgAction);

        return redirect()->route('addresses.index');
    }
    public function render()
    {
        return view('livewire.admin.address.address-create-edit');
    }
}
