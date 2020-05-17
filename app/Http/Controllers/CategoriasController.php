<?php

namespace App\Http\Controllers;

use App\librerias\categorias;
use Illuminate\Http\Request;
use App\Http\Controllers\api\ApiResponseController;

class CategoriasController extends ApiResponseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $categoria = categorias::select('id_categoria', 'descripcion','usuario_creador','usuario_modificador','estado')->
                 where('estado','=','ACTIVO')->
                 orderBy('created_at', 'desc')->paginate(10);

        if ($categoria == null){

        return $this->errorResponse($categoria);
        }
        return $this->successResponse($categoria);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $datos = array("id_categoria"=>$request->input("id_categoria"),
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
                'id_categoria'             => 'required|numeric',
                'descripcion'         => 'required|string|min:10|max:500',
                'usuario_creador'     => 'required|string',
                'usuario_modificador' => 'required|string',
                'estado'              => 'required|string'
            ],$messages);
            if ($validator->fails()) {
                $errors = $validator->errors();
                return response()->json($errors->all());
            }else{
             categorias::create($datos);
             return $this->successResponse($datos);
            }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\librerias\categorias  $categorias
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $categoria = categorias::find($id);
        if ($categoria == null){
            return $this->errorResponse($categoria);
        }
        return $this->successResponse($categoria);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\librerias\categorias  $categorias
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        $categoria = categorias::find($id);

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
             $categoria->update($request->all());
             return $this->successResponse($categoria);
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\librerias\categorias  $categorias
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $categoria = categorias::find($id);
        if ($categoria == null){

            return $this->response()->json(array("msj:" => "Registro no Existe"));
        }
         $categoria->update(['estado' => 'ELIMINADO']);
         return response()->json(array("msj:" => "Registro Eliminado"));
    }

}
