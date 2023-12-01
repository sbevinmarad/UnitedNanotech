<?php

namespace App\Http\Livewire\Admin\SubCategory;

use Str;
use Image;
use Livewire\Component;
use App\Models\SubCategory;
use App\Models\Category;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
use App\Http\Livewire\Traits\AlertMessage;

class SubCategoryCreateEdit extends Component
{

	use AlertMessage,WithFileUploads;
    public $name,$active=1,$image,$sub_category, $category_id;
    public $isEdit=false;
    public $statusList=[],$categoryList=[];

    public function mount($sub_category = null)
    {
        if ($sub_category) {
            $this->sub_category = $sub_category;
            $this->fill($this->sub_category);
            $this->isEdit=true;
        }
        else
            $this->sub_category=new SubCategory;
        
        $this->statusList=[
            ['value'=>"", 'text'=> "Select Status"],
            ['value'=>1, 'text'=> "Active"],
            ['value'=>0, 'text'=> "Inactive"]
        ];

        $this->categoryList = Category::where('active', 1)->orderBy('name')->get();
    }
    public function validationRuleForSave(): array
    {
        return
            [
                'name'=>['required',Rule::unique('sub_categories')->where(function($query) {
                  $query->where('category_id', '=', $this->category_id);
              })],
                'category_id'=>['required'],
                'active'=>['required'],
            ];
    }
    public function validationRuleForUpdate(): array
    {
        return[
        		'name'=>['required',Rule::unique('sub_categories')->where(function($query) {
                  $query->where('category_id', '=', $this->category_id);
              })->ignore($this->sub_category->id)],
                'category_id'=>['required'],
                'active'=>['required'],
            ];
    }

    public function saveOrUpdate()
    {
        $this->sub_category->fill($this->validate($this->isEdit ? $this->validationRuleForUpdate() : $this->validationRuleForSave()))->save();

        
        
        $this->sub_category->update(['slug' =>Str::slug($this->name)]);
        $msgAction = 'Category was '. ($this->isEdit ? 'updated' : 'added') . ' successfully';
        $this->showToastr("success",$msgAction);

        return redirect()->route('sub-categories.index');
    }
    public function render()
    {
        return view('livewire.admin.sub-category.sub-category-create-edit');
    }
}
