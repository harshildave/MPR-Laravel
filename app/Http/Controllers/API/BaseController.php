<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

class BaseController extends Controller
{
    public function sendResponse($message, $data = [], $code = 200)
    {
        $response = [
            "status" => true,
            "message" => $message,
            "data" => $data,
        ];
        return response()->json($response, $code);
    }

    public function sendError($message, $data = [], $code = 400)
    {
        $response = [
            "status" => false,
            "message" => $message,
            "data" => $data,
        ];

        return response()->json($response, $code);
    }
}
