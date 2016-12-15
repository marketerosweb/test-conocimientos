<?php
$conexion = new mysqli('localhost', 'markete3_usercon', 'Vp8gu#0x_O0}', 'markete3_conocimientosphp');
//mysqli_set_charset($conexion, 'utf-8');
@$pregunta = $_POST['pregunta'];
@$respuesta1 = $_POST['respuesta1'];
@$respuesta2 = $_POST['respuesta2'];
@$respuesta3 = $_POST['respuesta3'];
@$respuesta4 = $_POST['respuesta4'];
@$respuesta = $_POST['respuesta'];
//@$programador = $_POST['programador'];
@$programador = 2;
$inscritos = 'INSERT INTO questions 
(question_name, answer1, answer2, answer3, answer4, answer, category_id)
VALUES 
("'.$pregunta.'","'.$respuesta1.'","'.$respuesta2.'","'.$respuesta3.'","'.$respuesta4.'","'.$respuesta.'","'.$programador.'" )'
;

$buscar = $conexion->query($inscritos);

header('Location: http://marketerosweb.website/test/insert/');
?>
