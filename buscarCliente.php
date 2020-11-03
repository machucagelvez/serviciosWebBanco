<?php 
	if (isset($_REQUEST['usuario']) && isset($_REQUEST['contrasena']))
	{
		$usuario=$_REQUEST['usuario'];
		$contrasena=$_REQUEST['contrasena'];
		$cnx =  mysqli_connect("localhost","root","","bdbanco");
		mysqli_query($cnx,"SET NAMES 'utf8'");
		//Ejecutar una sentencia SELECT y recibir una respuesta
		$res = $cnx->query("select usuario, ident, nombre from cliente where usuario = '$usuario' and contrasena = '$contrasena'");
		//si existe el usuario la variable res queda en 1 y sino en 0
		//En este arreglo se guardará la informacion para pasarla a formato JSON
		$json = array();
		foreach ($res as $row) 
		{
			$json['cliente'][]=$row;
		}
		//pasar los datos del array a JSON con informacion o vacío
		echo json_encode($json,JSON_UNESCAPED_UNICODE);
	}
	else
	{
		echo "El correo y la clave son obligatorios";
	}

 ?>