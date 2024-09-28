<?php

namespace Core;

class Responder
{
    // Send a JSON response with the correct headers
    public static function json($data, $statusCode = 200)
    {
        header('Content-Type: application/json; charset=UTF-8');
        http_response_code($statusCode);
        echo json_encode($data);
        exit;
    }

    // Send a 404 Not Found response
    public static function notFound($message = 'Resource not found')
    {
        self::json(['error' => $message], 404);
    }

    // Send a 500 Internal Server Error response
    public static function serverError($message = 'Internal server error')
    {
        self::json(['error' => $message], 500);
    }

    // Send a 400 Bad Request response
    public static function badRequest($message = 'Bad request')
    {
        self::json(['error' => $message], 400);
    }

    // Send a 200 OK success response
    public static function success($data, $message = 'Request successful')
    {
        $response = [
            'message' => $message,
            'data' => $data
        ];
        self::json($response, 200);
    }
}
