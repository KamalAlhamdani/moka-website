<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

class StoppedFeaturesController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | BySwadi: Stopped Features Controller [TODO: Not Used]
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for stopped feature by auth controllers
    | You will use these functions for every Auth::route()
    |
    */

    /**
     * To override show link request form
     * Original 'ForgotPasswordController@showLinkRequestForm'
     * 
     * @return HTTP 404
     */
    public function showLinkRequestForm()
    {
        abort('404');
    }

    /**
     * To override send reset link email
     * Original 'ForgotPasswordController@sendResetLinkEmail'
     * 
     * @return HTTP 404
     */
    public function sendResetLinkEmail()
    {
        abort('404');
    }

    /**
     * To override show reset form
     * Original 'ResetPasswordController@showResetForm'
     * 
     * @return HTTP 404
     */
    public function showResetForm()
    {
        abort('404');
    }

    /**
     * To override reset
     * Original 'ResetPasswordController@reset'
     * 
     * @return HTTP 404
     */
    public function reset()
    {
        abort('404');
    }
}
