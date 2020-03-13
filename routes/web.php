<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::resource('trabajadores','TrabajadoresController');

Route::resource('categorias', 'CategoriasController');

Route::resource('usuarios', 'UsuariosController');

Route::resource('promociones', 'PromocionesController');

//Route::resource('pipe', 'PipeController');

Route::resource('inicio', 'InicioController');

Route::post('trabajadores/documents',[
	'as' =>	'trabajadores',
	'uses' => 'TrabajadoresController@saveDocuments'
]);

Route::post('trabajadores/validateDocuments',[
	'as' => 'trabajadores',
	'uses' => 'TrabajadoresController@saveValidateDocuments'
]);

Route::get('trabajadores/{id}/documentos',[
	'as' =>	'trabajadores',
	'uses' => 'TrabajadoresController@show_documents'
]);

Route::get('trabajadores/{id}/validar',[
	'as' => 'trabajadores',
	'uses' => 'TrabajadoresController@validateDocuments'
]);

Route::get('pipe/{nombre}/{registro}/{correo}/{password}/{telefono}/{borndate}',[
	'as' =>	'pipe',
	'uses' => 'PipeController@inserta'
]);

Route::get('pipe/registrarUsuario/{nombre}/{registro}/{correo}/{password}/{telefono}/{borndate}',[
	'as' =>	'pipe',
	'uses' => 'PipeController@registrarUsuario'
]);

Route::get('pipe/verificarUsuario/{registro}/{correo}/{password}',[
	'as' =>	'pipe',
	'uses' => 'PipeController@verificarUsuario'
]);

Route::get('pipe/verificarTrabajador/{correo}/{password}',[
	'as' =>	'pipe',
	'uses' => 'PipeController@verificarTrabajador'
]);

Route::get('pipe/actualizarConexion/{id}/{correo}/{conexion}',[
	'as' =>	'pipe',
	'uses' => 'PipeController@actualizarConexion'
]);

Route::get('pipe/generarTrabajo/{id}/{posicion}/{ruta}/{texto}',[
	'as' =>	'pipe',
	'uses' => 'PipeController@generarTrabajo'
]);

Route::get('pipe/actualizarTrabajo/{id_trabajador}/{posicion}/{ruta}/{texto}',[
	'as' =>	'pipe',
	'uses' => 'PipeController@actualizarTrabajo'
]);

Route::get('pipe/contratarServicio/{id_usuario}/{id_trabajador}/{lat_serv}/{lng_serv}/{lat_trab}/{lng_trab}',[
	'as' =>	'pipe',
	'uses' => 'PipeController@contratarServicio'
]);

Route::get('pipe/obtenerHistorialTrabajador/{id_trabajador}/{year}/{month}',[
	'as' =>	'pipe',
	'uses' => 'PipeController@obtenerHistorialTrabajador'
]);

Route::get('pipe/obtenerHistorialUsuario/{id_trabajador}/{year}/{month}',[
	'as' =>	'pipe',
	'uses' => 'PipeController@obtenerHistorialUsuario'
]);

Route::get('pipe/obtenerComentariosTrabajador/{id_trabajador}',[
	'as' =>	'pipe',
	'uses' => 'PipeController@obtenerComentariosTrabajador'
]);

Route::get('pipe/actualizarDistancia/{id}/{lat_trab}/{lng_trab}',[
	'as' =>	'pipe',
	'uses' => 'PipeController@actualizarDistancia'
]);

Route::get('pipe/obtenerTrabajadoresDistancia/{latitud}/{longitud}/{distancia}/{actividad}',[
	'as' =>	'pipe',
	'uses' => 'PipeController@obtenerTrabajadoresDistancia'
]);

Route::get('pipe/obtenerTrabajadores/{latitud}/{longitud}/{actividad}',[
	'as' =>	'pipe',
	'uses' => 'PipeController@obtenerTrabajadores'
]);

Route::get('pipe/obtenerPromociones',[
	'as' =>	'pipe/obtenerPromociones',
	'uses' => 'PipeController@obtenerPromociones'
]);

Route::get('pipe/obtenerCategoriaOficio',[
	'as' =>	'pipe/obtenerCategoriaOficio',
	'uses' => 'PipeController@obtenerCategoriaOficio'
]);

Route::get('pipe/obtenerCategoriaProfesion',[
	'as' =>	'pipe/obtenerCategoriaProfesion',
	'uses' => 'PipeController@obtenerCategoriaProfesion'
]);


// Authentication Routes...
       Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
       Route::post('login', 'Auth\LoginController@login');
       Route::post('logout', 'Auth\LoginController@logout')->name('logout');

        // Registration Routes...
           Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
           Route::post('register', 'Auth\RegisterController@register');

        // Password Reset Routes...
       Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
       Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
       Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
       Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
