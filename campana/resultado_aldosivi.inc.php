<?
	$sql = "
	SELECT  c1.alias AS L, p.goles_primer_club, p.goles_segundo_club, p.id, c2.alias AS V 
	FROM futbol_partidos p
		LEFT JOIN futbol_clubes c1 ON(c1.id = p.id_primer_club)
		LEFT JOIN futbol_clubes c2 ON(c2.id = p.id_segundo_club)
	WHERE p.fecha_partido < now()
	AND (
	p.id_primer_club = 1
	OR p.id_segundo_club = 1
	)
	ORDER BY fecha_partido DESC 
	LIMIT 1
	";
	$result = mysql_query($sql);
	if(mysql_num_rows($result)!=0){
		$row = mysql_fetch_array($result);
		?>
<TABLE border="0" cellpadding="0" cellspacing="0">
<TR> 
	<TD><IMG src="../img/left_resultados_ads.gif" width="3" height="30"><IMG src="../img/resultado.gif" width="91" height="30"></TD>
	<TD class="BackResultadosAds"><? echo $row["L"]  ?></TD>
	<TD class="BackResultadosAds"><B><FONT color="F7C30C" size="4"><? echo $row["goles_primer_club"] ?>&nbsp;-&nbsp;<? echo $row["goles_segundo_club"] ?></FONT></B></TD>
	<TD class="BackResultadosAds"><? echo $row["V"] ?></TD>
	<TD><IMG src="../img/right_resultados_ads.gif" width="3" height="30"></TD>
	<TD><IMG src="../img/pipe_resultados.gif" width="12" height="30" hspace="6"></TD>
	<TD><A HREF="javascript:abrirVentana('ficha_partido.php?id_partido=<? echo $row["id"] ?>','<? echo $row["id"] ?>',503,350);"><IMG src="../img/ver_ficha.gif" width="100" height="25" border="0"></A></TD>
</TR>
</TABLE>
<?
} 
?>

