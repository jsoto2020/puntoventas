<?php

namespace App\Http\Controllers;

use App\librerias\brands;
use Illuminate\Http\Request;
use App\Http\Controllers\api\ApiResponseController;

class BrandsController extends ApiResponseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brand = brands::select('id_brand', 'descripcion','usuario_creador','usuario_modificador','estado')->
        where('estado','=','ACTIVO')->
        orderBy('created_at', 'desc')->paginate(10);

        if ($brand == null){

        return $this->errorResponse($brand);
        }
        return $this->successResponse($brand);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $datos = array("id_brand"=>$request->input("id_brand"),
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
                'id_brand'             => 'required|numeric',
                'descripcion'         => 'required|string|min:10|max:500',
                'usuario_creador'     => 'required|string',
                'usuario_modificador' => 'required|string',
                'estado'              => 'required|string'
            ],$messages);
            if ($validator->fails()) {
                $errors = $validator->errors();
                return response()->json($errors->all());
            }else{
             brands::create($datos);
             return $this->successResponse($datos);
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\librerias\brands  $brands
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $brand = brands::find($id);
        if ($brand == null){
            return $this->errorResponse($brand);
        }
        return $this->successResponse($brand);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\librerias\brands  $brands
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $brand = brands::find($id);

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
             $brand->update($request->all());
             return $this->successResponse($brand);
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\librerias\brands  $brands
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $brand = Invtipos::find($id);
        if ($brand == null){

            return $this->response()->json(array("msj:" => "Registro no Existe"));
        }
         $brand->update(['estado' => 'ELIMINADO']);
         return response()->json(array("msj:" => "Registro Eliminado"));
    }

}
