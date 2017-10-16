/*
 *  Product
 */
Route::get('product', 'ProductController@index')->name('desktop.product');
Route::get('product/{id}', 'ProductController@show')->name('desktop.product.show')->where(['id'=>'[0-9]+']);
Route::get('product/cart', 'ProductCartController@index')->name('desktop.product.cart.index');
Route::post('product/cart/store', 'ProductCartController@store')->name('desktop.product.cart.store');
Route::post('product/cart/update', 'ProductCartController@update')->name('desktop.product.cart.update');
Route::post('product/cart/destory', 'ProductCartController@destory')->name('desktop.product.cart.destory');
Route::get('product/checkout', 'ProductCheckoutController@index')->name('desktop.product.checkout.index');
Route::post('product/confirm', 'ProductConfirmController@index')->name('desktop.product.confirm.index');
Route::get('user/order', 'ProductOrderController@index')->name('desktop.order.index');
Route::get('user/order/{id}', 'ProductOrderController@show')->name('desktop.order.show');
