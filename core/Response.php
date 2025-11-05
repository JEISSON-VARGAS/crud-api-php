<?php
class Response {

    public static function json($data, $statusCode = 200) {
        header('Content-Type: application/json; charset=utf-8');
        http_response_code($statusCode);
        echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        exit;
    }

    public static function error($message, $statusCode = 400) {
        self::json(["error" => $message], $statusCode);
    }
}