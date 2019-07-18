<? include "../common/conexion.php"; ?>
<? include "../inicio.php" ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
<TITLE>Goleadores Aldosivi</TITLE>
<SCRIPT language="JavaScript" src="../admin/includes/javas.js" type="text/javascript"></SCRIPT>
<LINK href="../estilos.css" rel="stylesheet" type="text/css">
</HEAD>
<BODY>
<table border="0" cellspacing="0" cellpadding="0" width="100%">
<TR>
<TD colspan="2" class="EspecialesTitleGray"><B>Goleadores Aldosivi</B></TD>
</TR>
<tr> 
  <TD width="179" class="BackGreenRight">Nombre</td>
  <TD width="60" align="center" class="BackGreenRight"><b>Goles&nbsp;&nbsp;</b></td>
</tr>
<?
$sql = "SELECT g.id_jugador, j.nombre, j.apellido, j.id, COUNT(g.id_jugador) as goles FROM futbol_goleadores g
		LEFT JOIN futbol_jugadores j ON (g.id_jugador = j.id)
		LEFT JOIN futbol_planteles pl ON (j.id = pl.id_jugador)
		WHERE pl.id_clubes = 1
		AND id_tipo_goles < 5
		GROUP BY g.id_jugador
		ORDER by goles DESC";
$result = mysql_query ($sql);
if(mysql_num_rows($result)!=0){
	while ($row = mysql_fetch_array($result)){
?>
<tr> 
	<td class="EspecialesGray"><? echo $row["apellido"] ?>, 
		<? echo $row["nombre"] ?> </td>
	<td align="center" class="EspecialesGreen"><? echo $row["goles"] ?></td>
</tr>
<?
} 
	}
?>
</table>
<BR>
</BODY>
</HTML>

