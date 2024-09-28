<?php
class Controller {
    public function model($model) {
        // Use absolute path for the model file
        require_once __DIR__ . '/../models/' . $model . '.php';
        return new $model();
    }

    public function jsonResponse($data, $status = 200) {
        header("Content-Type: application/json");
        http_response_code($status);
        echo json_encode($data);
    }
}