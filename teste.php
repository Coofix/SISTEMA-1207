<?php

    include("php/conexao.php");

    $sql_code_idenfer = "SELECT max(id_paciente) as id_paciente FROM PACIENTE";
    $sql_query_idenfer = $mysqli->query($sql_code_idenfer) or die($mysqli->error);
    $numero = $sql_query_idenfer->fetch_assoc();

    //echo $numero['id_paciente'];

     $select = $numero['id_paciente'] ;
    echo $select; 
    echo "teste";

?>