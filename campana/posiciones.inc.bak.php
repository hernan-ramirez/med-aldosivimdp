<? require_once "../common/conexion.php"; ?>
<LINK HREF="../estilos.css" REL="stylesheet" TYPE="text/css">
<?
$id_torneo = 1;

$sql = "SELECT grupo FROM futbol_partidos 
WHERE id_torneo = $id_torneo 
GROUP BY grupo ORDER BY grupo";
$result_g = mysql_query($sql);
if(mysql_num_rows($result_g)!=0){
	while($row_g=mysql_fetch_array($result_g)){
?>
<table border="0" cellspacing="0" cellpadding="0" width="100%">
	<tr> 
	  <td class="EspecialesTitle"><B>Equipo</B></td>
	  <td align="center" class="EspecialesTitle"><B>PJ</B></td>
	  <td ALIGN="CENTER" class="EspecialesTitleY"><B>PG</B></td>
	  <td align="center" class="EspecialesTitleY"><B>PE</B></td>
	  <td align="center" class="EspecialesTitleY"><B>PP</B></td>
	  <td align="center" class="EspecialesTitleY"><B>GF</B></td>
	  <td ALIGN="CENTER" class="EspecialesTitleY"><B>GC</B></td>
	  <td ALIGN="CENTER" class="EspecialesTitle"><B>PTS</B></td>
	</tr>
<?
$sql = "
SELECT p.id_primer_club AS id , c.nombre 
FROM futbol_partidos p  
	LEFT JOIN futbol_clubes c ON(c.id = p.id_primer_club)
WHERE p.id_torneo = $id_torneo 
AND p.grupo = $row_g[0]
GROUP BY p.id_primer_club 
";
/****************
UNION
SELECT id_segundo_club AS id 
FROM futbol_partidos 
WHERE id_torneo = 1 
GROUP BY id_segundo_club 
**/
$result = mysql_query($sql);
if(mysql_num_rows($result)!=0){
	while($row=mysql_fetch_array($result)){
		$id_club = $row["id"];
		$nombre[$id_club] = $row["nombre"];
		
		$sql = "SELECT p.id, p.goles_primer_club, p.goles_segundo_club,
		p.id_primer_club, p.id_segundo_club 
		FROM futbol_partidos p 
		WHERE p.id_torneo = $id_torneo 
		AND (p.id_primer_club = $id_club 
		OR p.id_segundo_club = $id_club )";
		$result_part = mysql_query($sql);
		if(mysql_num_rows($result_part)!=0){
			$PJ[$id_club] = mysql_num_rows($result_part);
			while($row_part=mysql_fetch_array($result_part)){
				############
				 $L = $row_part["goles_primer_club"];
				 settype ( $L, "integer");
				 $V = $row_part["goles_segundo_club"];
				 settype ( $V, "integer");
				############
				# echo "·······Partido·······" . $row_part["id"] . "<BR>";
				# echo "local:" . $row_part["id_primer_club"] . "->" . $L . "<BR>";
				# echo "visitante:" . $row_part["id_segundo_club"] . "->" . $V . "<BR>";				
				############
				if($row_part["id_primer_club"]==$id_club){		
					$GF[$id_club] = $GF[$id_club] + $L;
					$GC[$id_club] = $GC[$id_club] + $V;					
					if($L > $V){
						$PG[$id_club] = $PG[$id_club] + 1;
						$PTS[$id_club] = $PTS[$id_club] + 3;
					}
					if($L < $V){
						$PP[$id_club] = $PP[$id_club] + 1;
					}	
				}elseif($row_part["id_segundo_club"]==$id_club){
					$GF[$id_club] = $GF[$id_club] + $V;
					$GC[$id_club] = $GC[$id_club] + $L;					
					if($L < $V){
						$PG[$id_club] = $PG[$id_club] + 1;
						$PTS[$id_club] = $PTS[$id_club] + 3;
					}
					if($L > $V){
						$PP[$id_club] = $PP[$id_club] + 1;
					}
				}
				if($L == $V){
					$PE[$id_club] = $PE[$id_club] + 1;
					$PTS[$id_club] = $PTS[$id_club] + 1;
				}
				############
				#echo "PG:" . $PG[$id_club] . " PE:" . $PE[$id_club] . " PP:" . $PP[$id_club] . " GF:" . $GF[$id_club] . " GC:" . $GC[$id_club] . " PTS: " . $PTS[$id_club] . "<BR>";
				############
			}
		}
		mysql_free_result($result_part);
	}
}
arsort($PTS);
do{
	$id_club = key($PTS);
	?>
	<tr> 
	  <td class="EspecialesGreen"><? echo $nombre[$id_club] ?>&nbsp;</td>
	  <td align="CENTER" class="EspecialesGreen"><? echo $PJ[$id_club] ?>&nbsp;</td>
	  <td align="CENTER" class="EspecialesYellow"><? echo $PG[$id_club] ?>&nbsp;</td>
	  <td align="CENTER" class="EspecialesYellow"><? echo $PE[$id_club] ?>&nbsp;</td>
	  <td align="CENTER" class="EspecialesYellow"><? echo $PP[$id_club] ?>&nbsp;</td>
	  <td align="CENTER" class="EspecialesYellow"><? echo $GF[$id_club] ?>&nbsp;</td>
	  <td align="CENTER" class="EspecialesYellow"><? echo $GC[$id_club] ?>&nbsp;</td>
	  <td align="CENTER" class="EspecialesGreen"><B><? echo $PTS[$id_club] ?></B>&nbsp;</td>
	</tr>
	<?
}while(next($PTS));
} # del while del grupo 
} # del if del grupo 
?>
</table>

