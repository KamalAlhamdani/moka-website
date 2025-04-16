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
namespace App\Http\Controllers\Utilities;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
// use App;

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
class LocalizationController extends Controller
{
    /**
     * Change the current locale in session
     * store the locale in session 
     * so that the middleware can register it.
     * 
     * @param string $locale ar|en
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function index($locale)
    {
        App::setLocale($locale);
        //store the locale in session so that the middleware can register it
        session()->put('locale', $locale);
        return redirect()->back();
    }
}
