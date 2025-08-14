<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Config;

class NetworkServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register()
    {
        $localIp = gethostbyname(gethostname());
        
        if (str_starts_with($localIp, '192.168.1.')) {
            // Office network
            $this->configureForOffice();
        } else if (str_starts_with($localIp, '10.42.')) {
            // Home network
            $this->configureForHome();
        }
    }
    
    /**
     * Configure for office network
     */
    protected function configureForOffice()
    {
        Config::set('app.url', env('OFFICE_APP_URL'));
        Config::set('session.domain', '.192.168.1.20');
        
        // Set session config
        config([
            'session' => array_merge(config('session'), [
                'domain' => '.192.168.1.20',
                'secure' => false,
                'same_site' => 'lax',
            ])
        ]);
        
        // Set trusted proxies if behind load balancer
        $this->app['request']->setTrustedProxies(
            ['192.168.1.0/24'],
            \Illuminate\Http\Request::HEADER_X_FORWARDED_FOR |
            \Illuminate\Http\Request::HEADER_X_FORWARDED_HOST |
            \Illuminate\Http\Request::HEADER_X_FORWARDED_PORT |
            \Illuminate\Http\Request::HEADER_X_FORWARDED_PROTO |
            \Illuminate\Http\Request::HEADER_X_FORWARDED_AWS_ELB
        );
    }
    
    /**
     * Configure for home network
     */
    protected function configureForHome()
    {
        Config::set('app.url', env('HOME_APP_URL'));
        Config::set('session.domain', '.10.42.110.60');
        
        // Set session config
        config([
            'session' => array_merge(config('session'), [
                'domain' => '.10.42.110.60',
                'secure' => false,
                'same_site' => 'lax',
            ])
        ]);
        
        // Set trusted proxies if behind load balancer
        $this->app['request']->setTrustedProxies(
            ['10.42.0.0/16'],
            \Illuminate\Http\Request::HEADER_X_FORWARDED_FOR |
            \Illuminate\Http\Request::HEADER_X_FORWARDED_HOST |
            \Illuminate\Http\Request::HEADER_X_FORWARDED_PORT |
            \Illuminate\Http\Request::HEADER_X_FORWARDED_PROTO |
            \Illuminate\Http\Request::HEADER_X_FORWARDED_AWS_ELB
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
