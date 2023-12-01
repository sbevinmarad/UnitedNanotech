<?php

namespace App\Http\Livewire\Admin\WorkProcess;

use Str;
use Image;
use Livewire\Component;
use App\Models\WorkProcess;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
use App\Http\Livewire\Traits\AlertMessage;

class WorkProcessCreateEdit extends Component
{
	use AlertMessage,WithFileUploads;
    public $title,$active=1,$item_count, $image ,$work_process,$description;
    public $isEdit=false;
    public $statusList=[];

    public function mount($work_process = null)
    {
        if ($work_process) {
            $this->work_process = $work_process;
            $this->fill($this->work_process);
            $this->isEdit=true;
        }
        else
            $this->work_process=new WorkProcess;
        
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
                'title'=>['required', Rule::unique('work_processes')],
                'active'=>['required'],
                'image'=>['required'],
                'description'=>['required'],
            ];
    }

    public function validationRuleForUpdate(): array
    {
        return
            [
                'title'=>['required', Rule::unique('work_processes')->ignore($this->work_process->id)],
                'description'=>['required'],
                'active'=>['required'],
            ];
    }
    

    public function saveOrUpdate()
    {
        $this->work_process->fill($this->validate($this->isEdit ? $this->validationRuleForUpdate() : $this->validationRuleForSave()))->save();

        if(gettype($this->image) != 'string'){
            $image = time() . '-' . rand(1000, 9999) . '.' . $this->image->getClientOriginalExtension();       
            $this->image->storeAs('public/images',$image);
            $fileName = 'images/'.$image;
            if(isset($this->work_process->image))
            {
                @unlink(storage_path('app/public/' .$this->work_process->image));
            }
        }
        else{

            $fileName = $this->work_process->image;
        } 
        $this->work_process->update(['image' => $fileName]);
        
        $msgAction = 'Work process was '. ($this->isEdit ? 'updated' : 'added') . ' successfully';
        $this->showToastr("success",$msgAction);

        return redirect()->route('work-processes.index');
    }
    
    public function render()
    {
        return view('livewire.admin.work-process.work-process-create-edit');
    }
}
