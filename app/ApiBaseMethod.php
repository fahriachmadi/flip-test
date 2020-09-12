<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ApiBaseMethod extends Model
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public static function sendResponse($result, $message)
    {

        $response = [
            'success' => 'true',
            'status' => '200',
            'data'    => $result,
            'message' => $message,
        ];
        
        return response()->json($response, 200);
    }


    /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */
    public static function sendError($error, $errorMessages = [], $code = 404)
    {
        $response = [
            'success' => false,
            'status' => $code,
            'message' => $error,
        ];


        if (!empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }


        return response()->json($response, $code);
    }
}
