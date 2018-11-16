<?php

Route::group([ 
	'prefix' => '/system/clientes',
	'middleware' => 'auth'
], function()
{
	Route::get('/', [
		'as' => 'system.clientes.show',
		'uses' => 'System\Customers\CustomersController@Index'
	]);
        
});