<?php

namespace App\Http\Livewire\Admin\Payment;

use Str;
use Auth;
use Livewire\Component;
use App\Models\OpeningHour;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
use App\Http\Livewire\Traits\AlertMessage;

class PaymentLink extends Component
{

	use AlertMessage,WithFileUploads;
    public $paper_link,$active,$trade_link,$opening_hour, $client_desc, $description, $user;
    public $isEdit=false;
    public $statusList=[], $ratingList=[];

    public function mount($opening_hour = null)
    {
        $this->user = Auth::user();
        $this->paper_link = $this->user->paper_link;       
        $this->trade_link = $this->user->trade_link;       
        
    }
    public function validationRuleForSave(): array
    {
        return
            [
                'paper_link'=>['required'],
                'trade_link'=>['required'],
            ];
    }
    public function validationRuleForUpdate(): array
    {
        return[
                'paper_link'=>['required'],
                'trade_link'=>['required'],
            ];
    }

    public function saveOrUpdate()
    {
        $this->user->fill($this->validate($this->isEdit ? $this->validationRuleForUpdate() : $this->validationRuleForSave()))->save();

        $msgAction = 'Link was '. ($this->isEdit ? 'updated' : 'added') . ' successfully';
        $this->showToastr("success",$msgAction);

        return redirect()->route('payment.index');
    }
    public function render()
    {
        return view('livewire.admin.payment.payment-link');
    }
}
