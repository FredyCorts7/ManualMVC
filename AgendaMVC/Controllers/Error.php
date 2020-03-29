<?php
    class Errors extends Controllers {
        function error() {
            // Utilizamos la variable $view la cual es la instancia de
            // nuestra clase Views creada dentro de la clase Controllers
            // por ello tenemos acceso a esta, ya que estamos heredando
            // de la clase Controllers
            $this->view->render($this, "Error404");
        }
    }