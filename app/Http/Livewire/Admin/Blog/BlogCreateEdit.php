<?php

namespace App\Http\Livewire\Admin\Blog;

use Str;
use Image;
use Livewire\Component;
use App\Models\Blog;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
use App\Http\Livewire\Traits\AlertMessage;

class BlogCreateEdit extends Component
{
	use AlertMessage,WithFileUploads;
    public $title,$active=1,$description,$blog, $image, $seo_title, $seo_keywords, $seo_description;
    public $isEdit=false;
    public $statusList=[];

    public function mount($blog = null)
    {
        if ($blog) {
            $this->blog = $blog;
            $this->fill($this->blog);
            $this->isEdit=true;
        }
        else
            $this->blog=new Blog;
        
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
                'title'=>['required', Rule::unique('blogs')],
                'description'=>['required'],
                'image'=>['required'],
                'seo_title'=>['nullable'],
                'seo_description'=>['nullable'],
                'seo_keywords'=>['nullable'],
                'active'=>['required'],
            ];
    }

    public function validationRuleForUpdate(): array
    {
        return[
                'title' => ['required',  Rule::unique('blogs')->ignore($this->blog->id)],
                'description'=>['required'],
                'image'=>['required'],
                'seo_title'=>['nullable'],
                'seo_description'=>['nullable'],
                'seo_keywords'=>['nullable'],
                'active'=>['required'],
            ];
    }
    

    public function saveOrUpdate()
    {
        $this->blog->fill($this->validate($this->isEdit ? $this->validationRuleForUpdate() : $this->validationRuleForSave()))->save();

        if(gettype($this->image) != 'string'){
            $image = time() . '-' . rand(1000, 9999) . '.' . $this->image->getClientOriginalExtension();       
            $this->image->storeAs('public/blog_images',$image);
            $fileName = 'blog_images/'.$image;
            if(isset($this->blog->image))
        	{
        		@unlink(storage_path('app/public/' .$this->blog->image));
        	}
        }
        else{

            $fileName = $this->blog->image;
        } 
        $this->blog->update([
            'slug' => Str::slug($this->title),
            'image' => $fileName,
        ]);
        
        $msgAction = 'Blog was '. ($this->isEdit ? 'updated' : 'added') . ' successfully';
        $this->showToastr("success",$msgAction);

        return redirect()->route('blogs.index');
    }

    public function render()
    {
        return view('livewire.admin.blog.blog-create-edit');
    }
}
