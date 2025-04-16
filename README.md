# Project guide

## SSH

ssh mokaswee@162.241.30.178

## If needed features

> Authentication Routes...</br>
> Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');</br>
> Route::post('login', 'Auth\LoginController@login');</br>
> Route::post('logout', 'Auth\LoginController@logout')->name('logout');</br>
></br>
> Registration Routes...</br>
> Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');</br>
> Route::post('register', 'Auth\RegisterController@register');</br>
></br>
> Password Reset Routes...</br>
> Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');</br>
> Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');</br>
> Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');</br>
> Route::post('password/reset', 'Auth\ResetPasswordController@reset');</br>

Register

> Change the options ['register' => false] in Auth::route() to true</br>
> BySwadi: Override '[get]register' in [RegisterController@showRegistrationForm]</br>
> BySwadi: Override '[post]register' in [RegisterController@register]</br>

Forget Password

> Change the options ['reset' => false] in Auth::route() to true</br>
> BySwadi: Override '[get]password/reset' in [ForgotPasswordController@showLinkRequestForm]</br>
> BySwadi: Override '[post]password/email' in [ForgotPasswordController@sendResetLinkEmail]</br>

Reset Password

> Change the options ['reset' => false] in Auth::route() to true</br>
> BySwadi: Override '[get]password/reset/{token}' in [ResetPasswordController@showResetForm]</br>
> BySwadi: Override '[post]password/reset' in [ResetPasswordController@reset]</br>


## TODO

create symbolic link for public directory
> ln -s /home4/mokaswee/mokasweets/MokaWeb/public /home4/mokaswee/public_html/MokaWeb/public</br>
> symlink('/home4/mokaswee/mokasweets/Moka_CP/public', '/home4/mokaswee/public_html/test/public');</br>


> When adding exiting product to cart it will make its quantity to 1 even if more. </br>
> Add to cart in ```http://moka.web/products``` route. </br>
> Un use API controllers.  </br>

## Common Errors

> If the page reload in loop</br>

```bat
check if default image is lost
```

> If you get this error.

```mysql
Server error: `GET http://moka.web/api/cart` resulted in a `500 Internal Server Error` response: { "message": "SQLSTATE[42S22]: Column not found: 1054 Unknown column 'api_token' in 'where clause' (SQL: select * fr (truncated...) (View: C:\Users\Muath2\Desktop\SVN Projects\Moka Work Space\Web\Website\MokaWeb\resources\views\layout\partials\nav.blade.php)
```

You need to modify ```config\auth.php```  file as passport configuration.

```php
'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],

        /* 'api' => [
            'driver' => 'token',
            'provider' => 'users',
            'hash' => false,
        ], */
        'api' => [
            'driver' => 'passport',
            'provider' => 'users',
        ],
    ],
```
> If this error occures ``` Stop link because: Missing required parameters for [Route: product.show] [URI: api/product/{product}].```</br>

Stop ```"link"=> $page->link,``` in ```\App\Http\Resources\ProductCollection```

> if this raised ```Using $this when not in object context```</br>

```
Check if current function is static or called function is static
```

> if you got this error ```Action Facade\CodeEditor\Http\Controllers\FileContentsController not defined.```

excute this command ```php artisan route::clear```


# Command to generate a log
```git log --since="last month" --pretty=format:'%ar,%ai,%s' > maintenance-reports/2020-sep.csv```
> more info at: http://schacon.github.io/git/git-log.html
