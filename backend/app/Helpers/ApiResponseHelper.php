<?php

namespace App\Helpers;

class ApiResponseHelper
{
    public static function success($message = 'Success', $status = 200, $data = null)
    {

        $response = [
            'success' => true,
            'message' => $message,
        ];
        if ($data !== null) {
			$response['data'] = $data;
		}
        return response()->json($response, $status);
    }

    public static function error($message = 'An error occurred', $status = 500, $errors = null,)
    {

        $response = [
            'success' => false,
            'message' => $message,
        ];
        if (!empty($errors)) {
            $response['errors'] = $errors;
        }
        return response()->json($response, $status);
    }
}
