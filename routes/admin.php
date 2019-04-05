<?php




###########################################################################################################################
//Register
Route::get('/register/{register_token}', 'ManageAuth\RegisterController@index')->name('index');
Route::post('/register/save', 'ManageAuth\RegisterController@register')->name('register');
Route::get( '/unlocked', 'ManageAuth\RegisterController@unlocked')->name( 'unlocked');
Route::post('/sendEmailregistration', 'Emails\EmailController@sendEmailRegistration')->name( 'sendEmailregistration');

//Login
Route::get( '/login', 'Auth\LoginController@getViewFormLogin')->name('login');
Route::post( '/login', 'Auth\LoginController@login');
Route::post( '/logout','Auth\LoginController@logout')->name( 'logout');
###########################################################################################################################
//Auth::routes();


Route::middleware(['auth', 'locale'])->group(function () {

###########################################################################################################################
    Route::group(['middleware' => 'CheckLevel'], function () {

        // Shwo ALL users
        Route::get( '/all_users', 'UsersController@index')->name( 'all_users');
        Route::get('get-users', ['as'=>'get.users','uses'=> 'UsersController@getUsers']);

        //Create Subs users
        Route::get('/create_user', 'UsersController@createUser')->middleware('CheckLevel')->name( 'create_user');
        Route::post( '/save_user', 'ManageAuth\RegisterController@register')->middleware('CheckLevel')->name('save_user');

        //Delete User
        Route::get('/delete/{user_id}', 'UsersController@delete_user')->name( 'delete_user');

        //Edit User
        Route::get('/edit_user/{user_id}', 'UsersController@edit_user')->name( 'edit_user');
        Route::post('/update', 'UsersController@update_user')->name('update_user');
    });
###########################################################################################################################

    //dashboard
    Route::get('/', 'HomeController@index')->name('dashboard');
    //change Password
    Route::get('/myProfile', 'UsersController@Show_Profile')->name('show_profile');
    Route::post( '/change_password', 'UsersController@change_password')->name('change_password');

    //Contact Admin
    Route::get( '/contact_admin/{id_receiver?}', 'ContactController@contact_admin')->name('contact_admin');
    Route::post('/contact_admin', 'ContactController@contact_admin_send')->name( 'contact_admin_send');
    Route::get('/inbox/{id_msg}', 'ContactController@inbox')->name( 'inbox');
    Route::get('/inbox/read/{id_msg}', 'ContactController@read_msg')->name( 'read_msg');
    Route::get('/inbox_msgs','ContactController@inbox_msgs')->name('inbox_msgs');
    Route::get('/sent_msgs', 'ContactController@sent_msgs')->name('sent_msgs');
    ###########################################################################################################################

    Route::get('/add-car', 'CarController@create')->name('add-car');
    Route::post('/add-car', 'CarController@store')->name('add-car');

    Route::get( '/edit-car/{id_car}/{action}', 'CarController@editCar')->name('edit-car');
    Route::post('/edit-car/{id_car}', 'CarController@update')->name('edit-car');

    Route::get('/show-car/{id_car}/{action}', 'CarController@editCar')->name('show-car');

    Route::get('/set-available', 'CarController@setAvailable')->name( 'set-available');
    Route::get( '/all_cars', 'CarController@index')->name( 'all_cars');


    Route::get('/add-imgs-car', 'CarController@Add_Imgs_Car')->name( 'add-imgs-car');
    Route::post('/add-imgs-car', 'CarController@Add_Imgs_Car_post')->name( 'add-imgs-car');
    Route::post('/delete-imgs-car', 'CarController@Delete_Imgs_Car')->name( 'delete-imgs-car');

    Route::get( '/get-models-cars/{mark_id}', 'CarController@getModelsCars')->name( 'get-modelscars');

###########################################################################################################################

    // change language
    Route::get( 'setLocal/{locale}', function ( $locale) {

        if($locale ==='fr' || $locale === 'en' || $locale === 'de')
        {
            session(['locale' => $locale]);
            session(['langDatePicker' => $locale.'-'.$locale]);
        }
        //dd( App::getLocale());
        return redirect(url('/'));
    })->name('set_local');


    //Not Found
    Route::get('/notfound', function(){
          return view('others.bad_request');
    })->name('notfound');

    //Test
    Route::get('/test', function(){

            return view('ManageCars.test');
        })->name('test');
###########################################################################################################################
});

