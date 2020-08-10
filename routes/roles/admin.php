<?php

Route::group(['namespace' => 'Admin', 'as' => 'admin.'], function () {
    Route::resource('proposal', 'Proposal\IndexController');

    Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Profile'], function () {
        Route::get('/', 'IndexController@index')->name('index');
        Route::patch('/', 'IndexController@update')->name('update');
    });

    Route::group(['prefix' => 'db', 'as' => 'db.'], function () {
         Route::group(['prefix' => 'cars', 'as' => 'cars.', 'namespace' => 'Transport'], function () {
             Route::resource('/', 'CarsController');
             Route::post('marks/store', 'CarsController@storeMarks')->name('mark.store');
             Route::post('models/store', 'CarsController@storeModels')->name('model.store');
             Route::delete('marks/destroy/{id}', 'CarsController@destroyMarks')->name('mark.destroy');
             Route::delete('models/destroy/{id}', 'CarsController@destroyModels')->name('model.destroy');
         });

        Route::group(['prefix' => 'location', 'as' => 'location.', 'namespace' => 'Location'], function () {
            Route::resource('/', 'IndexController');
            Route::post('store/city', 'IndexController@storeCity')->name('city.store');
            Route::post('store/region', 'IndexController@storeRegion')->name('region.store');
            Route::delete('destroy/{id}/city', 'IndexController@destroyCity')->name('city.destroy');
            Route::delete('destroy/{id}/region', 'IndexController@destroyRegion')->name('region.destroy');
        });

        Route::group(['prefix' => 'synonym', 'as' => 'synonym.', 'namespace' => 'Synonym'], function () {
            Route::resource('transport', 'TransportController');

            Route::post('transport/word/store', 'TransportController@storeWord')->name('transport.word.store');
            Route::post('transport/synonym/store', 'TransportController@storeSynonym')->name('transport.synonym.store');
            Route::delete('word/{id}', 'TransportController@destroyWord')->name('transport.word.delete');
            Route::delete('synonym/{id}', 'TransportController@destroySynonym')->name('transport.synonym.delete');

            Route::get('get-paginate', 'TransportController@getPaginateFetchData')->name('get-paginate');
            Route::get('get-all', 'TransportController@getAllFetchData')->name('get-all');
        });

    });

    Route::group(['prefix' => 'message', 'as' => 'message.', 'namespace' => 'Message'], function () {
        Route::post('send-text', 'SendController@sendText')->name('send-text');
        Route::post('send-file', 'SendController@sendFile')->name('send-file');
        Route::get('contacts/{proposal_id}/{user_id}', 'IndexController@getContacts')->name('get-contacts');
        Route::get('messages/{from_id}/{proposal_id}/{user_id}', 'IndexController@getMessages')->name('get-messages');
    });

    Route::resource('helps', 'Help\IndexController')->names('help');
    Route::resource('users', 'User\IndexController')->names('user');
    Route::resource('shops', 'Shop\IndexController')->names('shop');

    Route::group(['prefix' => 'mailing-lists', 'as' => 'mail-list.', 'namespace' => 'MailList'], function () {
        Route::resource('/', 'IndexController');
        Route::get('/get-paginate', 'IndexController@getPaginateFetchData')->name('get-paginate');
        Route::post('/change-often-receive-notification', 'IndexController@changeOftenReceiveNotification')->name('change.often-receive-notification');
        Route::resource('region', 'RegionController')->names('region');
        Route::resource('synonym', 'SynonymController')->names('synonym');
        Route::resource('transport', 'TransportController')->names('transport');
        Route::post('transport/{user_id}', 'TransportController@available')->name('transport.available');
    });


});