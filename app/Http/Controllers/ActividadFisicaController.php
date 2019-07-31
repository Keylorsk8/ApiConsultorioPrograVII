<?php

namespace App\Http\Controllers;

use App\actividadFisica;
use Illuminate\Http\Request;

class ActividadFisicaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {

            $aler=actividadFisica::orderBy('nombre', 'asc') ->get();
            $response=[
                'msg'=>'Lista de actividades físicas',
                'actividades físicas'=>$aler
            ];
            return response()->json($response, 200);
        } catch (\Exception $e) {
            return \response($e->getMessage(),422);
        }

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
    {
        try {
            $this-> validate($request,[
                'nombre'=>'required|min:5',
                'minutosDeDuracion'=>'required',
                'cantidadVecesPorSemana'=>'required'
            ]);
            //Obtener el usuario autentificado actual
            // if(!$user = JWTAuth::parseToken()->authenticate()){
            //     return response()->json(['msg'=>'Usuario no encontrado'],404);
            // }
        } catch (\Illuminate\Validation\ValidationException $e) {
            return \response($e->errors(),422);
        }
        $actFis=new actividadFisica([
            'nombre'=>$request->input('nombre'),
            'minutosDeDuracion'=>$request->input('minutosDeDuracion'),
            'cantidadVecesPorSemana'=>$request->input('cantidadVecesPorSemana')
        ]);

        if($actFis->save()){

            $response=[
                'msg'=>'Actividad física creada!',
                'Actividad física'=>$actFis
            ];
            return response()->json($response, 201);

        }
        $reponse=[
            'msg'=>'Error durante la creación'
        ];
        return response()->json($response, 404);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\actividadFisica  $actividadFisica
     * @return \Illuminate\Http\Response
     */
    public function show(actividadFisica $actividadFisica)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\actividadFisica  $actividadFisica
     * @return \Illuminate\Http\Response
     */
    public function edit(actividadFisica $actividadFisica)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\actividadFisica  $actividadFisica
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $this-> validate($request,[
                'nombre'=>'required|min:5',
                'minutosDeDuracion'=>'required',
                'cantidadVecesPorSemana'=>'required'
            ]);
            //Obtener el usuario autentificado actual
            // if(!$user = JWTAuth::parseToken()->authenticate()){
            //     return response()->json(['msg'=>'Usuario no encontrado'],404);
            // }
        } catch (\Illuminate\Validation\ValidationException $e) {
            return \response($e->errors(),422);
        }
        //Datos del videojuego
        $actFis=actividadFisica::find($id);
        $actFis->nombre=$request->input('nombre');
        $actFis->minutosDeDuracion=$request->input('minutosDeDuracion');
        $actFis->cantidadVecesPorSemana=$request->input('cantidadVecesPorSemana');

        if($actFis->update()){
            //Sincronice plataformas
            //Array de plataformas

            $actFis=actividadFisica::where('id',$id)->first();
            $response=[
                'msg'=>'Actividad física actualizada!',
                'Actividad física'=>$actFis
            ];
            return response()->json($response, 200);

        }
        $reponse=[
            'msg'=>'Error durante la actualización'
        ];
        return response()->json($response, 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\actividadFisica  $actividadFisica
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Auth::User()->session_id;
        //Obtener el usuario autentificado actual
        if(!$user = JWTAuth::parseToken()->authenticate()){
            return response()->json(['msg'=>'Usuario no encontrado'],404);
        }

        if ($user->rol_id === 2) {
            return response()->json(['msg'=>'No se pueden realizar cambios'], 404);
        }

        if($user->rol_id === 3) {
            return response()->json(['msg'=>'No se pueden realizar cambios'], 404);
        }

        if($user->rol_id === 1) {
        actividadFisica::where('id', $id)->delete();
        $response=[
            'msg'=>'Actividad Física eliminada!'
        ];
        return response()->json($response, 200);
        }
    }

    public function restore(Request $request)
    {
        $user = Auth::User()->session_id;
        //Obtener el usuario autentificado actual
        if(!$user = JWTAuth::parseToken()->authenticate()){
            return response()->json(['msg'=>'Usuario no encontrado'],404);
        }

        if ($user->rol_id === 2) {
            return response()->json(['msg'=>'No se pueden realizar cambios'], 404);
        }

        if($user->rol_id === 3) {
            return response()->json(['msg'=>'No se pueden realizar cambios'], 404);
        }

        if($user->rol_id === 1) {
        actividadFisica::onlyTrashed()->where('id', $request->id)->restore();

        $response=[
            'msg'=>'Actividad Física restaurada!'
        ];
        return response()->json($response, 200);
        }

    }
}
