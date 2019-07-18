<!--Inicio Header -->
<table width="751" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td width="634" class="BackFirstTable"><img src="../img/esc_top.gif" width="86" height="42" hspace="23"></td>
    <td width="117" class="BackFirstTable"><img src="../img/end_ftable.gif" width="117" height="42"></td>
  </tr>
</table>
<table width="751" border="0" cellpadding="0" cellspacing="0">
  <tr class="BackScnTable"> 
    <td width="145"><img src="../img/esc_mid.gif" width="145" height="16"></td>
    <td class="BackScnTable"><img src="../img/h_ultima_fecha.gif" alt="Ultima Fecha" width="69" height="14"></td>
    <td width="20" class="BackScnTable"><img src="../img/mid_fline.gif" width="2" height="16" hspace="9"></td>
    <td width="100%" class="BackScnTable"><img src="../img/h_proxima_fecha.gif" alt="Próxima Fecha" width="87" height="16"></td>
    <td width="117"><img src="../img/sitio_oficial.gif" alt="Sitio Oficial del Club Atlético Aldosivi" width="117" height="16"></td>
  </tr>
  <tr class="BackThrdTable">
    <td width="145"><img src="../img/esc_mid_d.gif" width="145" height="20"></td>
	<?
	$sql = "
	SELECT  c1.nombre AS L, p.goles_primer_club, p.goles_segundo_club, c2.nombre AS V 
	FROM futbol_partidos p
		LEFT JOIN futbol_clubes c1 ON(c1.id = p.id_primer_club)
		LEFT JOIN futbol_clubes c2 ON(c2.id = p.id_segundo_club)
	WHERE fecha_partido < now()
	ORDER BY fecha_partido DESC 
	LIMIT 1
	";
	$result = mysql_query($sql);
	if(mysql_num_rows($result)!=0){
		$row = mysql_fetch_array($result);
		?>
		<td nowrap><? echo $row["L"] . " " . $row["goles_primer_club"] . " - " . $row["goles_segundo_club"] . " " . $row["V"]  ?></td>
		<? 
	}
	?>
    <td valign="top"><img src="../img/mid_fline_d.gif" width="2" height="18" hspace="9"></td>
	<?
	$sql = "
	SELECT  c1.nombre AS L,  c2.nombre AS V, DATE_FORMAT(p.fecha_partido, '%e/%c/%y') AS fecha 
	FROM futbol_partidos p
		LEFT JOIN futbol_clubes c1 ON(c1.id = p.id_primer_club)
		LEFT JOIN futbol_clubes c2 ON(c2.id = p.id_segundo_club)
	WHERE fecha_partido > now()
	ORDER BY fecha_partido ASC 
	LIMIT 1
	";
	$result = mysql_query($sql);
	if(mysql_num_rows($result)!=0){
		$row = mysql_fetch_array($result);
		?>
    	
    <td><? echo $row["L"] . " - " . $row["V"] . " [" . $row["fecha"] . "]" ?></td>
		<? 
	}
	?>
    <td width="117" align="right"><img src="../img/sitio_oficial_d.gif" width="117" height="20"></td>
  </tr>
</table>
<table width="751" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td width="145"><img src="../img/esc_btm.gif" width="145" height="22"></td>
    <td width="21"><img src="../img/fantasy_1.gif" width="21" height="22"></td>
    <td><a href="../index.php"><img src="../img/home.gif" alt="Inicio" width="49" height="22" border="0"></a></td>
    <td><a href="javascript:abrirVentana('../institucion.php','INST',503,350);"><img src="../img/institucion.gif" alt="Institución" width="82" height="22" border="0"></a></td>
    <td><a href="../plantel/index.php"><img src="../img/equipo.gif" alt="Equipo" width="53" height="22" border="0"></a></td>
    <td><img src="../img/campana.gif" alt="Campa&ntilde;a" width="66" height="22" border="0"></td>
    <td><a href="../comunidad.php"><img src="../img/comunidad.gif" alt="Comunidad" width="75" height="22" border="0"></a></td>
    <td><a href="http://www.sportsya.com" target="_blank"><img src="../img/noti_sya.gif" alt="Noticias en SportsYa" width="143" height="22" border="0"></a></td>
    <td><img src="../img/fantasy_2.gif" width="117" height="22"></td>
  </tr>
</table>
<table width="751" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td width="170" class="BackFrthLine"><img src="../img/caa.gif" width="170" height="22"></td>
    <td width="595" class="BackFrthLine"><img src="../img/btm_menu_h.gif" width="45" height="22"></td>
    <td width="6" align="right" class="BackFrthLine"><img src="../img/btm_menu_h_btm.gif" width="6" height="22"></td>
  </tr>
</table>
<!--Fin Header -->

