<?php

namespace App\Http\Controllers;

use App\Alergia;
use App\expediente;
use Illuminate\Http\Request;

class ExpedienteController extends Controller
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
    { }

    /**
     * Display the specified resource.
     *
     * @param  \App\expediente  $expediente
     * @return \Illuminate\Http\Response
     */
    public function show(expediente $expediente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\expediente  $expediente
     * @return \Illuminate\Http\Response
     */
    public function edit(expediente $expediente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\expediente  $expediente
     * @return \Illuminate\Http\Response
     */

    public function agregarAlergia(Request $request)
    {
        try {
            $exp = expediente::find($request->id);
            $alergia = Alergia::where('id', $request->alergia_id)->get();

            if (expediente::where('alergia_id',$request->alergia_id)->exists()) {
                return response()->json(['msg' => 'La alergia ya está registrada'], 404);
            }
            $exp->alergias()->attach($alergia)->where('alergia_id','><',$request->alergia_id);
            $response = [
                'msg' => 'Alergia agregada!',
                'Alergia' => $exp
            ];
            return response()->json($response, 200);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return \response($e->errors(), 422);
        }
    }

    public function update(Request $request, $id)
    {

        $exp = expediente::find($id);

        $exp->tipoSangre()->associate($request->input('tipo_sangre_id'));

        if ($exp->update()) {

            $exp->actividadesFisicas()->sync(
                $request->input('actividadesFisicas') === null ?
                    [] : $request->input('actividadesFisicas')
            );

            $exp->alergias()->sync(
                $request->input('alergias') === null ?
                    [] : $request->input('alergias')
            );

            $exp->cirugias()->sync(
                $request->input('cirugias') === null ?
                    [] : $request->input('cirugias')
            );

            $exp->enfermedades()->sync(
                $request->input('enfermedades') === null ?
                    [] : $request->input('enfermedades')
            );

            $exp = expediente::where('id', $id)->first();
            $response = [
                'msg' => 'Consulta actualizada!',
                'Consulta' => $exp
            ];
            return response()->json($response, 200);
        }
        $reponse = [
            'msg' => 'Error durante la actualización'
        ];
        return response()->json($response, 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\expediente  $expediente
     * @return \Illuminate\Http\Response
     */
    public function destroy(expediente $expediente)
    {
        //
    }
}
