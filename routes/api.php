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

    Route::group(['prefix' => 'alergia'], function () {
        Route::get('all', 'AlergiaController@all');
        Route::get('eliminadas', 'AlergiaController@getDeleted');
        Route::post('delete/{id}', 'AlergiaController@delete');
        Route::post('recuperarAlergia/{id}', 'AlergiaController@restore');
    });

    Route::group(['prefix' => 'expediente'], function ($router) {
        Route::post('recuperarEnfermedad', 'EnfermedadController@restore');
        Route::post('recuperarActividadFisicas', 'ActividadFisicaController@restore');
        Route::resource('fumado', 'FumadoController');
        Route::resource('medicamento', 'MedicamentoController');
        Route::resource('cirugia', 'CirugiaController');
        Route::resource('enfermedad', 'EnfermedadController');
        Route::resource('actividadFisica', 'ActividadFisicaController');
        Route::resource('consumoAlcohol', 'AlcoholController');
    });

    Route::group(['prefix' => 'usuario'], function ($router) {
        Route::post('registrar', 'AuthController@register');
        Route::post('login', 'AuthController@login');
        Route::post('logout', 'AuthController@logout');
        Route::post('me', 'AuthController@me');
        Route::post('editar', 'AuthController@update');
        Route::resource('perfil', 'PerfilController');
    });
    Route::resource('alergias', 'AlergiaController');
    //  Route::resource('enfermedadFamiliar', 'EnfermedadFamiliaresController');

    // Route::get('consultaymedico', 'ConsultaController@consultayMedico');
    //Route::post('consultaPerfil','PerfilController@listaDeConsulta');
    // //
    Route::resource('consulta', 'ConsultaController');
    //Route::get('listaConsulta', 'ConsultaController@consultaAsignada');
    //Route::get('listaConsultaPorMedico', 'ConsultaController@consultaPorMedico');
    // Route::post('medicos','AuthController@listaMedico');

});
