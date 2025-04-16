<?php
namespace App\Http\Middleware;
use Closure;
use App;
class Localization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        header(base64_decode("WC1EZXZlbG9wbWVudC1EZXZlbG9wZXI6IE11YXRoIFN3YWRpIEAgSW5maW5pdGVjbG91ZC5jbyAjIEp1bHkgMjAxOQ"));
        if (session()->has('locale')) {
            App::setLocale(session()->get('locale'));
        }
        return $next($request);
    }
}
