<?php

  function conexaoBD(){
    $host = "localhost";
    $database = "db_bugs_bunny";
    $user = "root";
    $password = "bcd127";

    if(!$conexao = mysqli_connect($host, $user, $password, $database))
        echo('ERROR 404');

     return $conexao;
  }

?>
