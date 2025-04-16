<?php

namespace App\Rules;

use App\Coupon;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Validation\Rule;

class CouponUsage implements Rule
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
        $coupon_id = Coupon::where('number', $value)->first()->id ?? -1;
        $user_id = auth()->user()->id;
        // $user_id = 2;

        $result = DB::select(
            "
            SELECT
                *
                    FROM
                    coupons
                    WHERE
                    id = :coupon_id
                    AND
                id
                    IN
                (
                    SELECT
                    coupon_id
                    FROM
                    `requests`
                    WHERE
                    cart_id
                    IN
                    (
                        SELECT
                        id
                        FROM
                        carts
                        WHERE
                        user_id = :user_id
                    )
                )
            ", 
            [
                'user_id' => $user_id,
                'coupon_id' => $coupon_id,
            ]
        );

        // dd($result);
        return $result == [] ? 1 : 0;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        $msgEn = "You already used this coupon.";
        $msgAr = "لقد قمت باستخدام هذا الكوبون.";
        return app()->getLocale() == 'ar' ? $msgAr : $msgEn;
    }
}
