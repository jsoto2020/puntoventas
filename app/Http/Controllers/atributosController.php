<?php

namespace App\Http\Controllers;

use App\librerias\atributos;
use Illuminate\Http\Request;
use App\Http\Controllers\api\ApiResponseController;


class atributosController extends ApiResponseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $atributo = atributos::select('id_atributo', 'nombre','descripcion','tipo','usuario_creador','usuario_modificador','estado','configuracion')->
        where('estado','=','ACTIVO')->
        orderBy('created_at', 'desc')->paginate(10);

        if ($atributo == null){

        return $this->errorResponse($atributo);
        }
        return $this->successResponse($atributo);
    }


    public function store(Request $request)
    {
        $datos = array("id_atributo"=>$request->input("id_atributo"),
        "descripcion"        =>$request->input("descripcion"),
        "nombre"             =>$request->input("nombre"),
        "tipo"               =>$request->input("tipo"),
        "configuracion"      =>$request->input("configuracion"),
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
                'id_atributo'             => 'required|numeric',
                'nombre'                  => 'required|string|min:10|max:500',
                'tipo'                    => 'required|string',
                'usuario_creador'         => 'required|string',
                'estado'                  => 'required|string'
            ],$messages);
            if ($validator->fails()) {
                $errors = $validator->errors();
                return response()->json($errors->all());
            }else{
             atributos::create($datos);
             return $this->successResponse($datos);
            }
    }

    public function show($id)
    {

        $atributo = atributos::find($id);
        if ($atributo == null){
            return $this->errorResponse($atributo);
        }
        return $this->successResponse($atributo);
    }

    public function update(Request $request, $id)
    {
         $atributo = atributos::find($id);

        $datos = array(
        "descripcion"=>$request->input("descripcion"),
        "nombre"=>$request->input("nombre"),
        "tipo"=>$request->input("tipo"),
        "configuracion"=>$request->input("configuracion"),
        "usuario_modificador"=>$request->input("usuario_modificador"));

        $messages = [
             'required' => 'El campo :attribute es requerido.',
             'unique'   => 'El campo :attribute debe ser unico',
             'numeric'  => 'El campo :attribute debe ser numerico',
             ];

             $validator = validator($datos, [
                'descripcion' => 'required|string|min:10|max:500',
                'nombre' => 'required|string|min:10|max:100',
                'tipo' => 'required|string|min:3|max:100',
                'usuario_modificador' => 'required|string'
            ],$messages);
            if ($validator->fails()) {
                $errors = $validator->errors();
                return response()->json($errors->all());
            }
            else{
             $atributo->update($request->all());
             return $this->successResponse($atributo);
            }


    }

    public function destroy($id)
    {
        $atributo = atributos::find($id);
        if ($atributo == null){

            return $this->response()->json(array("msj:" => "Registro no Existe"));
        }
         $atributo->update(['estado' => 'ELIMINADO']);
         return response()->json(array("msj:" => "Registro Eliminado"));
    }

}


