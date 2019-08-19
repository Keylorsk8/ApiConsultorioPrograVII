<?php

namespace App\Http\Controllers;

use App\consulta;
use JWTAuth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ConsultaController extends Controller
{
    public function __construct()
    {
        //No se quieren proteger todas las acciones
        //Agregar segundo argumento
        $this->middleware('jwt.auth',['only'=>[
            'update','store',' consultaAsignada'
        ]]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {

            consulta::where('perfil_id','>', 0)->delete();
            $con=consulta::orderBy('nombre', 'asc') ->get();
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
    public function consultaAsignada(){
        try{
            if(!$user = JWTAuth::parseToken()->authenticate()){
                return response()->json(['msg'=>'Usuario no encontrado'],404);
             }
             if($user->rol_id !== 2){
                return response()->json(['msg'=>'Usuario no autorizado'],404);
            }
            consulta::onlyTrashed()->where('perfil_id','>', 0)->restore();
            $con=consulta::orderBy('nombre', 'asc') ->where('perfil_id','>', 0)->where('user_id', $user->id)->get();
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

    public function consultaPorMedico(){

        try{
            if(!$user = JWTAuth::parseToken()->authenticate()){
                return response()->json(['msg'=>'Usuario no encontrado'],404);
            }


            consulta::onlyTrashed()->where('user_id','>', 0)->restore();
            $con=consulta::orderBy('user_id', 'asc')->where('user_id', $user->id)->get();
            $response=[
                'msg'=>'Lista de consultas por médico',
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


    public function detalleConsulta(Request $request){
        {
            try {
                if(!$user = JWTAuth::parseToken()->authenticate()){
                    return response()->json(['msg'=>'Usuario no encontrado'],404);
                }

                //withCount contar el número de resultados de una relación
                $med= consulta::where('id', $request->id)->where('user_id', $user->id)->get();
                $response = [
                    'msg' => 'Detalle consulta',
                    'Consulta' => $med
                ];
                return response()->json($response, 200);
            } catch (\Exception $e) {
                return \response($e->getMessage(), 422);
            }
        }
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
             if(!$user = JWTAuth::parseToken()->authenticate()){
                return response()->json(['msg'=>'Usuario no encontrado'],404);
             }
             if($user->rol_id !== 2){
                return response()->json(['msg'=>'Usuario no autorizado'],404);
            }

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

        $con->user()->associate($user->id);

        $con->perfil()->associate($request->input('perfil_id')
    );

        if (consulta::where('hora', $con->hora) -> exists()) {
            return response()->json(['msg'=>'Hora ya registrada'], 404);
        }


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
    public function show($id)
    {
        try{
            //withCount contar el número de resultados de una relación
            $con=consulta::where('id',$id)->first();
            $response=[
                'msg'=>'Información de la consulta',
                'con'=>$con
            ];
            return response()->json($response, 200);
        } catch (\Exception $e) {
            return \response($e->getMessage(),422);
        }
    }

    public function detallePorPerfil(Request $request)
    {
        try {
            if(!$user = JWTAuth::parseToken()->authenticate()){
                return response()->json(['msg'=>'Usuario no encontrado'],404);
            }

            //withCount contar el número de resultados de una relación
            $med= consulta::where('perfil_id', $request->perfil_id)->where('id',$request->id)->get();
            $response = [
                'msg' => 'Lista de consultas',
                'Consultas' => $med
            ];
            return response()->json($response, 200);
        } catch (\Exception $e) {
            return \response($e->getMessage(), 422);
        }
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
             if(!$user = JWTAuth::parseToken()->authenticate()){
               return response()->json(['msg'=>'Usuario no encontrado'],404);
            }
            if($user->rol_id !== 2){
                return response()->json(['msg'=>'Usuario no autorizado'],404);
            }
        } catch (\Illuminate\Validation\ValidationException $e) {
            return \response($e->errors(),422);
        }

        $cons=consulta::find($id);
        $cons->nombre=$request->input('nombre');
        $cons->ubicacion=$request->input('ubicacion');
        $cons->precio=$request->input('precio');
        $cons->fecha=$request->input('fecha');
        $cons->hora=$request->input('hora');

        $cons->user()->associate($user->id);

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
    public function destroy($id)
    {
        if(!$user = JWTAuth::parseToken()->authenticate()){
            return response()->json(['msg'=>'Usuario no encontrado'],404);
         }
         if($user->rol_id !== 2){
             return response()->json(['msg'=>'Usuario no autorizado'],404);
         }

         try{
            consulta::where('id', $id)->where('perfil_id', null)->forceDelete();
            $con=consulta::orderBy('nombre', 'asc') ->get();
            $response=[
                'msg'=>'',
                'Consultas' => $con
            ];
            return response()->json($response, 200);
         }
         catch (\Illuminate\Validation\ValidationException $e) {
            return \response($e->errors(),422);
        }

    }

    public function consultayMedico(){
        try {
            $con = DB::table('consultas')
            ->join('users', 'consultas.user_id', '=', 'users.id')
            ->join('especialidades', 'especialidades.id', '=', 'users.especialidad_id')
            ->select('users.name','users.primerApellido', 'users.segundoApellido','especialidades.nombre as Especialidad',
            'consultas.fecha','consultas.hora')
            ->where('users.rol_id',2)->get();
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

