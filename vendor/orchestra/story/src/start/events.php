<?php

use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\View;
use Orchestra\Support\Facades\Asset;
use Orchestra\Support\Facades\Widget;

/*
|--------------------------------------------------------------------------
| Attach multiple widget for Story CMS
|--------------------------------------------------------------------------
*/

View::composer('orchestra/foundation::dashboard.index', 'Orchestra\Story\Event\DashboardHandler@onDashboardView');

Event::listen('orchestra.form: extension.orchestra/story', function () {
    $placeholder = Widget::make('placeholder.orchestra.extensions');
    $placeholder->add('permalink')->value(View::make('orchestra/story::widgets.help'));
});

/*
|--------------------------------------------------------------------------
| Attach Configuration Callback
|--------------------------------------------------------------------------
*/

Event::listen('orchestra.form: extension.orchestra/story', 'Orchestra\Story\Event\ExtensionHandler@onFormView');
Event::listen('orchestra.validate: extension.orchestra/story', function (& $rules) {
    $rules['page_permalink'] = array('required');
    $rules['post_permalink'] = array('required');
});

/*
|--------------------------------------------------------------------------
| Add asset for Markdown Editing
|--------------------------------------------------------------------------
|
| Load asset based on for markdown.
|
*/

Event::listen('orchestra.story.editor: markdown', function () {
    $asset = Asset::container('orchestra/foundation::footer');
    $asset->script('editor', 'packages/orchestra/story/vendor/editor/editor.js');
    $asset->style('editor', 'packages/orchestra/story/vendor/editor/editor.css');
    $asset->script('storycms', 'packages/orchestra/story/js/storycms.min.js');
    $asset->script('storycms.md', 'packages/orchestra/story/js/storycms.markdown.min.js', array('editor'));
});
