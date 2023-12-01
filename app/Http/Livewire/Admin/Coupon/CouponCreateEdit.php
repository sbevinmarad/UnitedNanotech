<?php

namespace App\Http\Livewire\Admin\Coupon;

use App\Http\Livewire\Traits\AlertMessage;
use App\Models\Coupon;
use App\Models\MembershipPlan;
use App\Rules\DiscountTypeRule;
use Livewire\Component;
use Str;
use Livewire\WithPagination;
use App\Http\Livewire\Traits\WithSorting;
use Illuminate\Validation\Rule;

class CouponCreateEdit extends Component
{

	use AlertMessage;
    public $name, $active=1, $start_date, $end_date, $discount, $discount_type;
    public $isEdit = false;
    public $statusList = [];
    public $typeList = [];

    public function mount($coupon = null)
    {
        if ($coupon) {
            $this->coupon = $coupon;
            $this->fill($this->coupon);
            $this->isEdit = true;
        } else
            $this->coupon = new Coupon;

        $this->statusList = [
            ['value' => "", 'text' => "Choose Status"],
            ['value' => 1, 'text' => "Active"],
            ['value' => 0, 'text' => "Inactive"]
        ];

        $this->typeList = [
            ['value' => "", 'text' => "Choose One"],
            ['value' => 'Flat', 'text' => "Flat Discount"],
            ['value' => 'Percentage', 'text' => "Percentage Discount"],
        ];

        
    }

    public function validationRuleForSave(): array
    {
        return
            [
                'name' => ['required', 'max:255', Rule::unique('coupons')],
                'active' => ['required'],
                'discount_type' => ['required'],
                'discount' => ['required','numeric', new DiscountTypeRule($this->discount_type)],
                'start_date' => ['required'],
                'end_date' => ['required', 'after_or_equal:start_date'],

            ];
    }
    public function validationRuleForUpdate(): array
    {
        return
      
            [
                'name' => ['required', 'max:255', Rule::unique('coupons')->ignore($this->coupon->id)],
                'active' => ['required'],
                'discount_type' => ['required'],
                'discount' => ['required','numeric', new DiscountTypeRule($this->discount_type)],
                'start_date' => ['required'],
                'end_date' => ['required','after_or_equal:start_date'],
            ];
    }

     public function saveOrUpdate()
    {
        $this->coupon->fill($this->validate($this->isEdit ? $this->validationRuleForUpdate() : $this->validationRuleForSave()))->save();

        
        $msgAction = 'Coupon code  was ' . ($this->isEdit ? 'updated' : 'added') . ' successfully';
        $this->showToastr("success", $msgAction);

        return redirect()->route('coupons.index');
    }

    public function render()
    {
        return view('livewire.admin.coupon.coupon-create-edit');
    }
}
