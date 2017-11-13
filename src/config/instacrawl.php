<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Start
    |--------------------------------------------------------------------------
    |
    | Defines where package should start crawling for json. We never know if
    | if they decide to change the naming so it's better to have it
    | configurable.
    |
    */
    'start' => 'window._sharedData = ',

    /*
    |--------------------------------------------------------------------------
    | Stop
    |--------------------------------------------------------------------------
    |
    | Defines where the package should stop crawling for json. Same reason as
    | the Start Crawl config.
    |
    */
    'stop' => ';</script>',

    /*
    |--------------------------------------------------------------------------
    | Indexes
    |--------------------------------------------------------------------------
    |
    | Defines indexes where data is stored.
    |
    */
    'indexes' => [

        'follower_count' => 'followed_by',
        'follows_count'  => 'follows',
        'posts_count'    => 'media',
        'user'           => 'user',
        'media'          => 'nodes'
        
    ],

];
