<?php

    function conectar(){
        $Server = "127.0.0.1";
        $Usuario = "root";
        $Pwd = "";
        $BD = "inmoviliaria";

        $Con=mysqli_connect($Server, $Usuario, $Pwd, $BD);
        return $Con;
    }
    function ejecutar($Con, $sql){
        $resultSet = mysqli_query($Con, $sql);
        return $resultSet;
    }

    function procesar($resultSet){

    }

    function desconectar($Con){
        $r=mysqli_close($Con);
        return $r;
    }


?>