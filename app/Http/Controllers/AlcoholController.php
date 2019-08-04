<?php

namespace App\Http\Controllers;

use App\alcohol;
use Illuminate\Http\Request;

class AlcoholController extends Controller
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
                'tiempoDeComienzo'=>'required|date',
                'frecueciaDeConsumo'=>'required',
                'tomaActualmente'=>'required',

            ]);
            //Obtener el usuario autentificado actual
            // if(!$user = JWTAuth::parseToken()->authenticate()){
            //      return response()->json(['msg'=>'Usuario no encontrado'],404);
            //  }
        } catch (\Illuminate\Validation\ValidationException $e) {
            return \response($e->errors(),422);
        }
        $alc=new alcohol([
            'tiempoDeComienzo'=>$request->input('tiempoDeComienzo'),
            'frecueciaDeConsumo'=>$request->input('frecueciaDeConsumo'),
            'tomaActualmente'=>$request->input('tomaActualmente'),
            'observaciones'=>$request->input('observaciones'),
            'cerveza'=>$request->input('cerveza'),
            'consumoCerveza'=>$request->input('consumoCerveza'),
            'vino'=>$request->input('vino'),
            'consumoVino'=>$request->input('consumoVino'),
            'licor'=>$request->input('licor'),
            'consumoLicor'=>$request->input('consumoLicor')

        ]);
        $alc->expediente()->associate($request->input('expediente_id'));

        if($alc->save()){

            $response=[
                'msg'=>'Alcohol agregado!',
                'alcohol'=>$alc
            ];
            return response()->json($response, 201);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\alcohol  $alcohol
     * @return \Illuminate\Http\Response
     */
    public function show(alcohol $alcohol)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\alcohol  $alcohol
     * @return \Illuminate\Http\Response
     */
    public function edit(alcohol $alcohol)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\alcohol  $alcohol
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $this-> validate($request,[
                'tiempoDeComienzo'=>'required|date',
                'frecueciaDeConsumo'=>'required',
                'tomaActualmente'=>'required',
            ]);
            //Obtener el usuario autentificado actual
            // if(!$user = JWTAuth::parseToken()->authenticate()){
            //     return response()->json(['msg'=>'Usuario no encontrado'],404);
            // }
        } catch (\Illuminate\Validation\ValidationException $e) {
            return \response($e->errors(),422);
        }

        $al=alcohol::find($id);
        $al->tiempoDeComienzo=$request->input('tiempoDeComienzo');
        $al->frecueciaDeConsumo=$request->input('frecueciaDeConsumo');
        $al->tomaActualmente=$request->input('tomaActualmente');
        $al->observaciones=$request->input('observaciones');
        $al->cerveza=$request->input('cerveza');
        $al->consumoCerveza=$request->input('consumoCerveza');
        $al->vino=$request->input('vino');
        $al->consumoVino=$request->input('consumoVino');
        $al->licor=$request->input('licor');
        $al->consumoLicor=$request->input('consumoLicor');



        if($al->update()){
            //Sincronice plataformas
            //Array de plataformas

            $al=alcohol::where('id',$id)->first();
            $response=[
                'msg'=>'Actividad de alcohol actualizada!',
                'Actividad de alcohol '=>$al
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
     * @param  \App\alcohol  $alcohol
     * @return \Illuminate\Http\Response
     */
    public function destroy(alcohol $alcohol)
    {
        //
    }
}
