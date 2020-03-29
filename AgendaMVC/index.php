<?php
    require "config.php";
    $url = isset($_GET["url"]) ? $_GET["url"] : "Index/index";
    
    $url = explode("/", $url); // separo todo lo que este en la cadena de texto $url por "/"
    // Esta operación la realizamos para saber si la ruta de nuestro sitio web tiene la ruta
    // que necesitamos, que es la siguiente: http://dominio/nameController/nameMethod.
    // Por lo tanto nuetro vector $url tendrá el nameController en su primera posición
    // y el nameMethod en su segunda posición.
    
    $controller = "";
    $method = "";
    if(isset($url[0])) // verifico si existe el nombre del controlador en la ruta.
        $controller = $url[0];

    if(isset($url[1]) && $url[1] != "") // verifico si existe el nombre del método en la ruta.
        $method = $url[1];

    spl_autoload_register(function($class) {
        if(file_exists(LB.$class . ".php")) {
            require LB.$class . ".php";
        }
    });
    // Este proceso nos permite autocargar las clases que vamos a contruir dentro de
    // nuestra carpeta Library las cuales van a tener la logica necesaria para 
    // implementar de forma nativa nuestra arquitectura MVC

    require 'Controllers/Error.php';
    $error = new Errors(); // creamos una instancia de la clase Errors para mostrar 404
    
    $controllersPath = "Controllers/" . $controller . '.php';
    // Construimos el enlace a la clase controlador que obtuvimos mediante la ruta
    
    if(file_exists($controllersPath)) { // verificamos si el archivo controlador existe
        require $controllersPath;

        $controller = new $controller(); // creamos la instancia de nuestra clase controladora
    
        // verificamos si dentro de la ruta que obtuvimos se especificaba el metodo a ejecutar
        if(isset($method)) {
            // verificamos si el metodo obtenido en la ruta existe dentro de la clase controladora
            if(method_exists($controller, $method))
                $controller->{$method}(); // ejecutamos al metodo determinado por la ruta
            else
                $error->error(); // ejecutamos el método error que retornará la vista Error 404
        }
    } else
        $error->error();