<?php

  function conexaoBD(){
    $host = "192.168.0.2";
    $database = "dbpc1620182";
    $user = "pc1620182";
    $password = "senai127";

    if(!$conexao = mysqli_connect($host, $user, $password, $database))
        echo('ERROR 404');

     return $conexao;
  }

?>
