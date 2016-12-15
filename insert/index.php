<?php
				$conexion = new mysqli('localhost', 'markete3_usercon', 'Vp8gu#0x_O0}', 'markete3_conocimientosphp');
mysqli_set_charset($conexion,"utf8");

$strConsulta = "SELECT * FROM categories";+

$total = '<option value="">tipo de programador</option>';
$result = $conexion->query($strConsulta);
		while( $resultadoTotal = $result->fetch_array() )
		{
			$total.='<option value="'.$resultadoTotal['id'].'">'.$resultadoTotal['category_name'].'</option>';
		}
	?>
<!DOCTYPE html>
<html>
<head>
	<title>Ingresar preguntas</title>
</head>
<body>
	<form method="post" action="insertar.php">
		<input type="text" name="pregunta" placeholder="Ingresa la pregunta"> <br />
		<input type="text" name="respuesta1" placeholder="Ingresa la repuesta 1"> <br />
		<input type="text" name="respuesta2" placeholder="Ingresa la repuesta 2"> <br />
		<input type="text" name="respuesta3" placeholder="Ingresa la repuesta 3"> <br />
		<input type="text" name="respuesta4" placeholder="Ingresa la repuesta 4"> <br />
		<input type="number" name="respuesta" placeholder="Ingresa el número de la respuesta"> <br />
		<select name="programador">
		
			<?php
				echo $total;
			?>
		</select>
		<input type="submit" value="Ingresar">
	</form>
</body>
</html>