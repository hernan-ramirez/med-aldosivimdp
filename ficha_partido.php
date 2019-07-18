<? require_once "common/conexion.php"; ?>
<? 
$sql = "
SELECT p.*, DATE_FORMAT(p.fecha_partido,'%e/%c/%y') AS fecha, t.torneo, c.nombre AS primer_club, cc.nombre AS segundo_club, c.id AS id_primer_club, cc.id AS id_segundo_club 
FROM futbol_partidos p 
	LEFT JOIN futbol_torneos t ON (t.id = p.id_torneo)
	LEFT JOIN futbol_clubes c ON (c.id = p.id_primer_club)
	LEFT JOIN futbol_clubes cc ON (cc.id = id_segundo_club)
WHERE 
p.id = $id_partido
";
function sacarResultado($idClub, $idClubDos){
	global $id_partido;
	$sql = "SELECT COUNT(1) FROM futbol_goleadores g
		LEFT JOIN futbol_planteles p ON(p.id_jugador = g.id_jugador)
	WHERE id_partido = $id_partido AND (
	(p.id_clubes = $idClub AND id_tipo_goles <> 5)
	OR (p.id_clubes = $idClubDos AND id_tipo_goles = 5)
	)";
	$result = mysql_query($sql);
	if(mysql_num_rows($result)!=0){
		$row = mysql_fetch_array($result);
		return $row[0];
	}
}
$result = mysql_query($sql);
if(mysql_num_rows($result)!=0){
	$row = mysql_fetch_array($result);	
?>
<link href="estilos.css" rel="stylesheet" type="text/css">
<BODY bgcolor="EAEAEA" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<script>
// (C) 2000 www.CodeLifter.com
// http://www.codelifter.com
// Free for all users, but leave in this  header
function printWindow(){
   bV = parseInt(navigator.appVersion)
   if (bV >= 4) window.print()
}
</script>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td class="PopHeader"><img src="img/spacer.gif" width="1" height="11"></td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td width="158"><img src="img/caa_pop.gif" alt="Club Atl&eacute;tico Aldosivi" width="158" height="22"></td>
    <td width="100%" class="PopDashed">&nbsp;</td>
    <td width="72"><a href="javascript:printWindow()"><img src="img/imprimir.gif" width="72" height="22" border="0"></a></td>
    <td width="7" class="PopDashed"><img src="img/spacer.gif" width="7" height="1"></td>
  </tr>
</table>
<table border="0" cellspacing="0" cellpadding="0">
  <tr bgcolor="EAEAEA"> 
    <td width="5"><img src="img/spacer.gif" width="5" height="5"></td>
    <td width="4"><img src="img/spacer.gif" width="4" height="5"></td>
    <td width="468"><img src="img/spacer.gif" width="1" height="5"></td>
    <td width="4"><img src="img/spacer.gif" width="4" height="5"></td>
    <td width="5"><img src="img/spacer.gif" width="5" height="5"></td>
  </tr>
  <tr> 
    <td bgcolor="EAEAEA"><img src="img/spacer.gif" width="1" height="1"></td>
    <td><img src="img/corner_pop_izq.gif" width="4" height="4"></td>
    <td bgcolor="#FFFFFF"><img src="img/spacer.gif" width="1" height="1"></td>
    <td><img src="img/corner_pop_der.gif" width="4" height="4"></td>
    <td bgcolor="EAEAEA"><img src="img/spacer.gif" width="1" height="1"></td>
  </tr>
  <tr> 
    <td bgcolor="EAEAEA">&nbsp;</td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="#FFFFFF"><TABLE width="460" border="0" cellpadding="0" cellspacing="0">
        <TR bgcolor="#D7E3DB"> 
          <TD colspan="2" class="EspecialesTitle"><STRONG>Datos del Partido: </STRONG></TD>
        </TR>
        <TR> 
          <TD width="70" align="right" class="EspecialesGreen">Torneo</TD>
          <TD class="EspecialesGreen"><? echo $row["torneo"] ?>&nbsp;</TD>
        </TR>
        <TR> 
          <TD align="right" class="EspecialesGreen">Número</TD>
          <TD class="EspecialesGreen"><? echo $row["numero_partido"] ?>&nbsp;</TD>
        </TR>
        <TR> 
          <TD align="right" class="EspecialesGreen">Juegan</TD>
          <TD class="EspecialesGreen"><? echo $row["primer_club"] ?> contra <? echo $row["segundo_club"] ?></TD>
        </TR>
        <TR> 
          <TD align="right" class="EspecialesGreen">Fecha</TD>
          <TD class="EspecialesGreen"><? echo $row["fecha"] ?>&nbsp;</TD>
        </TR>
        <TR> 
          <TD align="right" class="EspecialesGreen">Estadio</TD>
          <TD class="EspecialesGreen"><? echo $row["estadio"] ?>&nbsp;</TD>
        </TR>
        <TR> 
          <TD align="right" class="EspecialesGreen">Arbitro </TD>
          <TD class="EspecialesGreen"><? echo $row["arbitro"] ?>&nbsp;</TD>
        </TR>
        <TR> 
          <TD align="right" class="EspecialesGreen">Líneas</TD>
          <TD class="EspecialesGreen"><? echo $row["lineas"] ?>&nbsp;</TD>
        </TR>
        <TR> 
          <TD align="right" class="EspecialesGreen">Resultado</TD>
          <TD class="EspecialesGreen"><b><? echo sacarResultado($row["id_primer_club"], $row["id_segundo_club"]) . 
		" - " . sacarResultado($row["id_segundo_club"], $row["id_primer_club"]) ?>&nbsp;</b></TD>
        </TR>
      </TABLE>
      <TABLE width="460" border="0" cellpadding="0" cellspacing="0">
        <TR bgcolor="#D7E3DB"> 
          <TD colspan="3" class="EspecialesGray"><STRONG>Cambios</STRONG></TD>
        </TR>
        <TR> 
          <TD width="40%" class="EspecialesYellow"><strong>Sale</strong></TD>
          <TD width="40%" class="EspecialesGreen"><strong>Entra</strong></TD>
          <TD width="20%" align="center" class="EspecialesGray">Minuto</TD>
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
          <TD class="EspecialesYellow"><? echo $fila["sale_numero"] . ") " . $fila["sale_apellido"] . " " . $fila["sale_nombre"] ?>&nbsp;</TD>
          <TD class="EspecialesGreen"><? echo $fila["entra_numero"] . ") " . $fila["entra_apellido"] . " " . $fila["entra_nombre"] ?>&nbsp;</TD>
          <TD align="center" class="EspecialesGray"><? echo $fila["minuto"] ?>&nbsp;</TD>
        </TR>
        <? } } ?>
      </TABLE> 
      <TABLE width="460" border="0" cellpadding="0" cellspacing="0">
        <TR bgcolor="#D7E3DB"> 
          <TD colspan="2" class="EspecialesGray"><STRONG>Formaciones</STRONG></TD>
        </TR>
        <TR align="center"> 
          <TD width="50%" class="EspecialesYellow"><b><? echo $row["primer_club"] ?>&nbsp;</b></TD>
          <TD width="50%" class="EspecialesGray"><b><? echo $row["segundo_club"] ?>&nbsp;</b></TD>
        </TR>
        <? 
	$result_forma = mysql_query("SELECT * FROM futbol_formacion f
		LEFT JOIN futbol_jugadores j ON(j.id = f.id_jugador)
	WHERE `id_partido`=$id_partido");
	if(mysql_num_rows($result_forma)!=0){
		while($row_forma = mysql_fetch_array($result_forma)){
			$i = $row_forma["orden"];
			$formacion_jug[$i] = $row_forma["numero"].") ".$row_forma["apellido"]." ".$row_forma["nombre"];
		}
	}
	
	for($orden=1;$orden<=22;$orden++){ ?>
        <TR align="center"> 
          <TD class="EspecialesYellow"><? echo $formacion_jug[$orden] ?>&nbsp;</TD>
          <? $orden++ ?>
          <TD class="EspecialesGray"><? echo $formacion_jug[$orden] ?>&nbsp;</TD>
        </TR>
        <? } ?>
      </TABLE>
      <TABLE width="460" border="0" cellpadding="0" cellspacing="0">
        <TR bgcolor="#D7E3DB"> 
          <TD colspan="3" class="EspecialesGray"><STRONG>Goleadores</STRONG></TD>
        </TR>
        <TR> 
          <TD width="40%" class="EspecialesYellow"><strong>Jugador </strong></TD>
          <TD width="40%" class="EspecialesGreen"><strong>Tipo</strong></TD>
          <TD align="center" class="EspecialesGray">Minuto</TD>
        </TR>
        <? $resultado = mysql_query("SELECT g.id, g.minuto, j.apellido, j.nombre, 
			j.numero, t.tipo
			FROM futbol_goleadores g
		LEFT JOIN futbol_jugadores j ON (j.id = g.id_jugador)
		LEFT JOIN futbol_tipo_goles t ON (t.id = g.id_tipo_goles)
	WHERE id_partido = $id_partido 
	ORDER BY g.minuto");
	if(mysql_num_rows($resultado)!=0){ 
		while($fila = mysql_fetch_array($resultado)){ ?>
        <TR> 
          <TD class="EspecialesYellow"><? echo $fila["numero"] . ") " . $fila["apellido"] . " " . $fila["nombre"] ?>&nbsp;</TD>
          <TD class="EspecialesGreen"><? echo $fila["tipo"] ?>&nbsp;</TD>
          <TD align="center" class="EspecialesGray"><? echo $fila["minuto"] ?>&nbsp;</TD>
        </TR>
        <TR> 
          <? } } ?>
      </TABLE>
      <TABLE width="460" border="0" cellpadding="0" cellspacing="0">
        <TR bgcolor="#D7E3DB"> 
          <TD colspan="3" class="EspecialesGray"><STRONG>Tarjetas</STRONG></TD>
        </TR>
        <TR> 
          <TD width="40%" class="EspecialesYellow"><strong>Jugador</strong></TD>
          <TD width="40%" class="EspecialesGreen"><strong>Tarjeta</strong></TD>
          <TD width="20%" align="center" class="EspecialesGray">Minuto</TD>
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
          <TD class="EspecialesYellow"><? echo $fila["numero"] . ") " . $fila["apellido"] . " " . $fila["nombre"] ?>&nbsp;</TD>
          <TD class="EspecialesGreen"> 
			<? if($fila["tarjeta"]==1){ echo "Roja";}else{ echo "Amarilla";} ?>
			&nbsp; </TD>
          <TD align="center" class="EspecialesGray"><? echo $fila["minuto"] ?>&nbsp;</TD>
        </TR>
        <? } } ?>
      </TABLE>
    </td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="EAEAEA">&nbsp;</td>
  </tr>
  
</table>
<?
}
?>

