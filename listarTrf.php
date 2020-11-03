<?php
    $usuario = $_REQUEST['usuario'];
    if (isset($_REQUEST['usuario']))
    {        
        $cnx =  mysqli_connect("localhost","root","","bdbanco");//(dir IP servidor, usuario, clave, nombre de la bd)
        mysqli_query($cnx,"SET NAMES 'utf8'");
        $Cta = mysqli_fetch_array(mysqli_query($cnx, "SELECT Nrocuenta from cuenta where usuario = '$usuario'"));        
        $NroCtaOrigen = $Cta[0];
        $res = $cnx->query("SELECT NroCtaDest, Valor, Fecha, Hora from transaccion where NroCtaOrigen = '$NroCtaOrigen'");
        //si existen usuarios la variable res queda en 1 y si no en 0
        //En este arreglo se guardará la informacion para pasarla a formato JSON
        $json = array();
        foreach ($res as $row) 
        {
            $json['transacciones'][]=$row;
        }
        //pasar los datos del array a JSON con informacion o vacío
        //echo json_encode($json);
        echo json_encode($json,JSON_UNESCAPED_UNICODE);
    }
    else
    {
        echo "El NroCtaOrigen es obligatorio";
    }
    
	
?>