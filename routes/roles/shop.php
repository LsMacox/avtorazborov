<?php

Route::group(['as' => 'shop.', 'namespace' => 'Shop'], function () {

    Route::get('proposal/answers', 'Proposal\IndexController@answers')->name('proposal.answers');
    Route::resource('proposal', 'Proposal\IndexController');

    Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Profile'], function () {
        Route::get('/', 'IndexController@index')->name('index');
        Route::patch('/', 'IndexController@update')->name('update');

        Route::group(['prefix' => 'transport-in-stock', 'as' => 'transport-in-stock.'], function () {
            Route::get('/', 'TransportController@transportInStock')->name('index');
            Route::post('/', 'TransportController@transportInStockStore')->name('store');
            Route::post('available', 'TransportController@transportAvailable')->name('available');
        });

        Route::group(['prefix' => 'alerts', 'as' => 'alert.'], function () {
            Route::get('/', 'AlertController@index')->name('index');
            Route::post('/store', 'AlertController@store')->name('store');
            Route::post('/transport-in-stock', 'TransportController@transportInStockStoreAlert')->name('transport-in-stock.store');
            Route::post('transport-in-stock/available', 'TransportController@transportAvailableAlert')->name('transport-in-stock.available');
            Route::get('confirmed/{user}', 'AlertController@confirmed')->name('confirmed')->middleware('signed');;
            Route::get('unsubscribe/{user}', 'AlertController@unsubscribe')->name('unsubscribe')->middleware('signed');;
            Route::post('email-did-not-reach', 'AlertController@testEmailNotDelivered')->name('email-not-delivered');
        });
    });

    Route::group(['prefix' => 'message', 'as' => 'message.', 'namespace' => 'Message'], function () {
        Route::get('contact/{proposal_id}', 'IndexController@getContact')->name('get-contact');
        Route::get('messages/{from_id}/{proposal_id}', 'IndexController@getMessages')->name('get-messages');
    });

    Route::group(['prefix' => 'balance', 'as' => 'balance.', 'namespace' => 'Payment'], function () {
        Route::get('/', 'IndexController@show')->name('index');
        Route::get('invoice', 'IndexController@invoice')->name('invoice.index');
        Route::post('invoice/{payment}/delete', 'IndexController@destroy')->name('invoice.delete');
        Route::post('invoice/generate-pdf', 'IndexController@invoicePDF')->name('invoice.generate-pdf');
        Route::get('payment-result', 'IndexController@paymentStatus')->name('status');
        Route::post('payment-cart', 'IndexController@store')->name('payment-cart');
    });

});