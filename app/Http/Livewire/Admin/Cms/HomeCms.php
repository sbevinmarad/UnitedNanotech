<?php

namespace App\Http\Livewire\Admin\Cms;

use Str;
use App\Models\Cms;
use Livewire\Component;
use App\Models\CmsGallery;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
use Illuminate\Support\Collection;
use App\Http\Livewire\Traits\AlertMessage;

class HomeCms extends Component
{
	use AlertMessage,WithFileUploads;
    public $title,$active,$image,$cms, $image_1,$image_2, $image_3,$image_4,$image_5,$image_6, $image_7,$image_8,$image_9, $video_link;
    public $isEdit=false;
    public $description, $description_1, $description_2, $description_3, $description_4,$description_5, $description_6, $description_7, $description_8, $description_9;
    protected $listeners = ['deleteConfirm', 'changeStatus'];

    public function mount($cms = null)
    {
        if ($cms) {
            $this->cms = $cms;
            $this->fill($this->cms);
            $this->isEdit=true;
        }
        else
            $this->cms=new Cms;

        $this->cmsGalleries = new Collection();
        
    }



    public function saveOrUpdate()
    {
       

        if(isset($this->image_1) && gettype($this->image_1) != 'string'){
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
        if(isset($this->image_2) &&  gettype($this->image_2) != 'string'){
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

        if(isset($this->image_3) && gettype($this->image_3) != 'string'){
            $image = time() . '-' . rand(1000, 9999) . '.' . $this->image_3->getClientOriginalExtension();       
            $this->image_3->storeAs('public/cms_images',$image);
            $fileName3 = 'cms_images/'.$image;
            if(isset($this->cms->image_3))
            {
                @unlink(storage_path('app/public/' .$this->cms->image_3));
            }
        }
        else{

            $fileName3 = $this->cms->image_3;
        }
        if(isset($this->image_4) && gettype($this->image_4) != 'string'){
            $image = time() . '-' . rand(1000, 9999) . '.' . $this->image_4->getClientOriginalExtension();       
            $this->image_4->storeAs('public/cms_images',$image);
            $fileName4 = 'cms_images/'.$image;
            if(isset($this->cms->image_4))
            {
                @unlink(storage_path('app/public/' .$this->cms->image_4));
            }
        }
        else{

            $fileName4 = $this->cms->image_4;
        }

        if(isset($this->image_5) && gettype($this->image_5) != 'string'){
            $image = time() . '-' . rand(1000, 9999) . '.' . $this->image_5->getClientOriginalExtension();       
            $this->image_5->storeAs('public/cms_images',$image);
            $fileName5 = 'cms_images/'.$image;
            if(isset($this->cms->image_5))
            {
                @unlink(storage_path('app/public/' .$this->cms->image_5));
            }
        }
        else{

            $fileName5 = $this->cms->image_5;
        }
        if(isset($this->image_6) && gettype($this->image_6) != 'string'){
            $image = time() . '-' . rand(1000, 9999) . '.' . $this->image_6->getClientOriginalExtension();       
            $this->image_6->storeAs('public/cms_images',$image);
            $fileName6 = 'cms_images/'.$image;
            if(isset($this->cms->image_6))
            {
                @unlink(storage_path('app/public/' .$this->cms->image_6));
            }
        }
        else{

            $fileName6 = $this->cms->image_6;
        }

        if(isset($this->image_7) && gettype($this->image_7) != 'string'){
            $image = time() . '-' . rand(1000, 9999) . '.' . $this->image_7->getClientOriginalExtension();       
            $this->image_7->storeAs('public/cms_images',$image);
            $fileName7 = 'cms_images/'.$image;
            if(isset($this->cms->image_7))
            {
                @unlink(storage_path('app/public/' .$this->cms->image_7));
            }
        }
        else{

            $fileName7 = $this->cms->image_7;
        }
        if(isset($this->image_8) && gettype($this->image_8) != 'string'){
            $image = time() . '-' . rand(1000, 9999) . '.' . $this->image_8->getClientOriginalExtension();       
            $this->image_8->storeAs('public/cms_images',$image);
            $fileName8 = 'cms_images/'.$image;
            if(isset($this->cms->image_8))
            {
                @unlink(storage_path('app/public/' .$this->cms->image_8));
            }
        }
        else{

            $fileName8 = $this->cms->image_8;
        }
        if(isset($this->image_9) && gettype($this->image_9) != 'string'){
            $image = time() . '-' . rand(1000, 9999) . '.' . $this->image_9->getClientOriginalExtension();       
            $this->image_9->storeAs('public/cms_images',$image);
            $fileName9 = 'cms_images/'.$image;
            if(isset($this->cms->image_9))
            {
                @unlink(storage_path('app/public/' .$this->cms->image_9));
            }
        }
        else{

            $fileName9 = $this->cms->image_9;
        }

       
        $this->cms->update([
            'image_1'=> $fileName,
            'image_2'=> $fileName2,
            'image_3'=> $fileName3,
            'image_4'=> $fileName4,
            'image_5'=> $fileName5,
            'image_6'=> $fileName6,
            'image_7'=> $fileName7,
            'image_8'=> $fileName8,
            'image_9'=> $fileName9,
            'description_1'=> $this->description_1,
            'description_2'=> $this->description_2,
            'description_3'=> $this->description_3,
            'description_4'=> $this->description_4,
            'description_5'=> $this->description_5,
            'description_6'=> $this->description_6,
            'description_7'=> $this->description_7,
            'description_8'=> $this->description_8,
            'description_9'=> $this->description_9,
            'description'=> $this->description,
        ]);

        
        $msgAction = 'Cms was '. ($this->isEdit ? 'updated' : 'added') . ' successfully';
        $this->showToastr("success",$msgAction);

        return redirect()->route('cms.index');
    }
    public function render()
    {
        return view('livewire.admin.cms.home-cms');
    }
}
