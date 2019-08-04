<?php

namespace App\Http\Controllers;

use App\consulta;
use Illuminate\Http\Request;

class ConsultaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {

            $con=consulta::orderBy('nombre', 'asc') ->get();
            $response=[
                'msg'=>'Lista de consultas',
                'Consulta'=>$con
            ];
            return response()->json($response, 200);
        } catch (\Exception $e) {
            return \response($e->getMessage(),422);
        }

    }
    public function consultaAsignada(){
        try{

            $con=consulta::orderBy('nombre', 'asc') ->where('perfil_id', null)->get();
            $response=[
                'msg'=>'Lista de consultas',
                'Consulta'=>$con
            ];
            return response()->json($response, 200);


        }
        catch (\Exception $e) {
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
                'ubicacion'=>'required|min:10',
                'precio'=>'required',
                'fecha'=>'required',
                'hora'=>'required'

            ]);
            //Obtener el usuario autentificado actual
            // if(!$user = JWTAuth::parseToken()->authenticate()){
            //     return response()->json(['msg'=>'Usuario no encontrado'],404);
            // }
        } catch (\Illuminate\Validation\ValidationException $e) {
            return \response($e->errors(),422);
        }
        $con=new consulta([
            'nombre'=>$request->input('nombre'),
            'ubicacion'=>$request->input('ubicacion'),
            'precio'=>$request->input('precio'),
            'fecha'=>$request->input('fecha'),
            'hora'=>$request->input('hora')
        ]);

        $con->user()->associate($request->input('user_id'));

        if($con->save()){

            $response=[
                'msg'=>'Consulta creada!',
                'Consulta'=>$con
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
     * @param  \App\consulta  $consulta
     * @return \Illuminate\Http\Response
     */
    public function show(consulta $consulta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\consulta  $consulta
     * @return \Illuminate\Http\Response
     */
    public function edit(consulta $consulta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\consulta  $consulta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $this-> validate($request,[
                'nombre'=>'required|min:5',
                'ubicacion'=>'required|min:10',
                'precio'=>'required',
                'fecha'=>'required',
                'hora'=>'required'
            ]);
            //Obtener el usuario autentificado actual
            // if(!$user = JWTAuth::parseToken()->authenticate()){
            //     return response()->json(['msg'=>'Usuario no encontrado'],404);
            // }
        } catch (\Illuminate\Validation\ValidationException $e) {
            return \response($e->errors(),422);
        }

        $cons=consulta::find($id);
        $cons->nombre=$request->input('nombre');
        $cons->ubicacion=$request->input('ubicacion');
        $cons->precio=$request->input('precio');
        $cons->fecha=$request->input('fecha');
        $cons->hora=$request->input('hora');

        $cons->user()->associate($request->input('user_id'));

        if($cons->update()){
            //Sincronice plataformas
            //Array de plataformas

            $cons=consulta::where('id',$id)->first();
            $response=[
                'msg'=>'Consulta actualizada!',
                'Consulta'=>$cons
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
     * @param  \App\consulta  $consulta
     * @return \Illuminate\Http\Response
     */
    public function destroy(consulta $consulta)
    {
        //
    }
}
