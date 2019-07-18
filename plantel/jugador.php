<? $path = "../" ?>
<? include "../common/conexion.php"; ?>

<?
$sql = "SELECT * FROM futbol_jugadores
WHERE id = $id";
$result = mysql_query ($sql);
if(mysql_num_rows($result)!=0){
	$row = mysql_fetch_array($result);
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<HTML>
<HEAD>
<TITLE><? echo $row["apellido"] ?></TITLE>
<META http-equiv="" content="text/html; charset=iso-8859-1">
<link href="../estilos.css" rel="stylesheet" type="text/css">
<META http-equiv="" content="text/html; charset=iso-8859-1"><META http-equiv="" content="text/html; charset=iso-8859-1"></HEAD>
<BODY bgcolor="#E1E1E1" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr> 
	  <td background="../img/top_especial.gif"><img width="1" height="8"></td>
	</tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr> 
		<td width="212"><img src="../img/left_plantel.gif" width="212" height="37"></td>
		<td width="100%" class="BackHespeciales">&nbsp;</td>
		<td width="89"><img src="../img/especiales_year.gif" width="89" height="37"></td>
	</tr>
</table> 
<TABLE width="100%" border="0" cellpadding="0" cellspacing="0">
	<TR> 
		<TD width="10%" nowrap class="EspecialesGray">Apellido</TD>
		
	<TD width="90%" class="EspecialesGreen"><? echo $row["apellido"] ?>&nbsp;</TD>
	</TR>
	<TR> 
		<TD nowrap class="EspecialesGray">Nombre</TD>
		
	<TD class="EspecialesYellow"><? echo $row["nombre"] ?>&nbsp;</TD>
	</TR>
	<TR> 
		<TD nowrap class="EspecialesGray">Puesto</TD>
		
	<TD class="EspecialesGreen"><? echo $row["puesto"] ?>&nbsp;</TD>
	</TR>
	<TR> 
		<TD nowrap class="EspecialesGray">Fecha de Nacimiento</TD>
		
	<TD class="EspecialesYellow"><? echo $row["fecha_nacimiento"] ?>&nbsp;</TD>
	</TR>
	<TR> 
		<TD nowrap class="EspecialesGray">Lugar de Nacimiento</TD>
		
	<TD class="EspecialesGreen"><? echo $row["lugar_nacimiento"] ?>&nbsp;</TD>
	</TR>
	<TR> 
		<TD nowrap class="EspecialesGray">Altura</TD>
		<TD class="EspecialesYellow"><? echo $row["altura"] ?> mts.</TD>
	</TR>
	<TR> 
		<TD nowrap class="EspecialesGray">Peso</TD>
		<TD class="EspecialesGreen"><? echo $row["peso"] ?> kg.</TD>
	</TR>
</TABLE>
<TABLE width="100%" border="0" cellpadding="0" cellspacing="0">
	<TR> 
		
	<TD class="EspecialesYellow"><b>Trayectoria:</b>&nbsp;<? echo nl2br($row["trayectoria"]) ?></TD>
	</TR>
</TABLE>

<TABLE width="100%" border="0" cellspacing="0" cellpadding="0">
  <TR>
	<TD class="EspecialesTitleGray">Estadisticas en Torneo Argentino A</TD>
  </TR>
</TABLE>
<TABLE width="100%" border="0" cellspacing="0" cellpadding="0">
<?
$sql = "SELECT id_jugador, COUNT(id_jugador) as goles
FROM futbol_goleadores
WHERE id_jugador = $id
GROUP BY id_jugador";
$result = mysql_query ($sql);
if(mysql_num_rows($result)!=0){
	$row = mysql_fetch_array($result);
?>
	<TR> 
		<TD width="100" nowrap class="EspecialesGray">Goles</TD>
		<TD class="EspecialesGreen"><? echo $row["goles"] ?> </TD>
	</TR>
</TABLE>
<?
	}
?>
<TABLE width="100%" border="0" cellspacing="0" cellpadding="0">
<?
$sql = "SELECT id_jugador, COUNT(id_jugador) as tarj
FROM futbol_tarjetas
WHERE tarjeta = 0
AND id_jugador = $id
GROUP BY id_jugador";
$result = mysql_query ($sql);
if(mysql_num_rows($result)!=0){
	$row = mysql_fetch_array($result);
?>
	<TR> 
		<TD width="100" nowrap class="EspecialesGray">Amarillas</TD>
		<TD class="EspecialesGreen"><? echo $row["tarj"] ?> </TD>
	</TR>
</TABLE>
<?
	}
?>
<TABLE width="100%" border="0" cellspacing="0" cellpadding="0">
<?
$sql = "SELECT id_jugador, COUNT(id_jugador) as tarj
FROM futbol_tarjetas
WHERE tarjeta = 1
AND id_jugador = $id
GROUP BY id_jugador";
$result = mysql_query ($sql);
if(mysql_num_rows($result)!=0){
	$row = mysql_fetch_array($result);
?>
	<TR> 
		<TD width="100" nowrap class="EspecialesGray">Expulsiones</TD>
		<TD class="EspecialesGreen"><? echo $row["tarj"] ?> </TD>
	</TR>
</TABLE>
<?
	}
?>

</BODY>
</HTML>

<?
	}
?>