<?php

namespace App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ApiResponse
{
    public static function rollback($e, $message = "Something when wrong! Process not completed.")
    {
        DB::rollback();
        self::throw($e, $message);
    }

    public static function throw($e, $message = "Something when wrong! Process not completed.")
    {
        Log::error($e);
        throw new \Illuminate\Http\Exceptions\HttpResponseException(
            response()->json(["message"=> $message], 500),
        );
    }

    public static function sendResponse($result, $message, $code = 200, $success = true)
    {
        $response = [
            'success' => $success,
            'message' => $message ?? null,
            'data'=> $result,
        ];

        return response()->json($response, $code); 
    }

    public static function success($result, $message, $code = 200, $success = true)
    {
        return self::sendResponse($result, $message, $code, $success);
    }

    public static function error($result, $message, $code = 500, $success=false)
    {   
        return self::sendResponse($result, $message, $code, $success);
    }
}
