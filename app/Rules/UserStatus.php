<?php

namespace App\Rules;

use App\User;
use Illuminate\Contracts\Validation\Rule;
use App\Http\Controllers\Auth\LoginController;

class UserStatus implements Rule
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
        // dd('value', $value);
        $auth = new LoginController();

        $user = User::where($auth->username(), $value)->first();

        $error['massage'] = '';

        // if user is deleted
        if ($user->status == 2) {
            $data = $user;
            $data['status_message'] = 'deleted';
            $error['massage'] = 'Unauthorized';
            return $error['massage'] == 'Unauthorized' ? 0 : 1;
        }

        //TODO: Prevent this user from applying requests and paying for
        // products by API side
        // if user is in blacklist
        if ($user->status == 3) {
            $data['status_message'] = 'blacklist';
            $error['massage'] = 'Authorized';
            return $error['massage'] == 'Unauthorized' ? 0 : 1;
        }

        // if user is attitude
        if ($user->status == 0) {
            $data['status_message'] = 'attitude';
            $error['massage'] = 'Unauthorized';
            return $error['massage'] == 'Unauthorized' ? 0 : 1;
        }

        // if user is active
        if ($user->status == 1) {
            $error['massage'] = 'Authorized';
            $data['status_message'] = 'active';
            return $error['massage'] == 'Unauthorized' ? 0 : 1;
        } else {
            $error['massage'] = 'Unauthorized.';
            $data['status_message'] = 'unknown';
            return $error['massage'] == 'Unauthorized' ? 0 : 1;
        }

        return $error['massage'] == 'Unauthorized' ? 0 : 1;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        $msgEn = "You are not authorized.";
        $msgAr = "لست مخولاَ.";
        return app()->getLocale() == 'ar' ? $msgAr : $msgEn;
    }
}
