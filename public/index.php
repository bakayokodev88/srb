<?php

/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader for
| our application. We just need to utilize it! We'll simply require it
| into the script here so that we don't have to worry about manual
| loading any of our classes later on. It feels great to relax.
|
*/

require __DIR__.'/../vendor/autoload.php';


/*
|--------------------------------------------------------------------------
| Rewrite all requests to AltoRouter
|--------------------------------------------------------------------------
|
| All requests are now handled by the same file. In that file, you create an AltoRouter instance.
|
*/


$router = new AltoRouter();

$router->map('GET', '/', 'index', 'home');
$router->map('GET', '/user/[i:id]', 'user', 'user');

$match = $router->match();

if ($match !== null ){
	if (is_callable($match['target'])){
		call_user_func_array($match['target'], $match['params']);
	}else{
		$params = $match['params'];
		require "../views/{$match['target']}.php";
	}
}

