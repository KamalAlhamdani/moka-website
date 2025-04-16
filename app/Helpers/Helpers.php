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

if (! function_exists('domainAsset')) {
    /**
     * Generate an asset path for the application.
     *
     * @param string      $path   path of file                     
     * @param bool|null   $secure adds https if true otherwise http
     * @param string|null $domain domain name if NULL will use full path
     * 
     * @return string
     */
    function domainAsset($path, $secure = null, $domain = null)
    {
        $ssl = $secure === true ? 'https://' : 'http://';

        if ($domain) {
            return $ssl . $domain . '/' . $path;
        }

        // In .env file, eg: DOMAIN_ASSET=moka.cp //
        if (!env('DOMAIN_ASSET')) {
            //asset($path, $secure);
            return app('url')->asset($path, $secure);
        }

        return env('DOMAIN_ASSET').'/'.$path;
    }
}