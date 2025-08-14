<?php

// app/helpers.php
if (!function_exists('getNetworkUrl')) {
    function getNetworkUrl() {
        $localIp = gethostbyname(gethostname());
        
        if (strpos($localIp, '192.168.1.') === 0) {
            return env('OFFICE_APP_URL');
        } else if (strpos($localIp, '10.42.') === 0) {
            return env('HOME_APP_URL');
        }
        
        return env('APP_URL', 'http://localhost:8000');
    }
}