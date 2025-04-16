## Used for custom helper functions

> Copy ```HelperServiceProvider``` to your ```app\Providers``` directory

> Register the service in ```config\app.php```
> as following

```php
'providers' => [
    ...
    App\Providers\HelperServiceProvider::class,
],

...

'aliases' => [
    ...
    'Helper' => App\Helpers\Helper::class,
],
```

> ref: https://tutsforweb.com/creating-helpers-laravel/