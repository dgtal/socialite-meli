# MercadoLibre OAuth2 Provider for Laravel Socialite

### 1. Installation

`composer require dgtal/socialite-meli`

### 2. Service Provider

* Remove Laravel\Socialite\SocialiteServiceProvider from your providers[] array in config\app.php if you have added it already.
* Add \SocialiteProviders\Manager\ServiceProvider::class to your providers[] array in config\app.php.


For example:
```php
'providers' => [
    // a whole bunch of providers
    // remove 'Laravel\Socialite\SocialiteServiceProvider',
    SocialiteProviders\Manager\ServiceProvider::class, // add
];
```
* Note: If you would like to use the Socialite Facade, you need to [install it](http://laravel.com/docs/5.2/authentication#social-authentication).

### 3. Add the Event and Listeners

* Add `SocialiteProviders\Manager\SocialiteWasCalled::class` event to your `listen[]` array in `<app_name>/Providers/EventServiceProvider`.

* Add your listeners (i.e. the ones from the providers) to the `SocialiteProviders\Manager\SocialiteWasCalled[]` that you just created.

* The listener that you add for this provider is `DGtal\SocialiteProviders\Meli\MeliExtendSocialite::class`.

* Note: You do not need to add anything for the built-in socialite providers unless you override them with your own providers.

For example:
```php
/**
 * The event handler mappings for the application.
 *
 * @var array
 */
protected $listen = [
    \SocialiteProviders\Manager\SocialiteWasCalled::class => [
        'DGtal\SocialiteProviders\Meli\MeliExtendSocialite@handle',
    ],
];
```

### 4. Services Array and .env

Add to `config/services.php`:
```php
'meli' => [
    'client_id' => env('MERCADOLIBRE_APP_KEY'),
    'client_secret' => env('MERCADOLIBRE_APP_SECRET'),
    'redirect' => env('MERCADOLIBRE_APP_CALLBACK'),
    'domain' => env('MERCADOLIBRE_APP_AUTH_DOMAIN','https://auth.mercadolibre.com.uy'),
],
```

Append provider values to your `.env` file:
**Note: Add both public and secret keys!**
```
// other values above
MERCADOLIBRE_APP_KEY=your_app_id_for_the_service
MERCADOLIBRE_APP_SECRET=your_app_secret_for_the_service
MERCADOLIBRE_APP_CALLBACK=you_app_callback
MERCADOLIBRE_APP_AUTH_DOMAIN=your_app_auth_uri
```