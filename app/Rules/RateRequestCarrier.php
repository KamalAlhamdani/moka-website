<?php

namespace App\Rules;

use App\Request as RequestM;
use Illuminate\Contracts\Validation\Rule;

class RateRequestCarrier implements Rule
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
        // TODO: check if this carrier for current request
        $result = RequestM::where('carrier_id', $value)->first();
        dd($result);
        return $result == [] ? 1 : 0;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        $msgEn = "This carrier in not for current request ':attribute' .";
        $msgAr = "هذا الموصل ليس لهذا الطلب ':attribute' .";
        return app()->getLocale() == 'ar' ? $msgAr : $msgEn;
    }
}
