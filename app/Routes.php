<?php
/**
 * Routes - all standard routes are defined here.
 *
 * @author David Carr - dave@daveismyname.com
 * @version 3.0
 */

use Core\Router;
use Helpers\Hooks;


/** Define static routes. */

// Default Routing
Router::any('', 'App\Controllers\Welcome@index');

Router::any('video/(:any)/(:any)/(:any)', 'App\Controllers\Video@index');

Router::any('categories', 'App\Controllers\Categories@index');
Router::any('categories/(:any)', 'App\Controllers\Categories@category');

Router::any('providers', 'App\Controllers\Providers@index');
Router::any('providers/(:any)', 'App\Controllers\Providers@provider');

Router::get('search', 'App\Controllers\Search@search');

Router::any('sitemap/xml', 'App\Controllers\Sitemap@xml');


Router::any('signin',  array('filters' => 'guest|csrf', 'uses' => 'App\Controllers\Users@signin'));
Router::any('signup',  array('filters' => 'guest|csrf', 'uses' => 'App\Controllers\Users@signup'));
Router::get('logout', array('filters' => 'auth',       'uses' => 'App\Controllers\Users@logout'));
Router::any('profile', array('filters' => 'auth|csrf', 'uses' => 'App\Controllers\Users@profile'));
Router::post('activity', array('filters' => 'auth',       'uses' => 'App\Controllers\Users@activity'));
Router::get('active', 'App\Controllers\Users@active');

Router::any('members', array('filters' => 'auth',       'uses' => 'App\Controllers\Members@index'));

// The Framework's Language Changer.
Router::any('language/(:any)', 'App\Controllers\Language@change');
/** End default Routes */

/** Module Routes. */
$hooks = Hooks::get();

$hooks->run('routes');
/** End Module Routes. */