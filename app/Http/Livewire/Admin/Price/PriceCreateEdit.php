<?php

namespace App\Http\Livewire\Admin\Price;
use Str;
use Livewire\Component;
use App\Models\PricePlan;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
use App\Http\Livewire\Traits\AlertMessage;

class PriceCreateEdit extends Component
{
	use AlertMessage,WithFileUploads;
    public $name,$active=1,$image, $client_desc, $description, $price;
    public $isEdit=false;
    public $statusList=[], $ratingList=[];

    public function mount($price_plan = null)
    {
        if ($price_plan) {
            $this->price_plan = $price_plan;
            $this->fill($this->price_plan);
            $this->isEdit=true;
        }
        else
            $this->price_plan=new PricePlan;

        
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
                'name'=>['required',Rule::unique('price_plans')],
                'image'=>['required'],
                'active'=>['required'],
                'description'=>['nullable'],
                'price'=>['required', 'numeric'],
            ];
    }
    public function validationRuleForUpdate(): array
    {
        return[
                'name'=>['required',  Rule::unique('price_plans')->ignore($this->price_plan->id)],
                'image'=>['required'],
                'active'=>['required'],
                'description'=>['nullable'],
                'price'=>['required', 'numeric'],
            ];
    }

    public function saveOrUpdate()
    {
        $this->price_plan->fill($this->validate($this->isEdit ? $this->validationRuleForUpdate() : $this->validationRuleForSave()))->save();

        if(isset($this->image) && gettype($this->image) != 'string'){
            $image = time() . '-' . rand(1000, 9999) . '.' . $this->image->getClientOriginalExtension();       
            $this->image->storeAs('public/price_images',$image);
            $fileName = 'price_images/'.$image;
            if(isset($this->price_plan->image))
            {
                @unlink(storage_path('app/public/' .$this->price_plan->image));
            }
        }
        else{

            $fileName = $this->price_plan->image;
        } 
        

        $this->price_plan->update([
            'image' => $fileName,
        ]);

        
        $msgAction = 'Price was '. ($this->isEdit ? 'updated' : 'added') . ' successfully';
        $this->showToastr("success",$msgAction);

        return redirect()->route('price-plans.index');
    }
    public function render()
    {
        return view('livewire.admin.price.price-create-edit');
    }
}
