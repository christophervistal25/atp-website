<?php
Route::post('/checker/login', 'Api\CheckerController@login');
Route::post('/checker/register', 'Api\CheckerController@register');
Route::get('/checker/{id}/qr/scanned', 'Api\CheckerController@countQRScanned');

Route::post('/person/scanned/', 'Api\PersonLogController@scanned');
Route::post('/bulk/person/log', 'Api\PersonLogController@addMultiple');

Route::post('/person/login', 'Api\PersonnelController@login');
Route::post('/person/id/generate', 'Api\PersonnelController@make');
Route::post('/person/register', 'Api\PersonnelController@register');

Route::get('/person/{id}/profile', 'Api\PersonnelController@show');

Route::get('/person/temperature', 'Api\PersonnelChartController@temperature');


// Routes for cities and barangays.
Route::get('/provinces', 'Api\ProvinceController@province');
Route::get('/municipals', 'Api\MunicipalController@city');
Route::get('/barangay', 'Api\BarangayController@barangay');

Route::get('/province/municipal/{province_code}', 'Api\ProvinceController@municipals');
Route::get('/province/barangay/{province_code}', 'Api\ProvinceController@barangays');

Route::get('/municipal/filter/{name}', 'Api\MunicipalController@filterByName');
Route::get('/municipal/list', 'Api\MunicipalController@list');


Route::get('/notify/people', 'Api\NotifyController@message');
Route::post('/sms/message/done', 'Api\NotifyController@messageDone');



