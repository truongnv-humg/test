<?php
namespace App\Http\Traits;

trait Response
{
    public function response($code = 200, $data = null, $message = null)
    {
        return response()->json([
            'code' => $code,
            'message' => $message,
            'data' => $data
        ]);
    }
}
