<?php
Route::resource('goodsclass','GoodsclassController')->middleware(['role:goodsclass']);
Route::resource('goodsaccount','GoodsaccountController')->middleware(['role:goodsaccount']);
Route::resource('goodsnews','GoodsnewController');
Route::get('goodsaccount.check','GoodsaccountController@check')->name('check');
Route::resource('admins','AdminsController')->middleware(['role:admins']);
Route::resource('login','LoginController');
Route::delete('logout', 'LoginController@destroy')->name('logout');
Route::get('revise', 'AdminsController@revise')->name('revise');
Route::post('revise', 'AdminsController@revise')->name('revise');
Route::post('/upload', 'UploadController@upload');
Route::resource('activity','ActivityController')->middleware(['role:activity']);
Route::get('addoreder.amount','AddorederController@amount');
Route::get('addoreder.dishes','AddorederController@dishes');
Route::resource('regist','RegistController');
Route::get('regist.dishes','RegistController@dishes');
Route::resource('permission','PermissionController')->middleware(['role:permission']);
Route::resource('role','RoleController')->middleware(['role:role']);
Route::resource('management','ManagementController');
Route::get('management.top', 'ManagementController@top');
Route::get('mail.mail', 'MailController@mail');
Route::resource('event','EventController');
Route::resource('event_member','EventMemberController');
Route::resource('enevt_prize','EnevtPrizeController');
Route::get('/start','EventController@start');
Route::get('/lottery','EventController@lottery');
Route::get('/apply','EventController@apply');
//Route::get('/test',function(\Illuminate\Http\Request $request, $orderId)
//    {
//        $order = Oreder::findOrFail($orderId);
//
//        // Ship order...
//
//        Mail::to($request->user())->send(new OrderShipped($order));
//});