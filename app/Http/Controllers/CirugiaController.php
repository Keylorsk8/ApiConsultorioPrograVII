<?php

namespace App\Http\Controllers;

use App\cirugia;
use Illuminate\Http\Request;
use JWTAuth;
use App\Expediente;
class CirugiaController extends Controller
{
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
    {
        try {
            $this-> validate($request,[
                'nombre'=>'required|min:5',
                'fecha'=>'required',
                'lugar'=>'required'
            ]);
            //Obtener el usuario autentificado actual
            // if(!$user = JWTAuth::parseToken()->authenticate()){
            //     return response()->json(['msg'=>'Usuario no encontrado'],404);
            // }
        } catch (\Illuminate\Validation\ValidationException $e) {
            return \response($e->errors(),422);
        }
        $cirug=new cirugia([
            'nombre'=>$request->input('nombre'),
            'fecha'=>$request->input('fecha'),
            'lugar'=>$request->input('lugar')
        ]);

        $cirug->expediente()->associate($request->input('expediente_id'));

        if($cirug->save()){

            $response=[
                'msg'=>'Cirugía agregada!',
                'Cirugía'=>$cirug
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
     * @param  \App\cirugia  $cirugia
     * @return \Illuminate\Http\Response
     */
    public function show(cirugia $cirugia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\cirugia  $cirugia
     * @return \Illuminate\Http\Response
     */
    public function edit(cirugia $cirugia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\cirugia  $cirugia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $this-> validate($request,[
                'nombre'=>'required|min:5',
                'fecha'=>'required',
                'lugar'=>'required'
            ]);
            //Obtener el usuario autentificado actual
            // if(!$user = JWTAuth::parseToken()->authenticate()){
            //     return response()->json(['msg'=>'Usuario no encontrado'],404);
            // }
        } catch (\Illuminate\Validation\ValidationException $e) {
            return \response($e->errors(),422);
        }
        //Datos del videojuego
        $cir=cirugia::find($id);
        $cir->nombre=$request->input('nombre');
        $cir->fecha=$request->input('fecha');
        $cir->lugar=$request->input('lugar');

        if($cir->update()){
            //Sincronice plataformas
            //Array de plataformas

            $cir=cirugia::where('id',$id)->first();
            $response=[
                'msg'=>'Cirugía actualizada!',
                'Cirugía'=>$cir
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
     * @param  \App\cirugia  $cirugia
     * @return \Illuminate\Http\Response
     */
    public function destroy(cirugia $cirugia)
    {
        //
    }

    public function detallePorPerfil(Request $request)
    {
        try {
            if(!$user = JWTAuth::parseToken()->authenticate()){
                return response()->json(['msg'=>'Usuario no encontrado'],404);
            }

            //withCount contar el número de resultados de una relación
            $med= cirugia::where('expediente_id', $request->expediente_id)->get();
            $response = [
                'msg' => 'Lista de cirugías',
                'Cirugía' => $med
            ];
            return response()->json($response, 200);
        } catch (\Exception $e) {
            return \response($e->getMessage(), 422);
        }
    }
}
