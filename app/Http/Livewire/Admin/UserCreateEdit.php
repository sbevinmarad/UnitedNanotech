<?php

namespace App\Http\Livewire\Admin;

use App\Http\Livewire\Traits\AlertMessage;
use App\Models\User;
use Livewire\Component;
use Illuminate\Validation\Rule;

class UserCreateEdit extends Component
{
    use AlertMessage;
    public $first_name,$last_name, $email, $password,$phone,$active,$password_confirmation,$user, $user_id;
    public $isEdit=false;
    public $statusList=[];

    public function mount($user = null)
    {
        if ($user) {
            $this->user = $user;
            $this->fill($this->user);
            $this->isEdit=true;
        }
        else
            $this->user=new User;
        
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
                'first_name' => ['required', 'max:255'],
                'last_name' => ['required', 'max:255'],
                'email' => ['required', 'email','regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,4}$/ix', 'max:255', 'max:255', Rule::unique('users')],
                'user_id' => ['required','min:6', 'max:6', Rule::unique('users')],
                'password' => ['required', 'max:255', 'min:6', 'confirmed'],
                'password_confirmation' => ['required', 'max:255', 'min:6'],
                'active'=>['required']
            ];
    }
    public function validationRuleForUpdate(): array
    {
        return
            [   'first_name' => ['required', 'max:255'],
                'last_name' => ['required', 'max:255'],
                'active'=>['required'],
                'email' => ['required', 'email','regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,4}$/ix', 'max:255', 'max:255', Rule::unique('users')->ignore($this->user->id)],
                'user_id' => ['required','min:6', 'max:6', Rule::unique('users')->ignore($this->user->id)]
            ];
    }

    public function saveOrUpdate()
    {
        $this->user->fill($this->validate($this->isEdit ? $this->validationRuleForUpdate() : $this->validationRuleForSave()))->save();
        if(!$this->isEdit)
            $this->user->assignRole('CLIENT');
        $msgAction = 'User was '. ($this->isEdit ? 'updated' : 'added') . ' successfully';
        $this->showToastr("success",$msgAction);

        return redirect()->route('users.index');
    }
    public function render()
    {
        return view('livewire.admin.user-create-edit');
    }
}