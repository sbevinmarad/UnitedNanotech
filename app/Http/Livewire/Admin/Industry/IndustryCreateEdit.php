<?php

namespace App\Http\Livewire\Admin\Industry;

use Str;
use Livewire\Component;
use App\Models\Industry;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
use App\Http\Livewire\Traits\AlertMessage;

class IndustryCreateEdit extends Component
{
	use AlertMessage,WithFileUploads;
    public $name,$active,$image,$industry, $client_desc, $description, $rating;
    public $isEdit=false;
    public $statusList=[], $ratingList=[];

    public function mount($industry = null)
    {
        if ($industry) {
            $this->industry = $industry;
            $this->fill($this->industry);
            $this->isEdit=true;
        }
        else
            $this->industry=new Industry;

        
        
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
                'name' => ['required',Rule::unique('industries')],
                'image'=>['required'],
                'active'=>['required'],
            ];
    }
    public function validationRuleForUpdate(): array
    {
        return[
                'name' => ['required',  Rule::unique('industries')->ignore($this->industry->id)],
                'image'=>['required'],
                'active'=>['required'],
            ];
    }

    public function saveOrUpdate()
    {
        $this->industry->fill($this->validate($this->isEdit ? $this->validationRuleForUpdate() : $this->validationRuleForSave()))->save();

        if(gettype($this->image) != 'string'){
            $image = time() . '-' . rand(1000, 9999) . '.' . $this->image->getClientOriginalExtension();       
            $this->image->storeAs('public/industry_images',$image);
            $fileName = 'industry_images/'.$image;
            if(isset($this->industry->image))
        	{
        		@unlink(storage_path('app/public/' .$this->industry->image));
        	}
        }
        else{

            $fileName = $this->industry->image;
        } 
        $this->industry->update(['image' => $fileName]);
        
        $msgAction = 'Industry was '. ($this->isEdit ? 'updated' : 'added') . ' successfully';
        $this->showToastr("success",$msgAction);

        return redirect()->route('industries.index');
    }
    public function render()
    {
        return view('livewire.admin.industry.industry-create-edit');
    }
}
