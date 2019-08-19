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
        Route::get('obtenerImagen/{ruta}', 'AlergiaController@obtenerImagen');
        Route::post('saveImage/{id}', 'AlergiaController@saveImage');
    });

    Route::group(['prefix' => 'ActividadFisica'], function () {
        Route::resource('actividadFisica', 'ActividadFisicaController');
        Route::get('obtenerImagen/{ruta}', 'ActividadFisicaController@obtenerImagen');
    });

    Route::group(['prefix' => 'Enfermedad'], function () {
        Route::resource('enfermedad', 'EnfermedadController');
        Route::get('obtenerImagen/{ruta}', 'EnfermedadController@obtenerImagen');
    });
    Route::group(['prefix' => 'medicamento'], function () {
        Route::post('lista', 'MedicamentoController@detallePorPerfil');
    });


    Route::group(['prefix' => 'expediente'], function ($router) {
        //     Route::post('recuperarEnfermedad', 'EnfermedadController@restore');
        //     Route::post('recuperarActividadFisicas', 'ActividadFisicaController@restore');
        Route::post('agregarAlergia', 'ExpedienteController@agregarAlergia');
    });

    Route::group(['prefix' => 'usuario'], function ($router) {
        Route::post('registrar', 'AuthController@register');
        Route::post('registrarMedico', 'AuthController@registerMedico');
        Route::post('login', 'AuthController@login');
        Route::post('logout', 'AuthController@logout');
        Route::post('me', 'AuthController@me');
        Route::post('editar', 'AuthController@update');
        Route::post('medico', 'AuthController@listaMedico');
        Route::resource('perfil', 'PerfilController');
    });

    Route::group(['prefix' => 'fumado'], function ($router) {
        Route::post('detalle', 'FumadoController@detallePorPerfil');
    });

    Route::group(['prefix' => 'cirugia'], function ($router) {
        Route::post('detalle', 'CirugiaController@detallePorPerfil');
    });
    Route::group(['prefix' => 'consulta'], function ($router) {
        Route::post('consultaPerfil', 'PerfilController@listaDeConsulta');
        Route::get('consultaymedico', 'ConsultaController@consultayMedico');
        Route::post('detalle', 'ConsultaController@detallePorPerfil');
        Route::get('listaConsulta', 'ConsultaController@consultaAsignada');
        Route::post('detalleConsulta', 'ConsultaController@detalleConsulta');
        Route::get('listaConsultaMedico', 'ConsultaController@consultaPorMedico');
    });

    Route::resource('alergias', 'AlergiaController');
    Route::resource('enfermedadFamiliar', 'EnfermedadFamiliaresController');
    Route::resource('medicamento', 'MedicamentoController');
    Route::resource('expediente', 'ExpedienteController');
    Route::resource('consulta', 'ConsultaController');
    Route::resource('fumado', 'FumadoController');
    Route::resource('consumoAlcohol', 'AlcoholController');
    Route::resource('cirugia', 'CirugiaController');
});
