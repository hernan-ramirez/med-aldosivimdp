<? if ($inc=="llave") { $limit = 2; } else { $limit = 5; } ?>

<table border="0" cellspacing="0" cellpadding="0" width="239">
<TR>
<TD colspan="2" class="EspecialesTitleGray"><B>Expulsados Aldosivi</B></TD>
</TR>
<tr> 
  <TD width="179" class="BackGreenRight">Nombre</td>
  <TD width="60" align="center" class="BackGreenRight"><b>Tarjetas&nbsp;&nbsp;</b></td>
</tr>
<?
$sql = "SELECT t.tarjeta, t.id_jugador, j.nombre, j.apellido , COUNT(t.id_jugador) as tarj FROM futbol_tarjetas t
		LEFT JOIN futbol_jugadores j ON (t.id_jugador = j.id)
		LEFT JOIN futbol_planteles pl ON (j.id = pl.id_jugador)
		WHERE pl.id_clubes = 1
		AND tarjeta = 1
		GROUP BY t.id_jugador
		ORDER by tarj DESC
		LIMIT $limit";
		$result = mysql_query ($sql);
		if(mysql_num_rows($result)!=0){
			while ($row = mysql_fetch_array($result)){
?>
<tr> 
	<td class="EspecialesGray"><? echo $row["apellido"] ?>, 
		<? echo $row["nombre"] ?> </td>
	<td align="center" class="EspecialesGreen"><? echo $row["tarj"] ?></td>
</tr>
<?
} 
	}
?>
<tr> 
    <TD Colspan="2" align="right" class="EspecialesGray"><A HREF="javascript:abrirVentana('expulsados_ow.php','Expulsados',400,350);"><IMG src="../img/vermas.gif" width="44" height="7" hspace="8" border="0"></A></td>
</tr>
</table>

