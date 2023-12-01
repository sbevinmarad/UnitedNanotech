<?php

namespace App\Http\Livewire\Admin\Brand;

use Str;
use Image;
use Livewire\Component;
use App\Models\Brand;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
use App\Http\Livewire\Traits\AlertMessage;

class BrandCreateEdit extends Component
{
	use AlertMessage,WithFileUploads;
    public $name,$active=1,$image,$brand;
    public $isEdit=false;
    public $statusList=[];

    public function mount($brand = null)
    {
        if ($brand) {
            $this->brand = $brand;
            $this->fill($this->brand);
            $this->isEdit=true;
        }
        else
            $this->brand=new Brand;
        
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
        $this->brand->fill($this->validate($this->isEdit ? $this->validationRuleForUpdate() : $this->validationRuleForSave()))->save();

        if(gettype($this->image) != 'string'){
            $image = time() . '-' . rand(1000, 9999) . '.' . $this->image->getClientOriginalExtension(); 
            $this->image->storeAs('public/brand_images',$image);
            $fileName = 'brand_images/'.$image;
            if(isset($this->brand->image))
        	{
        		@unlink(storage_path('app/public/' .$this->brand->image));
        	}
        }
        else{

            $fileName = $this->brand->image;
        } 
        $this->brand->update([
        	'image' => $fileName
        ]);
        
        $msgAction = 'Brand was '. ($this->isEdit ? 'updated' : 'added') . ' successfully';
        $this->showToastr("success",$msgAction);

        return redirect()->route('brands.index');
    }
    public function render()
    {
        return view('livewire.admin.brand.brand-create-edit');
    }
}
