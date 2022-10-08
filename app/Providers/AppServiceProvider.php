<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Braintree\Gateway;

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
        $this->app->singleton(Gateway::class, function($app){
            return new Gateway(
                [
                    'environment' => 'sandbox',
                    'merchantId' => 'nygdb38w72q7j389',
                    'publicKey' => 'w9nwnxdph7sj4z5p',
                    'privateKey' => 'bf0c44335c02909056a45b254c8d7deb' 
                ]
             );
        });
    }


        // braintree setup
    // $environment = env('BRAINTREE_ENV');
    // $braintree = new \Braintree\Gateway([
    //     'environment' => $environment,
    //     'merchantId' => 'merchant_id_example',
    //     'publicKey' => 'public_key_example',
    //     'privateKey' => 'private_key_example'
    // ]);
    // config(['braintree' => $braintree]); 
    // }
}
