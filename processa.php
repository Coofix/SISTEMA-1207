<?php

include("php/conexao.php");

$id_paciente = filter_input(INPUT_POST, 'id_paciente', FILTER_SANITIZE_STRING);
$tipo_ref = filter_input(INPUT_POST, 'tipo_ref', FILTER_SANITIZE_STRING);
$tipo_acom = filter_input(INPUT_POST, 'tipo_acom', FILTER_SANITIZE_STRING);
$descricao = filter_input(INPUT_POST, 'descricao', FILTER_SANITIZE_STRING);
$medicacao = filter_input(INPUT_POST, 'medicacao', FILTER_SANITIZE_STRING);
$hora = filter_input(INPUT_POST, 'hora', FILTER_SANITIZE_STRING);
$dosagem = filter_input(INPUT_POST, 'dosagem', FILTER_SANITIZE_STRING);
$intervalo = filter_input(INPUT_POST, 'intervalo', FILTER_SANITIZE_STRING);
$observacao = filter_input(INPUT_POST, 'observacao', FILTER_SANITIZE_STRING);



$result_acomp = "INSERT INTO diario (
 id_paciente, tipo_ref, tipo_acom, descricao, medicacao, hora, dosagem, intervalo, observacao, criado) 
VALUES ( '$id_paciente', '$tipo_ref', '$tipo_acom', '$descricao', '$medicacao', '$hora', '$dosagem', '$intervalo', '$observacao', NOW())";
$resultado_diario = mysqli_query($mysqli, $result_acomp);

if(mysqli_insert_id($mysqli)){
	header("Location: dadosdiarios.php");
}else{
	header("Location: dadosdiarios.php");
}