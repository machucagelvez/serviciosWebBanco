<?php 
	if (isset($_REQUEST['NroTransac']) && isset($_REQUEST['NroCtaOrigen']))
	{
		$NroTransac = $_REQUEST['NroTransac'];
        $NroCtaOrigen = $_REQUEST['NroCtaOrigen'];
		$cnx =  mysqli_connect("localhost","root","","bdbanco");
		mysqli_query($cnx,"SET NAMES 'utf8'");
		//Ejecutar una sentencia SELECT y recibir una respuesta
		$res = $cnx->query("select * from transaccion where NroTransac = '$NroTransac' and NroCtaOrigen = '$NroCtaOrigen'");
		//si existe el usuario la variable res queda en 1 y sino en 0
		//En este arreglo se guardará la informacion para pasarla a formato JSON
		$json = array();
		foreach ($res as $row) 
		{
			$json['transacción'][]=$row;
		}
		//pasar los datos del array a JSON con informacion o vacío
		echo json_encode($json,JSON_UNESCAPED_UNICODE);
	}
	else
	{
		echo "El NroTransac y la NroCtaOrigen son obligatorios";
	}

 ?>