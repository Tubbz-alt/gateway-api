<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Whitelisted set of IP Addresses
    |--------------------------------------------------------------------------
    |
    | Specified IP addresses that are allowed to access the application.
    |
    */

    'ip' => [
        '127.0.0.1', //working on host
        '172.21.0.1' //working in docker
    ],

    /*
    |--------------------------------------------------------------------------
    | Whitelisted set of IP Netmask
    |--------------------------------------------------------------------------
    |
    | Specified IP netmask that are allowed to access the application.
    |
    | Example: 10.120.100.255/24. IP addresses in range from 10.120.100.0
    | to 10.120.100.255 will match this record. Here 10.120.100.255 is an
    | IP address and /24 is a netmask (255.255.255.0).
    |
    */

    'netmask' => [
        //
    ]

];
