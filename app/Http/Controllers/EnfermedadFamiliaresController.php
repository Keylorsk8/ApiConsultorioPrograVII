<?php

namespace App\Http\Controllers;

use App\enfermedadFamiliares;
use Illuminate\Http\Request;
use JWTAuth;
class EnfermedadFamiliaresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {

            $fam=enfermedadFamiliares::orderBy('nombre', 'asc') ->get();
            $response=[
                'msg'=>'Lista de enfermedades familiares más comunes',
                'enfermedades'=>$fam
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
                'quien'=>'required|min:5',


            ]);
            //Obtener el usuario autentificado actual
            if(!$user = JWTAuth::parseToken()->authenticate()){
                 return response()->json(['msg'=>'Usuario no encontrado'],404);
             }
        } catch (\Illuminate\Validation\ValidationException $e) {
            return \response($e->errors(),422);
        }
        $enf=new enfermedadFamiliares([
            'nombre'=>$request->input('nombre'),
            'quien'=>$request->input('quien')
        ]);
        $enf->user()->associate($user->id);

        if($enf->save()){

            $response=[
                'msg'=>'Enfermedad familiar agregada!',
                'enfermedad'=>$enf
            ];
            return response()->json($response, 201);
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\enfermedadFamiliares  $enfermedadFamiliares
     * @return \Illuminate\Http\Response
     */
    public function show(enfermedadFamiliares $enfermedadFamiliares)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\enfermedadFamiliares  $enfermedadFamiliares
     * @return \Illuminate\Http\Response
     */
    public function edit(enfermedadFamiliares $enfermedadFamiliares)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\enfermedadFamiliares  $enfermedadFamiliares
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $this-> validate($request,[
                'nombre'=>'required|min:5',
                'quien'=>'required|min:5'

            ]);
            //Obtener el usuario autentificado actual
            if(!$user = JWTAuth::parseToken()->authenticate()){
                return response()->json(['msg'=>'Usuario no encontrado'],404);
            }
        } catch (\Illuminate\Validation\ValidationException $e) {
            return \response($e->errors(),422);
        }

        $enfF=enfermedadFamiliares::find($id);
        $enfF->nombre=$request->input('nombre');
        $enfF->quien=$request->input('quien');

        $enfF->user()->associate($user->id);

        if($enfF->update()){


            $enfF=enfermedadFamiliares::where('id',$id)->first();
            $response=[
                'msg'=>'Medicamento actualizado!',
                'medicamento'=>$enfF
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
     * @param  \App\enfermedadFamiliares  $enfermedadFamiliares
     * @return \Illuminate\Http\Response
     */
    public function destroy(enfermedadFamiliares $enfermedadFamiliares)
    {
        //
    }
}
