<?php
Route::resource('goodsclass','GoodsclassController');
Route::resource('goodsaccount','GoodsaccountController');
Route::resource('goodsnews','GoodsnewController');
Route::get('goodsaccount.check','GoodsaccountController@check')->name('check');
Route::resource('admins','AdminsController');
Route::resource('login','LoginController');
Route::delete('logout', 'LoginController@destroy')->name('logout');
Route::get('revise', 'AdminsController@revise')->name('revise');
Route::post('revise', 'AdminsController@revise')->name('revise');
