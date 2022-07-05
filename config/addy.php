<?php

return [

    'ignore_route_names' => [
        'debugbar.openhandler',
        'debugbar.clockwork',
        'debugbar.telescope',
        'debugbar.assets.css',
        'debugbar.assets.js',
        'debugbar.cache.delete',
    ],

    'filters' => [
        \SachinKiranti\Addy\Filters\IgnoreRoutes::class,
    ],
];