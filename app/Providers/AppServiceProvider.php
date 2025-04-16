<?php

namespace App\Providers;

use App\Offer;
use App\Category;
use Carbon\Carbon;
use App\Advertisement;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        //View::share('boot_cart', Cart::where('user_id',3)->with('cartProductItems.product')->where('status',1)->first());

        if (Schema::hasTable('categories')) {
            View::share(
                'categories',
                Category::with('product')->where('status', 1)->get()
            );
        }

        if (Schema::hasTable('offers')) {
            View::composer(
                '*', function ($view) {
                    $view->with('offers',
                    Offer::orderBy('id', 'desc')
                    ->where('status', 1)
                    ->where('start_date', '<=', Carbon::now()->format('Y-m-d'))
                    ->where('end_date', '>=', Carbon::now()->format('Y-m-d'))
                    ->with('offerProduct')->get()
                );
                }
            );
        }

        if (class_exists('App\Advertisement')
            && Schema::hasTable('advertisements')
        ) {
            View::composer(
                '*', function ($view) {
                    $view->with(
                        'advertisements',
                        // Advertisement::where(
                        //     'end_date', '>=', Carbon::now()->format('Y-m-d')
                        // )
                        // ->orWhere(
                        //     'end_date', '<', Carbon::now()->format('Y-m-d')
                        // )
                        // ->orderBy('id', 'desc')
                        // ->get()
                        Advertisement::where(
                            'end_date', '>=', Carbon::now()->format('Y-m-d')
                        )->orderBy('id', 'desc')
                        ->where('type', 'slider')
                        ->where('deleted_at', NULL)
                        ->limit(5)->get()
                    );
                }
            );
        }

        /**
         * Replace '
         * Blade::directive(
         * '
         * With '
         * $compiler = $this->app['htmlmin.compiler'];
         * $compiler->directive(
         * '
         * To solve custom blade directive in 'Laravel-HTMLMin' package
         * ref: https://github.com/HTMLMin/Laravel-HTMLMin/issues/127
         */
        $compiler = config('app.swadi_minify_blade') == true ? $this->app['htmlmin.compiler'] : '';

        $this->directives($compiler);

        //https://laracasts.com/discuss/channels/laravel/useful-blade-directives
    }

    /**
     *
     */
    public function directives($compiler = '')
    {
        if ($compiler != '') {
            $compiler->directive(
                'moka_ucfirst', function ($s) {
                    return "<?php echo ucfirst(trans($s)); ?>";
                }
            );
            // $compiler = $this->app['htmlmin.compiler'];
            $compiler->directive(
                'moka_lcfirst', function ($s) {
                    return "<?php echo lcfirst(trans($s)); ?>";
                }
            );
            // $compiler = $this->app['htmlmin.compiler'];
            $compiler->directive(
                'moka_ucfirst', function ($s) {
                    return "<?php echo ucfirst(trans($s)); ?>";
                }
            );
            // $compiler = $this->app['htmlmin.compiler'];
            $compiler->directive(
                'moka_strtolower', function ($s) {
                    return "<?php echo strtolower(trans($s)); ?>";
                }
            );
            // $compiler = $this->app['htmlmin.compiler'];
            $compiler->directive(
                'moka_strtoupper', function ($s) {
                    return "<?php echo strtoupper(trans($s)); ?>";
                }
            );
            // $compiler = $this->app['htmlmin.compiler'];
            $compiler->directive(
                'moka_ucwords', function ($s) {
                    return "<?php echo ucwords(trans($s)); ?>";
                }
            );
            // $compiler = $this->app['htmlmin.compiler'];
            $compiler->directive(
                'stamp', function () {
                    return "<?php echo base64_decode('PCEtLQ0KIC8qKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqDQogICogQERldmVsb3BlciA6IE11YXRoIFN3YWRpICAgICoNCiAgKiBARGF0ZSA6IEp1bHkgMjAxOSAgICAgICAgICAgKg0KICAqIEBDb21wYW55IDogSW5maW5pdGVjbG91ZC5jbyAqDQogICoqKioqKioqKioqKioqKioqKioqKioqKioqKioqKiovDQotLT4=');?>";
                }
            );
            // $compiler = $this->app['htmlmin.compiler'];
            $compiler->directive(
                'stamps', function () {
                    return "<?php echo base64_decode('PCEtLQ0KIC8qKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqDQogICogQERldmVsb3BlciA6IE11YXRoIFN3YWRpICAgICoNCiAgKiBARGF0ZSA6IEp1bHkgMjAxOSAgICAgICAgICAgKg0KICAqIEBDb21wYW55IDogSW5maW5pdGVjbG91ZC5jbyAqDQogICoqKioqKioqKioqKioqKioqKioqKioqKioqKioqKiovDQotLT4=');?>";
                }
            );
            // $compiler = $this->app['htmlmin.compiler'];
            $compiler->directive(
                'gsv', function ($s) {

                    return "<?php echo '<meta name=\"google-site-verification\" content=$s />';?>";
                }
            );
        } else {
            Blade::directive(
                'moka_ucfirst', function ($s) {
                    return "<?php echo ucfirst(trans($s)); ?>";
                }
            );
            Blade::directive(
                'moka_lcfirst', function ($s) {
                    return "<?php echo lcfirst(trans($s)); ?>";
                }
            );
            Blade::directive(
                'moka_ucfirst', function ($s) {
                    return "<?php echo ucfirst(trans($s)); ?>";
                }
            );
            Blade::directive(
                'moka_strtolower', function ($s) {
                    return "<?php echo strtolower(trans($s)); ?>";
                }
            );
            Blade::directive(
                'moka_strtoupper', function ($s) {
                    return "<?php echo strtoupper(trans($s)); ?>";
                }
            );
            Blade::directive(
                'moka_ucwords', function ($s) {
                    return "<?php echo ucwords(trans($s)); ?>";
                }
            );
            Blade::directive(
                'stamp', function () {
                    return "<?php echo base64_decode('PCEtLQ0KIC8qKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqDQogICogQERldmVsb3BlciA6IE11YXRoIFN3YWRpICAgICoNCiAgKiBARGF0ZSA6IEp1bHkgMjAxOSAgICAgICAgICAgKg0KICAqIEBDb21wYW55IDogSW5maW5pdGVjbG91ZC5jbyAqDQogICoqKioqKioqKioqKioqKioqKioqKioqKioqKioqKiovDQotLT4=');?>";
                }
            );
            Blade::directive(
                'stamps', function () {
                    return "<?php echo base64_decode('PCEtLQ0KIC8qKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqDQogICogQERldmVsb3BlciA6IE11YXRoIFN3YWRpICAgICoNCiAgKiBARGF0ZSA6IEp1bHkgMjAxOSAgICAgICAgICAgKg0KICAqIEBDb21wYW55IDogSW5maW5pdGVjbG91ZC5jbyAqDQogICoqKioqKioqKioqKioqKioqKioqKioqKioqKioqKiovDQotLT4=');?>";
                }
            );
            Blade::directive(
                'gsv', function ($s) {
                    return "<?php echo '<meta name=\"google-site-verification\" content=$s />';?>";
                }
            );
        }
    }
}
