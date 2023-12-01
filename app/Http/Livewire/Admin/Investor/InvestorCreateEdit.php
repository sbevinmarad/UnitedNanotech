<?php

namespace App\Http\Livewire\Admin\Investor;

use Str;
use Image;
use Livewire\Component;
use App\Models\Investor;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
use App\Http\Livewire\Traits\AlertMessage;

class InvestorCreateEdit extends Component
{
	use AlertMessage,WithFileUploads;
    public $name,$active=1,$image,$investor;
    public $isEdit=false;
    public $statusList=[];

    public function mount($investor = null)
    {
        if ($investor) {
            $this->investor = $investor;
            $this->fill($this->investor);
            $this->isEdit=true;
        }
        else
            $this->investor=new investor;
        
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
                'name'=>['nullable'],
                'active'=>['required'],
                'image'=>['required'],
            ];
    }
    public function validationRuleForUpdate(): array
    {
        return[
        		'name'=>['nullable'],
                'active'=>['required'],
                'image'=>['required'],
            ];
    }

    public function saveOrUpdate()
    {
        $this->investor->fill($this->validate($this->isEdit ? $this->validationRuleForUpdate() : $this->validationRuleForSave()))->save();

        if(gettype($this->image) != 'string'){
            $image = time() . '-' . rand(1000, 9999) . '.' . $this->image->getClientOriginalExtension(); 
            $this->image->storeAs('public/investor_images',$image);
            $fileName = 'investor_images/'.$image;
            if(isset($this->investor->image))
        	{
        		@unlink(storage_path('app/public/' .$this->investor->image));
        	}
        }
        else{

            $fileName = $this->investor->image;
        } 
        $this->investor->update([
        	'image' => $fileName
        ]);
        
        $msgAction = 'Investor was '. ($this->isEdit ? 'updated' : 'added') . ' successfully';
        $this->showToastr("success",$msgAction);

        return redirect()->route('investors.index');
    }
    public function render()
    {
        return view('livewire.admin.investor.investor-create-edit');
    }
}
