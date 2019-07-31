<?php

use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'v1'], function () {
    //Route::resource('alcohol', 'AlcoholController');
    //Route::resource('enfermedadFamiliar', 'EnfermedadFamiliaresController');
    //Route::resource('alergias', 'AlergiaController');
    //Route::post('alergia', 'AlergiaController@restore');
    // Route::resource('medicamento', 'MedicamentoController');
    // Route::resource('fumado', 'FumadoController');
    //Route::resource('enfermedad', 'EnfermedadController');
    //Route::post('enfermedad', 'EnfermedadController@restore');
    //Route::resource('actividadFisica', 'ActividadFisicaController');
    //Route::post('actividadFisicas', 'ActividadFisicaController@restore');
    //Route::resource('cirugia', 'CirugiaController');
    //Route::resource('consulta', 'ConsultaController');
    Route::get('listaConsulta', 'ConsultaController@consultaAsignada');
    Route::post('register', 'AuthController@register');
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('me', 'AuthController@me');
    //Route::resource('usuario', 'AuthController');
    Route::post('medicos','AuthController@listaMedico');
    //Route::resource('perfil', 'PerfilController');
});
