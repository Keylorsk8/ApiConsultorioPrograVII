<?php

namespace App\Http\Controllers;

use App\perfil;
use Illuminate\Http\Request;
use JWTAuth;

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
            $this->validate($request, [
                'nombre' => 'required',
                'email' => 'required|email',
                'primerApellido'=>'required',
                'segundoApellido'=> 'required',
                'sexo'=> 'required',
                'fechaNacimiento'=> 'required|date',
            ]);

              //Obtener el usuario autentificado actual
              if(!$user = JWTAuth::parseToken()->authenticate()){
                return response()->json(['msg'=>'Usuario no encontrado'],404);
            }

        } catch (\Illuminate\Validation\ValidationException $e ) {
        return \response($e->errors(),422);
        }

        
        $perf = new perfil();
        $perf->nombre = $request->nombre;
        $perf->email = $request->email;
        $perf->primerApellido = $request->primerApellido;
        $perf->segundoApellido = $request->segundoApellido;
        $perf->sexo = $request->sexo;
        $perf->fechaNacimiento= $request->fechaNacimiento;
        $perf->user()->associate($user->id);
        if($perf->save()){

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
}
