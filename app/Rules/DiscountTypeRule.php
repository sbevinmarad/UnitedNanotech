<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class DiscountTypeRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    protected $discountType;

    public function __construct($discountType)
    {
        $this->discountType = $discountType;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        //dump($value);
        if($this->discountType == "Percentage")
        {
            if($value >=1 && $value<100)
            {
                return true;
            }
            
            return false;
        }
        else
        {
            return true;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Discount minimum 1 maximum 99';
    }
}
