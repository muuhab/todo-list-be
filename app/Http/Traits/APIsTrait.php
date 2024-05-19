<?php

namespace App\Http\Traits;


trait APIsTrait {
    public function badRequest($message) {
        return response()->json([
            'status' => 400,
            'message' => $message,
        ]);
    }

    public function success($message='',$data=null) {
        $response = [
            'status' => 200,
            'message' => $message,
        ];
        if($data){
            $response['data'] = $data;
        }
        return response()->json($response);
    }

    public function notFound($message) {
        return response()->json([
            'status' => 404,
            'message' => $message,
        ]);
    }


}
