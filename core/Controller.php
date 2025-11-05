<?php
require_once __DIR__ . '/../core/Response.php';

class Controller { 

    protected function json ($data, $statusCode = 200) {
        Response::json($data, $statusCode);
    }

    protected function error ($message, $statusCode = 400) {
        Response::error($message, $statusCode);
    }
}