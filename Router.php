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

        // $currentUrl = $_SERVER['PATH_INFO'] ?? '/'; // For developing
        $currentUrl = $_SERVER['REQUEST_URI'] === '' ? '/' : $_SERVER['REQUEST_URI']; //For production deployment
        $method = $_SERVER['REQUEST_METHOD'];
    
        //Split currentURL if '?'
        $splitURL = explode('?', $currentUrl);

        if ($method === 'GET') {
            $fn = $this->getRoutes[$splitURL[0]] ?? null; //$splitURL[0] url without vars
        } else {
            $fn = $this->postRoutes[$splitURL[0]] ?? null;
        }


        if ( $fn ) {
            // Call user fn calls function named
            call_user_func($fn, $this); // $this is for args
        } else {
            echo "Página No Encontrada o Ruta no válida";
        }
    }

    public function render($view, $datos = [])
    {
        $squares = false;

        // Read render args from controllers
        foreach ($datos as $key => $value) {
            $$key = $value;  // basically our variable remains the original, but assigning it to another does not rewrite it, it keeps its value, in this way the variable name is assigned dynamically
        }

        ob_start(); // Keep in memory a few time

        // then include in layout
        include_once __DIR__ . "/views/$view.php";
        $contenido = ob_get_clean(); // Limpia el Buffer
        include_once __DIR__ . '/views/layout.php';
    }
}
