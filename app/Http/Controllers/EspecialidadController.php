<?php

namespace App\Http\Controllers;

use App\especialidad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EspecialidadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {

           $esp = DB::table('Especialidades')->get('*');
            $response=[
                'msg'=>'Lista de actividades físicas',
                'Especialidades'=>$esp
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\especialidad  $especialidad
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {

            $esp = DB::table('Especialidades')->where('id',$id)->get();
             $response=[
                 'msg'=>'Lista de Especialidades',
                 'Especialidades'=>$esp
             ];
             return response()->json($response, 200);
         } catch (\Exception $e) {
             return \response($e->getMessage(),422);
         }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\especialidad  $especialidad
     * @return \Illuminate\Http\Response
     */
    public function edit(especialidad $especialidad)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\especialidad  $especialidad
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, especialidad $especialidad)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\especialidad  $especialidad
     * @return \Illuminate\Http\Response
     */
    public function destroy(especialidad $especialidad)
    {
        //
    }
}
