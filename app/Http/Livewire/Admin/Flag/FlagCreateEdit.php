<?php

namespace App\Http\Livewire\Admin\Flag;

use Str;
use Image;
use Livewire\Component;
use App\Models\Flag;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
use App\Http\Livewire\Traits\AlertMessage;

class FlagCreateEdit extends Component
{
	use AlertMessage,WithFileUploads;
    public $name,$active=1,$image,$flag;
    public $isEdit=false;
    public $statusList=[];

    public function mount($flag = null)
    {
        if ($flag) {
            $this->flag = $flag;
            $this->fill($this->flag);
            $this->isEdit=true;
        }
        else
            $this->flag=new Flag;
        
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
                'name'=>['required',Rule::unique('flags')],
                'active'=>['required'],
                'image'=>['required'],
            ];
    }
    public function validationRuleForUpdate(): array
    {
        return[
        		'name'=>['required',Rule::unique('flags')->ignore($this->flag->id)],
                'active'=>['required'],
                'image'=>['required'],
            ];
    }

    public function saveOrUpdate()
    {
        $this->flag->fill($this->validate($this->isEdit ? $this->validationRuleForUpdate() : $this->validationRuleForSave()))->save();

        if(gettype($this->image) != 'string'){
            $image = time() . '-' . rand(1000, 9999) . '.' . $this->image->getClientOriginalExtension(); 
            $this->image->storeAs('public/flag_images',$image);
            $fileName = 'flag_images/'.$image;
            if(isset($this->flag->image))
        	{
        		@unlink(storage_path('app/public/' .$this->flag->image));
        	}
        }
        else{

            $fileName = $this->flag->image;
        } 
        $this->flag->update([
        	'image' => $fileName
        ]);
        
        $msgAction = 'Flag was '. ($this->isEdit ? 'updated' : 'added') . ' successfully';
        $this->showToastr("success",$msgAction);

        return redirect()->route('flags.index');
    }
    public function render()
    {
        return view('livewire.admin.flag.flag-create-edit');
    }
}
