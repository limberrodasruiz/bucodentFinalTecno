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
    return view('contenido/contenido');
});
Route::get('/servicio', 'ServicioController@index');
Route::post('/servicio/registrar', 'ServicioController@store');
Route::put('/servicio/actualizar', 'ServicioController@update');
Route::put('/servicio/desactivar', 'ServicioController@desactivar');
Route::put('/servicio/activar', 'ServicioController@activar');

Route::get('/paciente', 'PacienteController@index');
Route::post('/paciente/registrar', 'PacienteController@store');
Route::put('/paciente/actualizar', 'pacienteController@update');

Route::get('/odontologo', 'OdontologoController@index');
Route::post('/odontologo/registrar', 'OdontologoController@store');
Route::put('/odontologo/actualizar', 'OdontologoController@update');

Route::get('/tratamiento', 'TratamientoController@index');
Route::post('/tratamiento/registrar', 'TratamientoController@store');
Route::put('/tratamiento/actualizar', 'TratamientoController@update');
Route::put('/tratamiento/desactivar', 'TratamientoController@desactivar');
Route::put('/tratamiento/activar', 'TratamientoController@activar');