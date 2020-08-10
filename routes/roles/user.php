<?php

Route::group(['namespace' => 'User', 'as' => 'user.'], function () {
    Route::resource('proposal', 'Proposal\IndexController');

    Route::get('profile', 'Profile\IndexController@index')->name('profile.index');
    Route::get('shop/profile/show/{id}', 'Profile\IndexController@shopProfileShow')->name('profile.shop.show');
    Route::patch('profile', 'Profile\IndexController@update')->name('profile.update');

    Route::group(['prefix' => 'message', 'as' => 'message.', 'namespace' => 'Message'], function () {
        Route::get('contacts/{proposal_id}', 'IndexController@getContacts')->name('get-contacts');
        Route::get('messages/{from_id}/{proposal_id}', 'IndexController@getMessages')->name('get-messages');
    });
});