<?php


$app->get('/', function() use ($app) {
    return $app->version();
});


$app->group(['prefix' => 'weixin'], function ($app) {

    $app->get('/one', 'WeChatController@index');
    $app->get('/pay', 'PaymentController@index');
    $app->get('/author/{:id}', 'WeChatController@author');
    $app->get('/notify/{:id}', 'WeChatController@notify');

});


/*

$app->group(['middleware' => 'weixin'], function ($app) {
    $app->get('/', function ()  {
        return 'middleware';
    });

	$app->get('/wx', function () use ($app) {
	    return $app->version();
	});

	$app->get('/', function () use ($app) {
	    dd($app);
	});

});

Route::group(['domain'=>'{service}.laravel.app'],function(){
    Route::get('/write/laravelacademy',function($service){
        return "Write FROM {$service}.laravel.app";
    });
    Route::get('/update/laravelacademy',function($service){
        return "Update FROM {$service}.laravel.app";
    });
});

*/