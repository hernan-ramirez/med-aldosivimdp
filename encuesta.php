<!-- Inicio Encuesta -->
<?
if (isset($voto_encuesta)){
	$sql = "UPDATE encuestas_respuestas 
	SET votos = votos + 1 
	WHERE id = " . $voto_encuesta;
	mysql_query($sql);
}
$sql = "SELECT pu.posicion , pr.id, pr.pregunta
		FROM publicaciones pu
		LEFT JOIN encuestas_preguntas pr ON(pr.id = pu.id_publicado ) 
		WHERE pu.id_lista_tablas = 14 /* tabla de encuestas */
		AND pu.id_estructura = 1 
"; ########### poner la pregunta publicada
#echo $sql;
$result = mysql_query($sql,$conexion);
if (mysql_num_rows($result)!=0) { ### if UNO
?> 
<table width="259" border="0" cellspacing="0" cellpadding="0">
	<form name="encuestas" action="" method="post">
  <tr> 
    <td><img src="img/ttl_encuesta.gif" alt="Encuesta" width="145" height="19"></td>
    <td><img src="img/ttl_resultados.gif" alt="Resultados" width="114" height="19"></td>
  </tr>
  <?
while($row = mysql_fetch_array($result)){ ### while UNO
	$id_pregunta = $row["id"] ;
			############### tomo votos
			$total_votos = 0;
			$result = mysql_query("SELECT er.votos, ep.pregunta FROM encuestas_respuestas er
									LEFT JOIN encuestas_preguntas ep ON (er.id_preguntas = ep.id)
									WHERE er.id_preguntas =  " . $id_pregunta);
			if (mysql_num_rows($result)!=0){
				while ($row1 = mysql_fetch_array($result)){
					$total_votos = $total_votos + $row1[0];
				}
			}
			###################
	?> 
  <tr> 
    <td class="Encuesta"><? echo $row["pregunta"] ?></td>
    <td class="Resultados"><img src="img/percent.gif" width="100" height="19" hspace="5" vspace="8"></td>
  </tr>
  <tr> 
    <td class="Encuesta"><img src="img/spacer.gif" width="1" height="6"></td>
    <td class="Resultados"><img src="img/spacer.gif" width="1" height="6"></td>
  </tr>
	<? 
	$sql = "SELECT * FROM encuestas_respuestas WHERE id_preguntas = $id_pregunta";
	#echo $sql;
	$result_respuestas = mysql_query($sql,$conexion);
	if (mysql_num_rows($result_respuestas)!=0){ ### if DOS
	while ($row_resp = mysql_fetch_array($result_respuestas)){ ### while DOS
	?>
  <tr> 
    <td class="Encuesta"><input type="radio" name="voto_encuesta" value="<? echo $row_resp["id"] ?>">
      <? echo $row_resp["respuesta"] ?></td>
	  <?
	############ calculo porcentajes
	  if ($total_votos!=0){
		$ancho = 100 * $row_resp["votos"] / $total_votos;	  	
	  }else{
		$ancho = 1;
	  }	
	  #######################
	  ?>       
    <td class="ResultadosBar">
	<img src="img/resultados_bar.gif" width="5" height="18" hspace="0" vspace="0" border="0" align="left">
	<img src="img/resultados_bar.gif" width="<? echo round($ancho) ?>" height="18" hspace="0" vspace="0" border="0" align="left">
	</td>
  </tr>
<? 
	} ### del while DOS
} ### del if DOS
?>
  <tr> 
    <td class="Encuesta"><img src="img/spacer.gif" width="1" height="6"></td>
    <td class="Resultados"><img src="img/spacer.gif" width="1" height="6"></td>
  </tr>
  <tr> 
    <td style="cursor:hand"><img src="img/votar.gif" width="145" height="15" onClick="javascript:document.encuestas.submit();"></td>
    <!---una vez q boto sacar los cheqs y poner la imagen ya_voto.gif--->
    <td class="Resultados">&nbsp;</td>
  </tr>
  <tr> 
    <td class="EncuestaEnd"><img src="img/spacer.gif" width="1" height="5"></td>
    <td class="ResultadosEnd"><img src="img/spacer.gif" width="1" height="5"></td>
  </tr>
  <tr> 
    <td><img src="img/spacer.gif" width="1" height="2"></td>
    <td><img src="img/spacer.gif" width="1" height="2"></td>
  </tr>
<? } # del while UNO ?>
</form>
</table>
<? } # del if UNO ?>
<!-- Fin Encuesta -->

