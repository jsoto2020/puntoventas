<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\librerias\invProducto;
use Illuminate\Routing\Controller;
use App\Http\Controllers\api\ApiResponseController;

class invProductos extends ApiResponseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productos = invProducto::select('codigo', 'descripcion','descripcion_us','unidadMed','precio_compra','precio_venta','usuario_creador',
                                          'usuario_modificador','stock','id_categoria','id_brand','referencia',
                                          'ultimoproveedor','ultimaFechaCompra','porcientodescuento','fechadescuento',
                                          'estado')->
                           where('estado','=','ACTIVO')->
        orderBy('created_at', 'desc')->paginate(10);

         if ($productos == null){

            return $this->errorResponse($productos);
        }
        return $this->successResponse($productos);

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
        $datos = array(
        "codigo"               =>$request->input("codigo"),
        "descripcion"          =>$request->input("descripcion"),
        "descripcion_us"       =>$request->input("descripcion_us"),
        "unidadMed"            =>$request->input("unidadMed"),
        "id_categoria"         =>$request->input("id_categoria"),
        "id_brand"             =>$request->input("id_brand"),
        "imagen"               =>$request->input("imagen"),
        "estado"               =>$request->input("estado"),
        "referencia"           =>$request->input("referencia"),
        "usuario_creador"      =>$request->input("usuario_creador"),
        "fechadescuento"       =>$request->input("fechadescuento"),
        "porcientodescuento"   =>$request->input("porcientodescuento"),
        "ultimoproveedor"      =>$request->input("ultimoproveedor"),
        "ultimaFechaCompra"    =>$request->input("ultimaFechaCompra"),
        "usuario_modificador"  =>$request->input("usuario_modificador")
        );

        $messages = [
             'required' => 'El campo :attribute es requerido.',
             'unique'   => 'El campo :attribute debe ser unico',
             'numeric'  => 'El campo :attribute debe ser numerico',
             ];

             $validator = validator($datos, [
                'codigo'              => 'required|unique:invProductos',
                'descripcion'         => 'required|string|min:10|max:500',
                'descripcion_us'      => 'required|string|min:10|max:500',
                'unidadMed'           => 'required|string|min:4',
                'id_categoria'        => 'required|numeric',
                'id_brand'            => 'required|numeric',
                'usuario_creador'     => 'required|string',
                'usuario_modificador' => 'required|string'

            ],$messages);
            if ($validator->fails()) {
                $errors = $validator->errors();
                return response()->json($errors->all());
            }else{
             invProducto::create($datos);
             return $this->successResponse($datos);
            }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $producto = invProducto::find($id);
        if ($producto == null){
            return $this->errorResponse($producto);
        }
        return $this->successResponse($producto);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $producto = invProducto::find($id);

        $datos = array(
        "descripcion"         =>$request->input("descripcion"),
        "descripcion_us"      =>$request->input("descripcion_us"),
        "unidadMed"           =>$request->input("unidadMed"),
        "id_categoria"        =>$request->input("id_categoria"),
        "id_brand"            =>$request->input("id_brand"),
        "imagen"              =>$request->input("imagen"),
        "estado"              =>$request->input("estado"),
        "referencia"           =>$request->input("referencia"),
        "ultimoproveedor"      =>$request->input("ultimoproveedor"),
        "ultimaFechaCompra"    =>$request->input("ultimaFechaCompra"),
        "usuario_modificador" =>$request->input("usuario_modificador"));

        $messages = [
             'required' => 'El campo :attribute es requerido.',
             'unique'   => 'El campo :attribute debe ser unico',
             'numeric'  => 'El campo :attribute debe ser numerico',
             ];

             $validator = validator($datos, [

                'descripcion_us' => 'required|string|min:10|max:500',
                'unidadMed'      => 'required|string|min:4',
                'id_categoria'   => 'required|numeric',
                'id_brand'       => 'required|numeric',

                'usuario_modificador' => 'required|string'
            ],$messages);
            if ($validator->fails()) {
                $errors = $validator->errors();
                return response()->json($errors->all());
            }else{
             $producto->update($request->all());
             return $this->successResponse($producto);
            }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $producto = invProducto::find($id);
        if ($producto == null){

            return $this->response()->json(array("msj:" => "Registro no Existe"));
        }
         $producto->update(['estado' => 'ELIMINADO']);
         return response()->json(array("msj:" => "Registro Eliminado"));
    }

}
