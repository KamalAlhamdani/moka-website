<?php

namespace App\Rules;

use App\Rate;
use Illuminate\Contracts\Validation\Rule;

class RateUniqueRequest implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
        $result = Rate::where('request_id', $value)->first();
        return $result == [] ? 1 : 0;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        $msgEn = "You already rated this request ':attribute' .";
        $msgAr = "لقد قمت بتقييم هذا الطلب ':attribute' .";
        return app()->getLocale() == 'ar' ? $msgAr : $msgEn;
    }
}
