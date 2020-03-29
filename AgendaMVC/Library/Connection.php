<?php
    class Connection {
        function __construct() {
            // creamos una variable $db para instanciar a la clase PDOManager
            // y poder utilizarla desde un determinado modelo
            $this->db = new PDOManager("root", "", "db_contactos");
        }
    }