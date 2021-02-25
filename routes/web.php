<?php

Route::get('production-clear', 'ProductionArtisanController@clear');

Route::get('production-cache', 'ProductionArtisanController@cache');

Route::get('download-android', function () {
	return response()->download(storage_path('app/files/atp.apk'));
})->name('download-android-apk');



Route::get('test', function () {
	return view('admin.statistics.overview');
});

Route::get('/', 'WelcomeController@index');


Route::group(['prefix' => 'admin'] , function () {

  	Route::get('login', 'Auth\AdminLoginController@login')->name('admin.auth.login');
	Route::post('login', 'Auth\AdminLoginController@loginAdmin')->name('admin.auth.loginAdmin');
	Route::post('logout', 'Auth\AdminLoginController@logout')->name('admin.auth.logout');


	Route::group(['middleware' => 'auth:admin'], function () {


		Route::get('/profile/update', 'Admin\ProfileController@edit')->name('admin.profile.edit');
		Route::put('/profile/update/account/{id}', 'Admin\ProfileController@updateAccount')->name('admin.profile.update.account');
		Route::put('/profile/update/info/{id}', 'Admin\ProfileController@updateInfo')->name('admin.profile.update.info');

        Route::post('/persons/track/send/sms', 'Admin\TrackController@notify')->name('other.person.notify');
        Route::get('/persons/track/others/{log}', 'Admin\TrackController@track');

        Route::get('/persons/track', 'Admin\TrackController@find');
		
        Route::resource('track', 'Admin\TrackController');


		Route::get('/', 'Admin\DashboardController@index')->name('admin.dashboard');
		Route::get('dashboard', 'Admin\DashboardController@index')->name('admin.dashboard');

		Route::get('/{id}/print/qr', 'PrintQRController@show')->name('admin.print.qr');

		Route::get('persons/list/{filter}', 'Admin\PersonnelController@list')->name('persons.list');

		Route::resource('personnel', 'Admin\PersonnelController');

        Route::get('/personnel/{id}/logs', 'Admin\PersonnelLogController@show')->name('personnel.logs');
        Route::put('/personnel/{id}/logs', 'Admin\PersonnelLogController@update')->name('personnel.logs.update');

		Route::get('list/barangay', 'Admin\BarangayController@list');
		Route::resource('barangay', 'Admin\BarangayController');
		
		Route::get('province/list', 'Admin\ProvinceController@list');
		Route::resource('province', 'Admin\ProvinceController');

		// Route::get('cities', 'Admin\CityController@data');
		Route::get('/list/city', 'Admin\CityController@list')->name('city.list');
		Route::resource('city', 'Admin\CityController');

		Route::resource('municipal-account', 'Admin\MunicipalAccountController');

		// Route::get('/setting', 'Admin\SettingController@index')->name('setting.index');
		// Route::post('/setting/add/city', 'Admin\SettingController@addMunicipal')->name('setting.store.city');
		// Route::post('/setting/create/city/account', 'Admin\SettingController@addMunicipalAccount')->name('setting.store.city.account');
		// Route::post('/setting/city/update', 'Admin\SettingController@updateMunicipal')->name('setting.update.city');
		// Route::post('/setting/city/remove', 'Admin\SettingController@removeMunicipal')->name('setting.remove.city');
		// Route::post('/setting/admin/account/update', 'Admin\SettingController@adminAccountUpdate')->name('setting.admin.account.update');

		// Route::post('/setting/municipal/account/update', 'Admin\SettingController@updateMunicipalAccount')->name('admin.setting.municipal.account.update');

		Route::resource('/checker', 'Admin\CheckerController');


		Route::get('/export/options', 'Admin\ExportOptionController@index');
		Route::get('/personnel/list/download', 'Admin\ExportOptionController@personnelList');
        Route::get('/personnel/total/download', 'Admin\ExportOptionController@personnelTotal');

		Route::get('/establishment/list', 'Admin\EstablishmentController@list');
        Route::resource('establishment', 'Admin\EstablishmentController');
        Route::put('/establishment/{id}/edit', 'Admin\EstablishmentController@update')->name('establishment.edit');

		Route::get('/accounts/administrator', 'Admin\AccountController@index')->name('administrator.index');
		Route::get('/accounts/administrator/create', 'Admin\AccountController@create')->name('administrator.create');
		Route::post('/accounts/administrator/create', 'Admin\AccountController@store')->name('administrator.store');
		Route::get('/accounts/administrator/{admin}/edit', 'Admin\AccountController@edit')->name('administrator.edit');
		Route::put('/accounts/administrator/{admin}/edit', 'Admin\AccountController@update')->name('administrator.update');

	});

  });


Route::group(['prefix' => 'municipal'] , function () {
	Route::get('/', 'Municipal\DashboardController@index')->name('municipal.dashboard');
  	Route::get('dashboard', 'Municipal\DashboardController@index')->name('municipal.dashboard');
	Route::get('login', 'Auth\MunicipalLoginController@login')->name('municipal.auth.login');
	Route::post('login', 'Auth\MunicipalLoginController@loginMunicipal')->name('municipal.auth.loginMunicipal');
    Route::post('logout', 'Auth\MunicipalLoginController@logout')->name('municipal.auth.logout');

		Route::group(['middleware' => 'auth:municipal'], function () {
			Route::get('/{id}/print/qr', 'PrintQRController@show')->name('municipal.print.qr');

			Route::get('people/list', 'Municipal\PersonnelController@list')->name('municipal-people-list');
            Route::resource('municipal-personnel', 'Municipal\PersonnelController');
            Route::get('person/{id}/logs', 'Municipal\PersonLogController@show')->name('municipal.personnel.logs');
            Route::put('/personnel/{person}/logs', 'Municipal\PersonLogController@update')->name('municipal.personnel.logs.update');


			Route::get('/setting', 'Municipal\SettingController@index')->name('municipal.setting.index');

			Route::post('/setting/municipal/account/update', 'Municipal\SettingController@municipalUpdateAccount')->name('setting.municipal.account.update');

			Route::resource('m-checker', 'Municipal\CheckerController');

            Route::get('/m-establishment/list', 'Municipal\EstablishmentController@list')->name('municipal.establishment.list');
			Route::resource('m-establishment', 'Municipal\EstablishmentController');

		});

	});






	
Auth::routes();
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('auth.register');
Route::group(['middleware' => ['auth']], function () {
		Route::group(['middleware' => 'update.done'], function () {
			Route::get('/my/profile', 'UpdateProfileController@edit')->name('user.update.profile');
			Route::put('/my/profile', 'UpdateProfileController@update')->name('user.update.profile.submit');
		});
	
	Route::group(['middleware' => 'check.update.profile'], function () {
		Route::get('/home', 'HomeController@index')->name('home');
		Route::get('/my/id', 'QRController@index')->name('user-id');
	});
	
});

Route::get('/test', function () {
	return App\City::withCount('province')->withCount('barangays')->get();
});


