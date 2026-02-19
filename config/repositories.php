<?php
return [

    /*
    |--------------------------------------------------------------------------
    | Repository Bindings
    |--------------------------------------------------------------------------
    |
    | interface => implementation
    |
    */
    'bindings' => [
        \App\Repositories\Contracts\AdminRepositoryInterface::class => \App\Repositories\AdminRepository::class,
        \App\Repositories\Contracts\OtpRepositoryInterface::class => \App\Repositories\OtpRepository::class,
    ],
    'singletons' => [],
];
