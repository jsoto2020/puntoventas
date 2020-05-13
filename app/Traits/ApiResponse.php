<?php

namespace App\traits;

trait ApiResponse{

    public function successResponse($data, $code = 200, $msj = 'Respuesta Exitosa')
    {

        return response()->json(array("data" => $data, "code" => $code, "msj" => $msj), $code);
    }

    public function errorResponse($data, $code = 404, $msj = 'Repuesta con errores')
    {
        if ($data ==null){
            $msj = 'NO EXISTEN REGISTROS';
        };
        return response()->json(array("data" => $data, "code" => $code, "msj" => $msj), $code);
    }

}
