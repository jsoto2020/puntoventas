<?php

namespace App\Http\Controllers;

use App\librerias\Invtipos;
use Illuminate\Http\Request;
use App\Http\Controllers\api\ApiResponseController;
use Illuminate\Routing\Controller;

class InvtiposController extends ApiResponseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipos = Invtipos::select('id_tipo', 'descripcion','usuario_creador','usuario_modificador')->
                           where('estado','=','ACTIVO')->
        orderBy('created_at', 'desc')->paginate(10);

         if ($tipos == null){

            return $this->errorResponse($tipos);
        }
        return $this->successResponse($tipos);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $datos = array("id_tipo"=>$request->input("id_tipo"),
        "descripcion"        =>$request->input("descripcion"),
        "usuario_creador"    =>$request->input("usuario_creador"),
        "usuario_modificador"=>$request->input("usuario_modificador"),
        "estado"             =>$request->input("estado"),
        );

        $messages = [
             'required' => 'El campo :attribute es requerido.',
             'unique'   => 'El campo :attribute debe ser unico',
             'numeric'  => 'El campo :attribute debe ser numerico',
             ];

             $validator = validator($datos, [
                'id_tipo'             => 'required|numeric',
                'descripcion'         => 'required|string|min:10|max:500',
                'usuario_creador'     => 'required|string',
                'usuario_modificador' => 'required|string',
                'estado'              => 'required|string'
            ],$messages);
            if ($validator->fails()) {
                $errors = $validator->errors();
                return response()->json($errors->all());
            }else{
             Invtipos::create($datos);
             return $this->successResponse($datos);
            }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\librerias\Invtipos  $invtipos
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $tipo = Invtipos::find($id);
        if ($tipo == null){
            return $this->errorResponse($tipo);
        }
        return $this->successResponse($tipo);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\librerias\Invtipos  $invtipos
     * @return \Illuminate\Http\Response
     */
    public function edit(Invtipos $invtipos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\librerias\Invtipos  $invtipos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        $tipo = Invtipos::find($id);

        $datos = array(
        "descripcion"=>$request->input("descripcion"),
        "usuario_modificador"=>$request->input("usuario_modificador"));

        $messages = [
             'required' => 'El campo :attribute es requerido.',
             'unique'   => 'El campo :attribute debe ser unico',
             'numeric'  => 'El campo :attribute debe ser numerico',
             ];

             $validator = validator($datos, [
                'descripcion' => 'required|string|min:10|max:500',
                'usuario_modificador' => 'required|string'
            ],$messages);
            if ($validator->fails()) {
                $errors = $validator->errors();
                return response()->json($errors->all());
            }else{
             $tipo->update($request->all());
             return $this->successResponse($tipo);
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\librerias\Invtipos  $invtipos
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

         $tipo = Invtipos::find($id);
        if ($tipo == null){

            return $this->response()->json("Registro no Existe");
        }
         $tipo->update(['estado' => 'ELIMINADO']);
         return response()->json('Registro Eliminado');
    }
}
