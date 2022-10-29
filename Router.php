<?php

namespace MVC;

class Router
{
    public array $getRoutes = [];
    public array $postRoutes = [];

    public function get($url, $fn)
    {
        $this->getRoutes[$url] = $fn;
    }

    public function post($url, $fn)
    {
        $this->postRoutes[$url] = $fn;
    }

    public function comprobarRutas()
    {

        if (isset($_SERVER['PATH_INFO'])) {
            $currentUrl = $_SERVER['PATH_INFO'] ?? '/';
        }
        else {
            $currentUrl = $_SERVER['REQUEST_URI'] === '' ? '/' : $_SERVER['REQUEST_URI'];
        }

        $method = $_SERVER['REQUEST_METHOD'];

        // Dividimos la URL actual cada vez que exista un '?' eso indica que se están pasando variables por la url
        $splitURL = explode('?', $currentUrl);

        if ($method === 'GET') {
            $fn = $this->getRoutes[$splitURL[0]] ?? null;
        } else {
            $fn = $this->postRoutes[$splitURL[0]] ?? null;
        }

        if ( $fn ) {
            call_user_func($fn, $this);
        } else {
            header('Location: /404');
        }
    }

    public function render($view, $datos = [])
    {
        foreach ($datos as $key => $value) {
            $$key = $value; 
        }

        ob_start(); 

        include_once __DIR__ . "/views/$view.php";

        $contenido = ob_get_clean(); // Limpia el Buffer

        // Utilizar el layout de acuerdo a la URL
        if (isset($_SERVER['PATH_INFO'])) {
            $currentUrl = $_SERVER['PATH_INFO'] ?? '/';
        }
        else {
            $currentUrl = $_SERVER['REQUEST_URI'] === '' ? '/' : $_SERVER['REQUEST_URI'];
        }

        // Verificar si estamos en el area de administrador o no
        if(str_contains($currentUrl, '/admin')) {
            include_once __DIR__ . '/views/admin-layout.php';
        }
        else{
            include_once __DIR__ . '/views/layout.php';
        }
    }
}
