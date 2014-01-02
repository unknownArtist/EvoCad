<?php

use Orchestra\Support\Facades\Acl;
use Orchestra\Support\Facades\App;
use Orchestra\Support\Facades\Config;

/*
|--------------------------------------------------------------------------
| Attach Memory to ACL
|--------------------------------------------------------------------------
*/

Acl::make('orchestra/story')->attach(App::memory());

/*
|--------------------------------------------------------------------------
| Allow Configuration to be managed via Database
|--------------------------------------------------------------------------
*/

Config::map('orchestra/story', array(
    'default_format' => 'orchestra/story::config.default_format',
    'default_page'   => 'orchestra/story::config.default_page',
    'per_page'       => 'orchestra/story::config.per_page',
    'page_permalink' => 'orchestra/story::config.permalink.page',
    'post_permalink' => 'orchestra/story::config.permalink.post',
));
