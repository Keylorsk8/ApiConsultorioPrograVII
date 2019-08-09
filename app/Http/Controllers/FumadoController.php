<?php

namespace App\Http\Controllers;

use App\fumado;
use Illuminate\Http\Request;

class FumadoController extends Controller
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
                'cantidadCigarrosPorDia'=>'required|min:1',
                'tiempoComenzoAFumar'=>'required|min:1',


            ]);
            //Obtener el usuario autentificado actual
            // if(!$user = JWTAuth::parseToken()->authenticate()){
            //      return response()->json(['msg'=>'Usuario no encontrado'],404);
            //  }
        } catch (\Illuminate\Validation\ValidationException $e) {
            return \response($e->errors(),422);
        }
        $fum=new fumado([
            'cantidadCigarrosPorDia'=>$request->input('cantidadCigarrosPorDia'),
            'tiempoComenzoAFumar'=>$request->input('tiempoComenzoAFumar'),
            'observaciones'=>$request->input('observaciones')
        ]);
        $fum->expediente()->associate($request->input('expediente_id'));

        if($fum->save()){

            $response=[
                'msg'=>'Fumado agregado!',
                'enfermedad'=>$fum
            ];
            return response()->json($response, 201);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\fumado  $fumado
     * @return \Illuminate\Http\Response
     */
    public function show(fumado $fumado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\fumado  $fumado
     * @return \Illuminate\Http\Response
     */
    public function edit(fumado $fumado)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\fumado  $fumado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $this-> validate($request,[
                'cantidadCigarrosPorDia'=>'required|min:1',
                'tiempoComenzoAFumar'=>'required|min:1',

            ]);
            //Obtener el usuario autentificado actual
            // if(!$user = JWTAuth::parseToken()->authenticate()){
            //     return response()->json(['msg'=>'Usuario no encontrado'],404);
            // }
        } catch (\Illuminate\Validation\ValidationException $e) {
            return \response($e->errors(),422);
        }

        $fum=fumado::find($id);
        $fum->cantidadCigarrosPorDia=$request->input('cantidadCigarrosPorDia');
        $fum->tiempoComenzoAFumar=$request->input('tiempoComenzoAFumar');
        $fum->observaciones=$request->input('observaciones');

    

        if($fum->update()){


            $fum=fumado::where('id',$id)->first();
            $response=[
                'msg'=>'Fumado actualizado!',
                'fumado'=>$fum
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
     * @param  \App\fumado  $fumado
     * @return \Illuminate\Http\Response
     */
    public function destroy(fumado $fumado)
    {
        //
    }
}
