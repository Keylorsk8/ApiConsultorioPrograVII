<?php

namespace App\Http\Controllers;

use App\alergia;
use Illuminate\Http\Request;
use JWTAuth;
use Illuminate\Support\Facades\Auth;

class AlergiaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {

            $aler=alergia::orderBy('nombre', 'asc') ->get();
            $response=[
                'msg'=>'Lista de alergias más comunes',
                'alergias'=>$aler
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
                'categoria'=>'required|min:10',
                'reaccion'=>'required'
            ]);
            //Obtener el usuario autentificado actual
            // if(!$user = JWTAuth::parseToken()->authenticate()){
            //     return response()->json(['msg'=>'Usuario no encontrado'],404);
            // }
        } catch (\Illuminate\Validation\ValidationException $e) {
            return \response($e->errors(),422);
        }
        $alergia=new alergia([
            'nombre'=>$request->input('nombre'),
            'categoria'=>$request->input('categoria'),
            'reaccion'=>$request->input('reaccion'),
            'observacion'=>$request->input('observacion')
        ]);

        if($alergia->save()){

            $response=[
                'msg'=>'Alergia creada!',
                'Alergia'=>$alergia
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
     * @param  \App\alergia  $alergia
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{
            //withCount contar el número de resultados de una relación
            $al=alergia::where('id',$id)->first();
            $response=[
                'msg'=>'Información de la alergia',
                'Alergia'=>$al
            ];
            return response()->json($response, 200);
        } catch (\Exception $e) {
            return \response($e->getMessage(),422);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\alergia  $alergia
     * @return \Illuminate\Http\Response
     */
    public function edit(alergia $alergia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\alergia  $alergia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $this-> validate($request,[
                'nombre'=>'required|min:5',
                'categoria'=>'required|min:10',
                'reaccion'=>'required'
            ]);
            //Obtener el usuario autentificado actual
            // if(!$user = JWTAuth::parseToken()->authenticate()){
            //     return response()->json(['msg'=>'Usuario no encontrado'],404);
            // }
        } catch (\Illuminate\Validation\ValidationException $e) {
            return \response($e->errors(),422);
        }
        //Datos del videojuego
        $alerg=alergia::find($id);
        $alerg->nombre=$request->input('nombre');
        $alerg->categoria=$request->input('categoria');
        $alerg->reaccion=$request->input('reaccion');
        $alerg->observacion=$request->input('observacion');

        if($alerg->update()){
            //Sincronice plataformas
            //Array de plataformas

            $al=alergia::where('id',$id)->first();
            $response=[
                'msg'=>'Alergia actualizada!',
                'alergia'=>$al
            ];
            return response()->json($response, 200);

        }
        $reponse=[
            'msg'=>'Error durante la actualización'
        ];
        return response()->json($response, 404);
    }

    function debug_to_console( $data ) {
        $output = $data;
        if ( is_array( $output ) )
            $output = implode( ',', $output);

        echo "<script>console.log( 'Debug Objects: " . $output . "' );</script>";
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\alergia  $alergia
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
        alergia::where('id', $id)->delete();
        $response=[
            'msg'=>'Alergia eliminada!'
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
        alergia::onlyTrashed()->where('id', $request->id)->restore();

        $response=[
            'msg'=>'Alergia restaurada!'
        ];
        return response()->json($response, 200);
        }

    }

    public function all()
    {
        try {
            //Ordenar los videojuegos por el nombre de forma descendente de mayor a menor
            $alergia = alergia::orderBy('nombre', 'desc')->get();
            $response = [
                'msg' => 'Lista de Alergias',
                'Alergias' => $alergia
            ];
            return response()->json($response, 200);
        } catch (\Exception $e) {
            return \response($e->getMessage(), 422);
        }
    }

}
