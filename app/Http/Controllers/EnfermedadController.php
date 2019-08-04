<?php

namespace App\Http\Controllers;

use App\enfermedad;
use Illuminate\Http\Request;
use JWTAuth;
use Illuminate\Support\Facades\Auth;

class EnfermedadController extends Controller
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
        try {

            $aler=enfermedad::orderBy('nombre', 'asc') ->get();
            $response=[
                'msg'=>'Lista de enfermedades más comunes',
                'enfermedades'=>$aler
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

            ]);
            //Obtener el usuario autentificado actual
            // if(!$user = JWTAuth::parseToken()->authenticate()){
            //     return response()->json(['msg'=>'Usuario no encontrado'],404);
            // }
        } catch (\Illuminate\Validation\ValidationException $e) {
            return \response($e->errors(),422);
        }
        $enf=new enfermedad([
            'nombre'=>$request->input('nombre'),
            'observaciones'=>$request->input('observaciones')
        ]);

        if($enf->save()){

            $response=[
                'msg'=>'Enfermedad creada!',
                'enfermedad'=>$enf
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
     * @param  \App\enfermedad  $enfermedad
     * @return \Illuminate\Http\Response
     */
    public function show(enfermedad $enfermedad)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\enfermedad  $enfermedad
     * @return \Illuminate\Http\Response
     */
    public function edit(enfermedad $enfermedad)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\enfermedad  $enfermedad
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
        //Datos del videojuego
        $enf=enfermedad::find($id);
        $enf->nombre=$request->input('nombre');
        $enf->observaciones=$request->input('observaciones');

        if($enf->update()){
            //Sincronice plataformas
            //Array de plataformas

            $en=enfermedad::where('id',$id)->first();
            $response=[
                'msg'=>'Enfermedad actualizada!',
                'Enfermedad'=>$en
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
     * @param  \App\enfermedad  $enfermedad
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
        enfermedad::where('id', $id)->delete();
        $response=[
            'msg'=>'Enfermedad eliminada!'
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
        enfermedad::onlyTrashed()->where('id', $request->id)->restore();

        $response=[
            'msg'=>'Enfermedad restaurada!'
        ];
        return response()->json($response, 200);
        }

        // $response=[
        //     'msg'=>'Enfermedad restaurada!',
        //     'enfermedad'=>$enf
        // ];
        // return response()->json($response, 200);
    }
}
