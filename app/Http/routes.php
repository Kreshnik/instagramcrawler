<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
|
*/

//foreach ( File::allFiles(__DIR__ . '/Routes') as $partial ) {
//	require_once $partial->getPathname();
//}

/*
|--------------------------------------------------------------------------
| API Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an api application.
|
*/

foreach (File::allFiles(__DIR__ . '/Routes') as $partial) {
	require_once $partial->getPathname();
}

