<?php
/**
 * Created by PhpStorm.
 * User: Full Stack JavaScrip
 * Date: 13/07/2016
 * Time: 13:51
 */

namespace App\Providers;
use App\Auth\LdapUserProvider;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use JWTAuth;


class LdapAuthProvider  extends ServiceProvider
{


    public function boot()
    {

        //$token=JWTAuth::getToken();
        //$user=JWTAuth::toUser($token);

        //dd($user);
        //dd("llego");
        $this->registerPolicies();
        Auth::provider('ldap', function ($app, array $config) {
            return new LdapUserProvider($app->make('App\Auth\LdapServerConnection'));
        });

        /*

        $this->app['auth']->extend('ldap',function()
        {
            return new LdapUserProvider();
        });
        */

    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        // TODO: Implement register() method.
    }
}