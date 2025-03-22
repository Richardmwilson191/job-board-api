<?php

namespace app\Controllers;

class Controller
{
    protected function getIdFromUrl()
    {
        $uri = trim($_SERVER['REQUEST_URI'], '/');
        $segments = explode('/', $uri);
        $id = end($segments);

        return is_numeric($id) ? (int) $id : null;
    }
}
