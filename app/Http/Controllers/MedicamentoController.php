<?php

namespace App\Http\Controllers;

use App\medicamento;
use Illuminate\Http\Request;

class MedicamentoController extends Controller
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


            ]);
            //Obtener el usuario autentificado actual
            // if(!$user = JWTAuth::parseToken()->authenticate()){
            //     return response()->json(['msg'=>'Usuario no encontrado'],404);
            // }
        } catch (\Illuminate\Validation\ValidationException $e) {
            return \response($e->errors(),422);
        }
        $med=new medicamento([
            'nombre'=>$request->input('nombre'),
            'descripcion'=>$request->input('descripcion')
        ]);
        $med->expediente()->associate($request->input('expediente_id'));

        if($med->save()){

            $response=[
                'msg'=>'Medicamento creado!',
                'medicamento'=>$med
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
     * @param  \App\medicamento  $medicamento
     * @return \Illuminate\Http\Response
     */
    public function show(medicamento $medicamento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\medicamento  $medicamento
     * @return \Illuminate\Http\Response
     */
    public function edit(medicamento $medicamento)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\medicamento  $medicamento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $this-> validate($request,[
                'nombre'=>'required|min:5'

            ]);
            //Obtener el usuario autentificado actual
            // if(!$user = JWTAuth::parseToken()->authenticate()){
            //     return response()->json(['msg'=>'Usuario no encontrado'],404);
            // }
        } catch (\Illuminate\Validation\ValidationException $e) {
            return \response($e->errors(),422);
        }

        $med=medicamento::find($id);
        $med->nombre=$request->input('nombre');
        $med->descripcion=$request->input('descripcion');

        $med->expediente()->associate($request->input('expediente_id'));

        if($med->update()){


            $en=medicamento::where('id',$id)->first();
            $response=[
                'msg'=>'Medicamento actualizado!',
                'medicamento'=>$en
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
     * @param  \App\medicamento  $medicamento
     * @return \Illuminate\Http\Response
     */
    public function destroy(medicamento $medicamento)
    {
        //
    }
}
