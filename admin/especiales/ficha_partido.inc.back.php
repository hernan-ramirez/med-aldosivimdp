<!------------------------ COMIENZA FICHA PARTIDO ------------------------->
<? include "abm_header.php"; ?><?
if(isset($id)){
	$id_partido = $id; 
}else{
	#ejemplo 96
	$id_partido = 3; 
}
switch($accion){
	case "Agregar Cambio":
		$sale = $sale_primer;
		if ($sale ==""){$sale = $sale_segundo;}
		$entra = $entra_primer;
		if ($entra ==""){$entra = $entra_segundo;}
		mysql_query("INSERT INTO `futbol_cambios` (`id_partido`, `id_sale_jugador`, `id_entra_jugador`, `minuto`) 
		VALUES ('$id_partido', '$sale', '$entra', '$cambio_minuto');");
	break;
	case "Borrar Cambio":
		mysql_query("DELETE FROM `futbol_cambios` WHERE id = $id_registro;");
	break;
	############################
	case "Agregar Goleador":
		if ($goleador_primer ==""){
			$goleador = $goleador_segundo;
		}else{
			$goleador = $goleador_primer;
		}
		if ($goleador_primer ==""){
			if ($ti´po_gol!="5"){
				mysql_query("UPDATE futbol_partidos SET goles_segundo_club = goles_segundo_club + 1 WHERE id = $id_partido;");
			}else{
				mysql_query("UPDATE futbol_partidos SET goles_primer_club = goles_primer_club + 1 WHERE id = $id_partido;");
			}
		}else{
			if ($ti´po_gol=="5"){
				mysql_query("UPDATE futbol_partidos SET goles_segundo_club = goles_segundo_club + 1 WHERE id = $id_partido;");
			}else{
				mysql_query("UPDATE futbol_partidos SET goles_primer_club = goles_primer_club + 1 WHERE id = $id_partido;");
			}
		}
		mysql_query("INSERT INTO `futbol_goleadores` (`id_partido`, `id_jugador`, `id_tipo_goles`, `minuto`) 
		VALUES ('$id_partido', '$goleador', '$tipo_gol', '$gol_minuto');");
		## Sumo el gol en el partido
	break;
	case "Borrar Goleador":
		mysql_query("DELETE FROM `futbol_goleadores` WHERE id = $id_registro;");
		if ($id_registro_club =="segundo"){
			mysql_query("UPDATE futbol_partidos SET goles_segundo_club = goles_segundo_club - 1 WHERE id = $id_partido;");
		}else{
			mysql_query("UPDATE futbol_partidos SET goles_primer_club = goles_primer_club - 1 WHERE id = $id_partido;");
		}
	break;
	############################
	case "Agregar Tarjeta":
		$tarjeta_jugador = $tarjeta_jugador_primer;
		if ($tarjeta_jugador ==""){$tarjeta_jugador = $tarjeta_jugador_segundo;}
		mysql_query("INSERT INTO `futbol_tarjetas` (`id_partido`, `id_jugador`, `tarjeta`, `minuto`) 
		VALUES ('$id_partido', '$tarjeta_jugador', '$tarjeta', '$tarjeta_minuto');");
	break;
	case "Borrar Tarjeta":
		mysql_query("DELETE FROM `futbol_tarjetas` WHERE id = $id_registro;");
	break;
	###########################
	case "Actualizar Formacion":
		for($orden=1;$orden<=22;$orden++){
			$result_forma = mysql_query("SELECT id FROM futbol_formacion WHERE `id_partido`=$id_partido AND `orden`=$orden");
			if(mysql_num_rows($result_forma)!=0){
				mysql_query("UPDATE `futbol_formacion` 
				SET `id_jugador`=$formacion[$orden] 
				WHERE `id_partido`=$id_partido AND `orden`=$orden");
			}else{
				$sql = "INSERT INTO futbol_formacion (id_partido, id_jugador, orden) 
				VALUES ($id_partido, $formacion[$orden], $orden)";
				mysql_query($sql);
			}
		}
	break;
}
$sql = "
SELECT p.*, DATE_FORMAT(p.fecha_partido,'%e/%c/%y') AS fecha, t.torneo, c.nombre AS primer_club, cc.nombre AS segundo_club
FROM futbol_partidos p 
	LEFT JOIN futbol_torneos t ON (t.id = p.id_torneo)
	LEFT JOIN futbol_clubes c ON (c.id = p.id_primer_club)
	LEFT JOIN futbol_clubes cc ON (cc.id = id_segundo_club)
WHERE 
p.id = $id_partido
";
$result = mysql_query($sql);
if(mysql_num_rows($result)!=0){
	$row = mysql_fetch_array($result);
	
	function desplegar_jugadores($nombre, $id_torneo, $id_club){
		########################## ARMO MATRIZ DE JUGADORES DEL PLANTEL DEL EQUIPO
		$sql = "
		SELECT j.nombre, j.apellido, j.numero, j.id
		FROM futbol_planteles p
			LEFT JOIN futbol_jugadores j ON (j.id = p.id_jugador)
		WHERE id_torneo = $id_torneo 
		AND id_clubes = $id_club
		ORDER BY id_clubes
		";
		#echo $sql;
		$result_jugadores = mysql_query($sql);
		##########################
		?><SELECT name="<? echo $nombre ?>"><OPTION value="">&nbsp;</OPTION>
		<? if(mysql_num_rows($result_jugadores)!=0){
		while ($row_jugadores = mysql_fetch_array($result_jugadores)){ 
			?><OPTION value="<? echo $row_jugadores["id"] ?>"><? echo $row_jugadores["numero"] ?>)&nbsp;<? echo $row_jugadores["apellido"] ?>&nbsp;<? echo $row_jugadores["nombre"] ?></OPTION>
		<? } } ?>
	  	</SELECT><?
	}
	
	
?>
<BODY leftmargin="0" topmargin="0" marginwidth="0" marginheight="0"> 
<TABLE width="100%" height="50" cellpadding="0" cellspacing="0">
  <TR>
    <TD height="41" align="center" bgcolor="#E6EEEE"><STRONG>DETALLE DEL PARTIDO<BR>
      MINUTO A MINUTO</STRONG></TD>
  </TR>
</TABLE>
<form name="partido" action="" method="post">
  <INPUT name="id_registro" type="hidden" id="id_registro">
  <INPUT name="id_registro_club" type="hidden" id="id_registro_club">
  <TABLE>
  <TR bgcolor="#D7E3DB"> 
	<TD colspan="2"><STRONG>Datos del Partido: </STRONG></TD>
  </TR>
  <TR> 
	<TD align="right"><FONT color="#FF0000">Torneo</FONT></TD>
	<TD><? echo $row["torneo"] ?></TD>
  </TR>
  <TR> 
	<TD align="right"><FONT color="#FF0000">Numero</FONT></TD>
	<TD><? echo $row["numero_partido"] ?></TD>
  </TR>
  <TR> 
	<TD align="right"><FONT color="#FF0000">Juegan</FONT></TD>
	<TD><? echo $row["primer_club"] ?>: <? echo $row["goles_primer_club"] ?><BR>
	<? echo $row["segundo_club"] ?>:  <? echo $row["goles_segundo_club"] ?></TD>
  </TR>
  <TR> 
	<TD align="right"><FONT color="#FF0000">Fecha</FONT></TD>
	<TD><? echo $row["fecha"] ?></TD>
  </TR>
  <TR> 
	<TD align="right"><FONT color="#FF0000">Estadio</FONT></TD>
	<TD><? echo $row["estadio"] ?></TD>
  </TR>
  <TR> 
	<TD align="right"><FONT color="#FF0000">Arbitro </FONT></TD>
	<TD><? echo $row["arbitro"] ?></TD>
  </TR>
  <TR> 
	<TD align="right"><FONT color="#FF0000">Lineas</FONT></TD>
	<TD><? echo $row["lineas"] ?></TD>
  </TR>
</TABLE>
<BR>
  <TABLE align="center">
	<TR bgcolor="#D7E3DB"> 
	  <TD colspan="2"><STRONG>Formaciones</STRONG></TD>
	</TR>
	<TR align="center"> 
	  <TD><FONT color="#FF0000"><? echo $row["primer_club"] ?></FONT></TD>
	  <TD><FONT color="#FF0000"><? echo $row["segundo_club"] ?></FONT></TD>
	</TR>
	<? 
	$result_forma = mysql_query("SELECT * FROM futbol_formacion WHERE `id_partido`=$id_partido");
	if(mysql_num_rows($result_forma)!=0){
		while($row_forma = mysql_fetch_array($result_forma)){
			$i = $row_forma["orden"];
			$formacion_jug[$i] = $row_forma["id_jugador"];
		}
	}
	
	for($orden=1;$orden<=22;$orden++){ ?>
	<TR align="center"> 
	  <TD><? desplegar_jugadores("formacion[".$orden."]", $row["id_torneo"], $row["id_primer_club"]) ?></TD>
		<? $orden++ ?>
	  <TD><? desplegar_jugadores("formacion[".$orden."]", $row["id_torneo"], $row["id_segundo_club"]) ?></TD>
	</TR>
	<? } ?>
	<TR> 
	  <TD colspan="2" align="center"><INPUT name="accion" type="submit" id="accion" value="Actualizar Formacion"></TD>
	</TR>
  </TABLE>
<BR>
  <TABLE width="90%" align="center">
	<TR bgcolor="#D7E3DB"> 
	  <TD colspan="3"><STRONG>Cambios</STRONG></TD>
	</TR>
	<TR> 
	  <TD><FONT color="#FF0000">Sale</FONT></TD>
	  <TD><FONT color="#FF0000">Entra</FONT></TD>
	  <TD align="center"><FONT color="#FF0000">Minuto</FONT></TD>
	</TR>
	<? $resultado = mysql_query("SELECT c.id, c.minuto, j.apellido AS sale_apellido, j.nombre AS sale_nombre, 
			ju.apellido AS entra_apellido, ju.nombre AS entra_nombre, 
			j.numero AS sale_numero, ju.numero AS entra_numero FROM futbol_cambios c
		LEFT JOIN futbol_jugadores j ON (j.id = c.id_sale_jugador)
		LEFT JOIN futbol_jugadores ju ON (ju.id = c.id_entra_jugador)
	WHERE id_partido = $id_partido
	ORDER BY c.minuto");
	if(mysql_num_rows($resultado)!=0){ 
		while($fila = mysql_fetch_array($resultado)){ ?>	
	<TR> 
	  <TD><? echo $fila["sale_numero"] . ") " . $fila["sale_apellido"] . " " . $fila["sale_nombre"] ?></TD>
	  <TD><? echo $fila["entra_numero"] . ") " . $fila["entra_apellido"] . " " . $fila["entra_nombre"] ?></TD>
	  <TD align="center"><? echo $fila["minuto"] ?></TD>
	  <TD><INPUT name="accion" type="submit" id="accion" value="Borrar Cambio" onClick="javascript:document.all.id_registro.value=<? echo $fila["id"]?>"></TD>
	</TR>
	<? } } ?>
	<TR> 
	  <TD> 
		<? desplegar_jugadores("sale_primer", $row["id_torneo"], $row["id_primer_club"]) ?><BR>
		<? desplegar_jugadores("sale_segundo", $row["id_torneo"], $row["id_segundo_club"]) ?>
	  </TD>
	  <TD> 
		<? desplegar_jugadores("entra_primer", $row["id_torneo"], $row["id_primer_club"]) ?><BR>
		<? desplegar_jugadores("entra_segundo", $row["id_torneo"], $row["id_segundo_club"]) ?>
	  </TD>
	  <TD align="center"><INPUT name="cambio_minuto" type="text" id="cambio_minuto" size="6" maxlength="3">
	  </TD>
	</TR>
	<TR> 
	  <TD colspan="3" align="right"><INPUT name="accion" type="submit" id="accion" value="Agregar Cambio"></TD>
	</TR>
  </TABLE>
<BR>
  <TABLE width="90%" align="center">
	<TR bgcolor="#D7E3DB"> 
	  <TD colspan="3"><STRONG>Goleadores</STRONG></TD>
	</TR>
	<TR> 
	  <TD><FONT color="#FF0000">Jugador </FONT></TD>
	  <TD><FONT color="#FF0000">Tipo</FONT></TD>
	  <TD align="center"><FONT color="#FF0000">Minuto</FONT></TD>
	</TR>
	<? $resultado = mysql_query("SELECT g.id, g.minuto, j.apellido, j.nombre, 
			j.numero, t.tipo,t.id AS id_tipo, p.id_clubes
			FROM futbol_goleadores g
		LEFT JOIN futbol_jugadores j ON (j.id = g.id_jugador)
		LEFT JOIN futbol_tipo_goles t ON (t.id = g.id_tipo_goles)
		LEFT JOIN futbol_planteles p ON (p.id = g.id_jugador)
	WHERE id_partido = $id_partido 
	ORDER BY g.minuto");
	if(mysql_num_rows($resultado)!=0){ 
		while($fila = mysql_fetch_array($resultado)){ ?>	
	<TR> 
	  <TD><? echo $fila["numero"] . ") " . $fila["apellido"] . " " . $fila["nombre"] ?></TD>
	  <TD><? echo $fila["tipo"] ?></TD>
	  <TD align="center"><? echo $fila["minuto"] ?></TD>
	  <TD><INPUT name="accion" type="submit" id="accion" value="Borrar Goleador" onClick="javascript:document.all.id_registro.value=<? echo $fila["id"]?>;document.all.id_registro_club.value='<?
	if( $fila["id_tipo"] != "5"){
		if( $fila["id_clubes"] == $row["id_primer_club"] ){echo "primer";}else{echo "segundo";} 
	}else{
		if( $fila["id_clubes"] != $row["id_primer_club"] ){echo "primer";}else{echo "segundo";} 	
	}
		?>'">
		</TD>
	</TR>
	<TR>
	<? } } ?> 
	  <TD> 
		<? desplegar_jugadores("goleador_primer", $row["id_torneo"], $row["id_primer_club"]) ?><BR>
		<? desplegar_jugadores("goleador_segundo", $row["id_torneo"], $row["id_segundo_club"]) ?>
	  </TD>
	  <TD><SELECT name="tipo_gol" id="tipo_gol">
		  <? $result_goles = mysql_query("SELECT * FROM futbol_tipo_goles");
	  while ($row_goles = mysql_fetch_array($result_goles)) {?>
		  <OPTION value="<? echo $row_goles["id"] ?>"><? echo $row_goles["tipo"] ?></OPTION>
		  <? } ?>
		</SELECT></TD>
	  <TD align="center"><INPUT name="gol_minuto" type="text" id="gol_minuto" size="6" maxlength="3">
	  </TD>
	</TR>
	<TR> 
	  <TD colspan="3" align="right"><INPUT name="accion" type="submit" id="accion" value="Agregar Goleador"></TD>
	</TR>
  </TABLE>
<BR>
  <TABLE width="90%" align="center">
	<TR bgcolor="#D7E3DB"> 
	  <TD colspan="3"><STRONG>Tarjetas</STRONG></TD>
	</TR>
	<TR> 
	  <TD><FONT color="#FF0000">Jugador</FONT></TD>
	  <TD><FONT color="#FF0000">Tarjeta</FONT></TD>
	  <TD align="center"><FONT color="#FF0000">Minuto</FONT></TD>
	</TR>
	<? $resultado = mysql_query("SELECT t.id, t.minuto, j.apellido, j.nombre, 
			j.numero, t.tarjeta
			FROM futbol_tarjetas t
		LEFT JOIN futbol_jugadores j ON (j.id = t.id_jugador)
	WHERE id_partido = $id_partido 
	ORDER BY t.minuto");
	if(mysql_num_rows($resultado)!=0){ 
		while($fila = mysql_fetch_array($resultado)){ ?>	
	<TR> 
	  <TD><? echo $fila["numero"] . ") " . $fila["apellido"] . " " . $fila["nombre"] ?></TD>
	  <TD><? if($fila["tarjeta"]==1){ echo "Roja";}else{ echo "Amarilla";} ?></TD>
	  <TD align="center"><? echo $fila["minuto"] ?></TD>
	  <TD><INPUT name="accion" type="submit" id="accion" value="Borrar Tarjeta" onClick="javascript:document.all.id_registro.value=<? echo $fila["id"]?>"></TD>
	</TR>
	<? } } ?>
	<TR> 
	  <TD> 
		<? desplegar_jugadores("tarjeta_jugador_primer", $row["id_torneo"], $row["id_primer_club"]) ?><BR>
		<? desplegar_jugadores("tarjeta_jugador_segundo", $row["id_torneo"], $row["id_segundo_club"]) ?>
	  </TD>
	  <TD><SELECT name="tarjeta" id="tarjeta">
		  <OPTION value="0">Amarilla</OPTION>
		  <OPTION value="1">Roja</OPTION>
		</SELECT></TD>
	  <TD align="center"><INPUT name="tarjeta_minuto" type="text" id="tarjeta_minuto" size="6" maxlength="3">
	  </TD>
	</TR>
	<TR> 
	  <TD colspan="3" align="right"><INPUT name="accion" type="submit" id="accion" value="Agregar Tarjeta"></TD>
	</TR>
  </TABLE>
</form>
<?
}
?>
<!------------------------ FIN FICHA PARTIDO ------------------------->

