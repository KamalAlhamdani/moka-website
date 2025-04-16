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
namespace App\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Used helper in the project
 *
 * @category Utilities
 * @package  App\Globals
 * @author   BySwadi <muath.ye@gmail.com>
 * @license  BySwadi https://www.muath.swadi
 * @link     BySwadi https://www.muath.swadi/
 */
class HelperServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //It will require Helper.php file presents in the app/Helpers directory.
        /* $file = app_path('Helpers/Helper.php');
        if (file_exists($file)) {
            require_once($file);
        } */

        //It will require all of the files present in the app/Helpers directory.
        foreach (glob(app_path() . '/Helpers/*.php') as $file) {
            require_once($file);
        }
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
