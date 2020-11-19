<?php 
//$NroTransac = $_REQUEST['NroTransac'];
$NroCtaOrigen = $_REQUEST['NroCtaOrigen'];
$NroCtaDest = $_REQUEST['NroCtaDest'];
$Hora = $_REQUEST['Hora'];
$Fecha = $_REQUEST['Fecha'];
$Valor = $_REQUEST['Valor'];
$cnx =  mysqli_connect("localhost","root","","bdbanco");
$result = mysqli_query($cnx,"select Nrocuenta from cuenta where Nrocuenta = '$NroCtaDest'");
$rta = "";
if (mysqli_num_rows($result)==0)
{
	//echo "Transacción no permitida";
	$rta = "0";
}
else
{
	$saldo_destino = mysqli_fetch_array(mysqli_query($cnx, "select saldo from cuenta where Nrocuenta = '$NroCtaDest'"));
	$saldo_origen = mysqli_fetch_array(mysqli_query($cnx, "select saldo from cuenta where Nrocuenta = '$NroCtaOrigen'"));
	$resto = $saldo_origen[0]-10000;
	if ($resto>=$Valor)
	{
		$saldo_destino[0] = $saldo_destino[0] + $Valor;
		$saldo_origen[0] = $saldo_origen[0] - $Valor;
		mysqli_query($cnx,"INSERT INTO transaccion (NroCtaOrigen,NroCtaDest,Hora,Fecha,Valor) VALUES ('$NroCtaOrigen','$NroCtaDest','$Hora','$Fecha','$Valor')");
		mysqli_query($cnx, "UPDATE cuenta SET saldo = '$saldo_destino[0]' WHERE Nrocuenta = '$NroCtaDest'");
		mysqli_query($cnx, "UPDATE cuenta SET saldo = '$saldo_origen[0]' WHERE Nrocuenta = '$NroCtaOrigen'");
		$rta = "1";
	}
	else
	{
		$rta="2";
	}
	
	
}
echo $rta;
mysqli_close($cnx);
?>