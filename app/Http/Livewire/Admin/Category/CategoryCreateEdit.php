<?php

namespace App\Http\Livewire\Admin\Category;

use Str;
use Image;
use Livewire\Component;
use App\Models\Category;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
use App\Http\Livewire\Traits\AlertMessage;

class CategoryCreateEdit extends Component
{
	use AlertMessage,WithFileUploads;
    public $name,$active=1,$image,$category, $description;
    public $isEdit=false;
    public $statusList=[];

    public function mount($category = null)
    {
        if ($category) {
            $this->category = $category;
            $this->fill($this->category);
            $this->isEdit=true;
        }
        else
            $this->category=new Category;
        
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
                'name'=>['required',Rule::unique('categories')],
                'image'=>['required'],
                'description'=>['required'],
                'active'=>['required'],
            ];
    }
    public function validationRuleForUpdate(): array
    {
        return[
        		'name'=>['required',Rule::unique('categories')->ignore($this->category->id)],
                'image'=>['required'],
                'description'=>['required'],
                'active'=>['required'],
            ];
    }

    public function saveOrUpdate()
    {
        $this->category->fill($this->validate($this->isEdit ? $this->validationRuleForUpdate() : $this->validationRuleForSave()))->save();

        if(gettype($this->image) != 'string'){
            $image = time() . '-' . rand(1000, 9999) . '.' . $this->image->getClientOriginalExtension(); 
            $this->image->storeAs('public/category_images',$image);
            $fileName = 'category_images/'.$image;
            if(isset($this->category->image))
        	{
        		@unlink(storage_path('app/public/' .$this->category->image));
        	}
        }
        else{

            $fileName = $this->category->image;
        } 
        $this->category->update([
        	'image' => $fileName,
        	'slug' =>Str::slug($this->name)
        ]);
        
        $msgAction = 'Category was '. ($this->isEdit ? 'updated' : 'added') . ' successfully';
        $this->showToastr("success",$msgAction);

        return redirect()->route('categories.index');
    }
    public function render()
    {
        return view('livewire.admin.category.category-create-edit');
    }
}
