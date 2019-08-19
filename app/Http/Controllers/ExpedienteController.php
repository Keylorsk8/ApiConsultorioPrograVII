<?php

namespace App\Http\Controllers;

use App\ActividadFisica;
use App\Alergia;
use App\Enfermedad;
use App\expediente;
use App\Perfil;
use Illuminate\Http\Request;
use JWTAuth;
use Illuminate\Support\Facades\DB;
class ExpedienteController extends Controller
{
    public function __construct()
    {
        $this->middleware(
            'jwt.auth',
            ['only' => ['compartirPerfil']]
        );
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { }

    /**
     * Display the specified resource.
     *
     * @param  \App\expediente  $expediente
     * @return \Illuminate\Http\Response
     */
    public function show(expediente $expediente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\expediente  $expediente
     * @return \Illuminate\Http\Response
     */
    public function edit(expediente $expediente)
    {
        //
    }

    public function detalleExpediente(Request $request){
        if (!$user = JWTAuth::parseToken()->authenticate()) {
            return response()->json(['msg' => 'Usuario no encontrado'], 404);
        }
         if($user->rol_id !== 2){
             return response()->json(['msg'=>'Usuario no autorizado'],404);
         }

         try{
            $per=perfil::where('id',$request->id)->first();
            $exp=expediente::where('perfil_id', $per->id)
            ->with('enfermedades')->with('alergias')->with('actividadesFisicas')->first();
            $response = [
                'msg' => 'Expediente',
                'Datos'=> $per,
                'Expediente' => $exp,

            ];
            return response()->json($response, 200);
}
    catch (\Exception $e)
    {
    return \response($e->getMessage(),422);
}
    }

    public function compartirPerfil(Request $request){
        if (!$user = JWTAuth::parseToken()->authenticate()) {
            return response()->json(['msg' => 'Usuario no encontrado'], 404);
        }
         if($user->rol_id !== 3){
             return response()->json(['msg'=>'Usuario no autorizado'],404);
         }

        try{
                    $per=perfil::where('user_id',$user->id)->first();
                    $exp=expediente::where('id',$request->id)->where('perfil_id', $per->id)
                    ->with('enfermedades')->with('alergias')->with('actividadesFisicas')->first();
                    $response = [
                        'msg' => 'Expediente',
                        'Datos'=> $per,
                        'Expediente' => $exp,

                    ];
                    return response()->json($response, 200);
        }
            catch (\Exception $e)
            {
            return \response($e->getMessage(),422);
        }
    }

    public function listaEnfermedades(Request $request){
        try {

            $exp=expediente::where('id',$request->expediente_id)
            ->with('enfermedades')->first();
           // $exp=expediente::orderBy('nombre', 'asc') ->get();
            $response=[
                'msg'=>'Lista de enfermedades',
                'Expediente'=>$exp
            ];
            return response()->json($response, 200);
        } catch (\Exception $e)
         {
            return \response($e->getMessage(),422);
        }

    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\expediente  $expediente
     * @return \Illuminate\Http\Response
     */

    public function agregarAlergia(Request $request)
    {
        try {
            $exp = expediente::find($request->expediente_id);

            $exp->alergias()->attach(
                $request->input('alergia_id') === null ?
                [] : $request->input('alergia_id')
            );

            $response = [
                'msg' => 'Alergia agregada!',
                'Expediente' => $exp
            ];
            return response()->json($response, 200);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return \response($e->errors(), 422);
        }
    }

    public function modificarAlergia(Request $request)
    {
        try {
            $exp = expediente::find($request->expediente_id);
           // $alergia = Alergia::find($request->alergia_id);


            if($exp->update() ){

                $exp->alergias()->sync(
                    $request->input('alergia_id') === null ?
                    [] : $request->input('alergia_id')
                );
                $exp=expediente::where('id',$request->expediente_id)
                ->with('alergias')->first();
                $response = [
                    'msg' => 'Alergia actualizada!',
                    'Expediente' => $exp
                ];
                return response()->json($response, 200);

            }
        } catch (\Illuminate\Validation\ValidationException $e) {
            return \response($e->errors(), 422);
        }
    }



    public function agregarActividadFisica(Request $request)
    {
        try {
            $exp = expediente::find($request->expediente_id);
            $exp->actividadesFisicas()->attach(
                $request->input('actividadFisica_id') === null ?
                [] : $request->input('actividadFisica_id')
            );
            $response = [
                'msg' => 'Actividad Física agregada!',
                'Expediente' => $exp
            ];
            return response()->json($response, 200);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return \response($e->errors(), 422);
        }
    }

    public function modificarActividadFisica(Request $request)
    {
        try {
            $exp = expediente::find($request->expediente_id);

            if($exp->update()){
                //Sincronice plataformas
                //Array de plataformas
                $exp->actividadesFisicas()->sync(
                    $request->input('actividadFisica_id') === null ?
                    [] : $request->input('actividadFisica_id')
                );
                $exp=expediente::where('id',$request->expediente_id)
                ->with('actividadesFisicas')->first();
                $response = [
                    'msg' => 'Actividad Física actualizada!',
                    'Expediente' => $exp
                ];
                return response()->json($response, 200);

            }
        } catch (\Illuminate\Validation\ValidationException $e) {
            return \response($e->errors(), 422);
        }
    }

    public function update(Request $request, $id)
    {

        $exp = expediente::find($id);

        $exp->tipoSangre()->associate($request->input('tipo_sangre_id'));

        if ($exp->update()) {

            $exp->actividadesFisicas()->sync(
                $request->input('actividadesFisicas') === null ?
                    [] : $request->input('actividadesFisicas')
            );

            $exp->alergias()->sync(
                $request->input('alergias') === null ?
                    [] : $request->input('alergias')
            );

            $exp->cirugias()->sync(
                $request->input('cirugias') === null ?
                    [] : $request->input('cirugias')
            );

            $exp->enfermedades()->sync(
                $request->input('enfermedades') === null ?
                    [] : $request->input('enfermedades')
            );

            $exp = expediente::where('id', $id)->first();
            $response = [
                'msg' => 'Consulta actualizada!',
                'Consulta' => $exp
            ];
            return response()->json($response, 200);
        }
        $reponse = [
            'msg' => 'Error durante la actualización'
        ];
        return response()->json($response, 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\expediente  $expediente
     * @return \Illuminate\Http\Response
     */
    public function destroy(expediente $expediente)
    {
        //
    }

    public function agregarEnfermedad(Request $request)
    {
        try {
            $exp = expediente::find($request->expediente_id);
            $exp->enfermedades()->attach(
                $request->input('enfermedad_id') === null ?
                [] : $request->input('enfermedad_id')
            );
            $response = [
                'msg' => 'Enfermedad agregada!',
                'Enfermedad' => $exp
            ];
            return response()->json($response, 200);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return \response($e->errors(), 422);
        }
    }

    public function modificarEnfermedad(Request $request)
    {
        try {
            $exp = expediente::find($request->expediente_id);

            if($exp->update()){
                //Sincronice plataformas
                //Array de plataformas
                $exp->enfermedades()->sync(
                    $request->input('enfermedad_id') === null ?
                    [] : $request->input('enfermedad_id')
                );
                $exp=expediente::where('id',$request->expediente_id)
                ->with('enfermedades')->first();
                $response = [
                    'msg' => 'Enfermedades actualizada!',
                    'Enfermedades' => $exp
                ];
                return response()->json($response, 200);

            }
        } catch (\Illuminate\Validation\ValidationException $e) {
            return \response($e->errors(), 422);
        }
    }
}
