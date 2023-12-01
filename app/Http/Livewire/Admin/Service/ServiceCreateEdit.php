<?php

namespace App\Http\Livewire\Admin\Service;

use Str;
use Livewire\Component;
use App\Models\Service;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
use App\Http\Livewire\Traits\AlertMessage;

class ServiceCreateEdit extends Component
{

	use AlertMessage,WithFileUploads;
    public $name,$active=1,$image,$service, $description, $rating;
    public $isEdit=false;
    public $statusList=[], $ratingList=[];

    public function mount($service = null)
    {
        if ($service) {
            $this->service = $service;
            $this->fill($this->service);
            $this->isEdit=true;
        }
        else
            $this->service=new Service;

        
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
                'name' => ['required', Rule::unique('services')],
                'image'=>['required'],
                'description'=>['nullable'],
                'active'=>['required'],
            ];
    }
    public function validationRuleForUpdate(): array
    {
        return[
                'name' => ['required',  Rule::unique('services')->ignore($this->service->id)],
                'image'=>['required'],
                'description'=>['nullable'],
                'active'=>['required'],
            ];
    }

    public function saveOrUpdate()
    {
        $this->service->fill($this->validate($this->isEdit ? $this->validationRuleForUpdate() : $this->validationRuleForSave()))->save();

        if(gettype($this->image) != 'string'){
            $image = time() . '-' . rand(1000, 9999) . '.' . $this->image->getClientOriginalExtension();       
            $this->image->storeAs('public/service_images',$image);
            $fileName = 'service_images/'.$image;
            if(isset($this->service->image))
        	{
        		@unlink(storage_path('app/public/' .$this->service->image));
        	}
        }
        else{

            $fileName = $this->service->image;
        } 
        $this->service->update([
        	'image' => $fileName,
        	'slug'=> Str::slug($this->name),
        ]);
        
        $msgAction = 'Service was '. ($this->isEdit ? 'updated' : 'added') . ' successfully';
        $this->showToastr("success",$msgAction);

        return redirect()->route('services.index');
    }
    public function render()
    {
        return view('livewire.admin.service.service-create-edit');
    }
}
