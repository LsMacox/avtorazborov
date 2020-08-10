<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/
//

Route::get('/', 'HomeController@cabinet')->name('home.cabinet');

Route::group(['middleware' => ['auth']], function(){

    Route::get('/register-push-notification-token/{token}', 'PushNotification\IndexController@registerPushNotificationToken')->name('push-notification.create-push-notification-token');

    Route::group(['prefix' => 'message', 'as' => 'message.', 'namespace' => 'Message'], function () {

        Route::post('send-text', 'Text\IndexController@sendText')->name('send-text');
        Route::post('send-file', 'File\IndexController@sendFile')->name('send-file');
        Route::post('send-message-on-email-offline-user', 'User\IndexController@sendMessageOnEmail')->name('send-message-on-email-offline-user');

    });

    Route::group(['prefix' => 'filter', 'as' => 'filter.', 'namespace' => 'Filter'], function() {
        Route::post('proposals', 'ProposalIndexController@index')->name('proposal');
        Route::post('proposals/answered', 'ProposalIndexController@answered')->name('proposal.answered');
    });

});

Route::group(['prefix' => 'transport', 'as' => 'transport.', 'namespace' => 'Transport'], function () {
    Route::group(['prefix' => 'cars', 'as' => 'cars.', 'namespace' => 'Cars'], function () {

        Route::get('get-all-marks', 'IndexController@getAllMarks')->name('get-marks');
        Route::get('get-all-models', 'IndexController@getAllModels')->name('get-models');
        Route::get('get-mark-models/{mark_name_or_mark_id}', 'IndexController@getMarkModels')->name('get-mark-models');

    });
});