/*
 *  Product
 */
Route::get('product/category', 'ProductCategoryController@index')->name('admin.product.category.index');
Route::get('product/category/create', 'ProductCategoryController@create')->name('admin.product.category.create');
Route::post('product/category/create', 'ProductCategoryController@store')->name('admin.product.category.create');
Route::get('product/category/{id}/edit', 'ProductCategoryController@edit')->name('admin.product.category.edit');
Route::post('product/category/{id}/edit', 'ProductCategoryController@update')->name('admin.product.category.edit');
Route::get('product/category/{id}/destroy', 'ProductCategoryController@destroy')->name('admin.product.category.destroy');

Route::get('product', 'ProductController@index')->name('admin.product.index');
Route::get('product/create', 'ProductController@create')->name('admin.product.create');
Route::post('product/create', 'ProductController@store')->name('admin.product.create');
Route::get('product/{id}/edit', 'ProductController@edit')->name('admin.product.edit');
Route::post('product/{id}/edit', 'ProductController@update')->name('admin.product.edit');
Route::get('product/{id}/destroy', 'ProductController@destroy')->name('admin.product.destroy');

Route::get('product/order', 'ProductOrderController@index')->name('admin.product.order.index');
Route::get('product/order/{id}/show', 'ProductOrderController@show')->name('admin.product.order.show');
