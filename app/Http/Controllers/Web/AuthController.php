<?php
/**
 * Http web routes
 * php version 7.3.1
 *
 * @category Web
 * @package  Moka_APIs
 * @author   BySwadi <muath.ye@gmail.com>
 * @license  IC https://www.infinitecloud.co
 * @link     Moka_Sweets https://www.mokasweets.com/
 */
namespace App\Http\Controllers\Web;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Auth\RedirectsUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
//use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;
//use Illuminate\Support\Facades\Auth;

use App\User;
use App\UserFavorite;
use App\PointHistory;
use App\Image;
use App\GainMethod;




/**
 * Auth user to login
 * php version 7.3.1
 *
 * @category Web
 * @package  Moka_APIs
 * @author   BySwadi <muath.ye@gmail.com>
 * @license  IC https://www.infinitecloud.co
 * @link     Moka_Sweets https://www.mokasweets.com/
 */
class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     * Handle an incoming request headers.
     * Added to automatically set lang header.
     *
     * @param $request Illuminate\Http\Request
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $request->headers->set('lang', App::getLocale());
        $this->middleware('guest')->except('logout');
    }
}
