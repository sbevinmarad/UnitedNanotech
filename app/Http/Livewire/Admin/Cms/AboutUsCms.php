<?php

namespace App\Http\Livewire\Admin\Cms;

use Str;
use Livewire\Component;
use App\Models\Cms;
use App\Models\CmsDetails;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
use Illuminate\Support\Collection;
use App\Http\Livewire\Traits\AlertMessage;

class AboutUsCms extends Component
{
    use AlertMessage,WithFileUploads;
    public $title,$active,$cms, $description, $sub_title, $description_1, $description_2, $image_1, $description_3, $description_4, $content_7, $content_8, $cms_data, $content_9,$image_2, $image_3, $image_4, $youtube_link;
    public $isEdit=false;
    public $statusList=[], $cmsDetails =[];

    public function mount($cms = null)
    {
        if ($cms) {
            $this->cms = $cms;
            $this->fill($this->cms);
            $this->isEdit=true;
        }
        else
            $this->cms=new Cms;

    }

    
    public function validationRuleForUpdate(): array
    {
        return[
                'description'=>['nullable'],
                'image_1'=>['required'],
                'image_2'=>['required'],
            ];
    }

    public function saveOrUpdate()
    {
        $this->validate($this->validationRuleForUpdate());

        
        if(gettype($this->image_1) != 'string'){
            $image = time() . '-' . rand(1000, 9999) . '.' . $this->image_1->getClientOriginalExtension();       
            $this->image_1->storeAs('public/cms_images',$image);
            $fileName = 'cms_images/'.$image;
            if(isset($this->cms->image_1))
            {
                @unlink(storage_path('app/public/' .$this->cms->image_1));
            }
        }
        else{

            $fileName = $this->cms->image_1;
        }

        if(gettype($this->image_2) != 'string'){
            $image = time() . '-' . rand(1000, 9999) . '.' . $this->image_2->getClientOriginalExtension();       
            $this->image_2->storeAs('public/cms_images',$image);
            $fileName2 = 'cms_images/'.$image;
            if(isset($this->cms->image_2))
            {
                @unlink(storage_path('app/public/' .$this->cms->image_2));
            }
        }
        else{

            $fileName2 = $this->cms->image_2;
        }
        

        
        $this->cms->update([
            'description' => $this->description,
            'image_1' => $fileName,
            'image_2' => $fileName2,
            
        ]);

        
        
        $msgAction = 'Cms was '. ($this->isEdit ? 'updated' : 'added') . ' successfully';
        $this->showToastr("success",$msgAction);

        return redirect()->route('cms.index');
    }
    public function render()
    {
        return view('livewire.admin.cms.about-us-cms');
    }
}
