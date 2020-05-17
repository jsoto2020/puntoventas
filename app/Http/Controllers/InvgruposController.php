<?php

namespace App\Http\Controllers;

use App\librerias\invgrupos;
use Illuminate\Http\Request;
use App\Http\Controllers\api\ApiResponseController;

class InvgruposController extends ApiResponseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $grupo = invgrupos::select('id_grupo', 'descripcion','usuario_creador','usuario_modificador','estado')->
        where('estado','=','ACTIVO')->
        orderBy('created_at', 'desc')->paginate(10);

if ($grupo == null){

return $this->errorResponse($grupo);
}
return $this->successResponse($grupo);
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
        $datos = array("id_grupo"=>$request->input("id_grupo"),
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
                'id_grupo'             => 'required|numeric',
                'descripcion'         => 'required|string|min:10|max:500',
                'usuario_creador'     => 'required|string',
                'usuario_modificador' => 'required|string',
                'estado'              => 'required|string'
            ],$messages);
            if ($validator->fails()) {
                $errors = $validator->errors();
                return response()->json($errors->all());
            }else{
             invgrupos::create($datos);
             return $this->successResponse($datos);
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\librerias\invgrupos  $invgrupos
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $grupo = invgrupos::find($id);
        if ($grupo == null){
            return $this->errorResponse($grupo);
        }
        return $this->successResponse($grupo);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\librerias\invgrupos  $invgrupos
     * @return \Illuminate\Http\Response
     */
    public function edit(invgrupos $invgrupos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\librerias\invgrupos  $invgrupos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, invgrupos $id)
    {
        $grupo = invgrupos::find($id);

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
             $grupo->update($request->all());
             return $this->successResponse($grupo);
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\librerias\invgrupos  $invgrupos
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $grupo = invgrupos::find($id);
        if ($grupo == null){

            return $this->response()->json(array("msj:" => "Registro no Existe"));
        }
         $grupo->update(['estado' => 'ELIMINADO']);
         return response()->json(array("msj:" => "Registro Eliminado"));
    }

}
