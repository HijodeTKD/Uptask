<?php

//Debug
function debuguear($variable) : string {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

// Sanitize HTML
function s($html) : string {
    $s = htmlspecialchars($html);
    return $s;
}

// User is auth?
function isAuth() : void {
    if(!isset($_SESSION['login'])) {
        header('Location: /');
    }
}

//Checks from where webpage user come
function from($desde) : string{
    $splitURL = explode('?', $desde);

    switch ($splitURL[0]) {
        case 'http://localhost:3000/':
            $resultado = 'fromcyan';
            return $resultado; 
            break;
        case 'http://localhost:3000/olvide':
            $resultado = 'fromorange';
            return $resultado; 
            break;
        case 'http://localhost:3000/crear':
            $resultado = 'frompurple';
            return $resultado; 
            break;
        case 'http://localhost:3000/mensaje':
            $resultado = 'fromgreenyellow';
            return $resultado; 
            break;
        case 'http://localhost:3000/confirmar':
            $resultado = 'fromgreen';
            return $resultado; 
            break;
        case 'http://localhost:3000/reestablecer':
            $resultado = 'fromorangeyellow';
            return $resultado; 
            break;
        default:
            $resultado = 'fromcyan';
            return $resultado;
            break;
    }
}   
