<?php

namespace App\Http\Controllers;

use App\perfil;
use Illuminate\Http\Request;
use JWTAuth;
use App\consulta;
use App\Expediente;

class PerfilController extends Controller
{
    public function __construct()
    {
        //No se quieren proteger todas las acciones
        //Agregar segundo argumento
        $this->middleware('jwt.auth',['only'=>[
            'update','store'
        ]]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!$user = JWTAuth::parseToken()->authenticate()){
            return response()->json(['msg'=>'Usuario no encontrado'],404);
        }
        try {

            $per=perfil::orderBy('nombre', 'asc') ->where('user_id', $user->id)->get();
            $response=[
                'msg'=>'Lista de perfiles',
                'Perfil'=>$per
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
            $this->validate($request, [
                'nombre' => 'required',
                'primerApellido'=>'required',
                'segundoApellido'=> 'required',
                'sexo'=> 'required',
                'fechaNacimiento'=> 'required|date',
            ]);

              //Obtener el usuario autentificado actual
              if(!$user = JWTAuth::parseToken()->authenticate()){
                return response()->json(['msg'=>'Usuario no encontrado'],404);
            }

            if($user->rol_id !== 3){
                return response()->json(['msg'=>'Usuario no autorizado'],404);
            }

        } catch (\Illuminate\Validation\ValidationException $e ) {
        return \response($e->errors(),422);
        }


        $perf = new perfil();
        $perf->nombre = $request->nombre;
        $perf->primerApellido = $request->primerApellido;
        $perf->segundoApellido = $request->segundoApellido;
        $perf->sexo = $request->sexo;
        $perf->fechaNacimiento= $request->fechaNacimiento;
        $perf->user()->associate($user->id);
        if($perf->save()){
            $exp = new Expediente();
            $exp->perfil()->associate($perf->id);
            $exp->save();
            $response=[
                'msg'=>'Perfil agregado!',
                'Perfil'=>$perf
            ];
            return response()->json($response, 201);

        }


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function show(perfil $perfil)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function edit(perfil $perfil)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, perfil $perfil)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function destroy(perfil $perfil)
    {
        //
    }

     public function listaDeConsulta(Request $request){
        try {
            consulta::onlyTrashed()->where('perfil_id','>', 0)->restore();
            $con=consulta::orderBy('nombre', 'asc') ->where('perfil_id', $request->id)->get('nombre','precio');
            $response=[
                'msg'=>'Lista de consultas',
                'Consulta'=>$con
            ];
            return response()->json($response, 200);
        } catch (\Exception $e)
         {
            return \response($e->getMessage(),422);
        }
     }
}
