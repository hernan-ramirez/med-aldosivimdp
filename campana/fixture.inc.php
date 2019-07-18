<table border="0" cellspacing="0" cellpadding="0" width="100%">
	<tr> 
		<td colspan="5" class="EspecialesTitleY"><b>Fixture</b></td>
	</tr>
	<tr ALIGN="CENTER"> 
		<td width="5%" class="EspecialesTitle" nowrap><B>Grupo</B></td>				
		<TD WIDTH="10%" class="EspecialesTitle"><B>Fecha</B></TD>
		<TD WIDTH="30%" class="EspecialesTitle"><B>Local</B></TD>
		<td WIDTH="10%" class="EspecialesTitle"><B>Resultado</B></td>
		<td width="30%" class="EspecialesTitle"><B>Visitante</B></td>
	</tr>
		<?
		$sql = "
		SELECT c.alias as equipo1, cc.alias as equipo2, p.*
		FROM futbol_partidos p
		LEFT JOIN futbol_clubes c ON (p.id_primer_club = c.id)
		LEFT JOIN futbol_clubes cc ON (p.id_segundo_club = cc.id)
		WHERE numero_fecha = $num_fecha
		AND p.id_torneo = 3
		ORDER by grupo
		";
		
		
		#SELECT c.alias as equipo1, cc.alias as equipo2, p.*
		#FROM futbol_partidos p
		#LEFT JOIN futbol_clubes c ON (p.id_primer_club = c.id)
		#LEFT JOIN futbol_clubes cc ON (p.id_segundo_club = cc.id)
		#WHERE numero_fecha = 3
		#AND p.id_torneo = 2
		#ORDER by grupo		
		
		
		#echo $sql;
		$result = mysql_query ($sql);
		if(mysql_num_rows($result)!=0){
			while ($row = mysql_fetch_array($result)){
		?>
	<tr ALIGN="CENTER" <? if ($row["equipo1"] == "Aldosivi" OR $row["equipo2"] == "Aldosivi") { echo "onClick=\"javascript:abrirVentana('ficha_partido.php?id_partido=" . $row["id"] . "','" .  $row["id"] . "',503,350);\" title=\"Ver Ficha del Partido\" style=cursor:hand" ; } ?>>
		<TD class="<? if ($row["equipo1"] == "Aldosivi" OR $row["equipo2"] == "Aldosivi") { echo "EspecialesYellow"; } else { echo "EspecialesGreen"; } ?>" nowrap	><? echo $row["grupo"] ?></TD>
		<TD class="<? if ($row["equipo1"] == "Aldosivi" OR $row["equipo2"] == "Aldosivi") { echo "EspecialesYellow"; } else { echo "EspecialesGreen"; } ?>" nowrap	><? echo $row["fecha_partido"] ?></TD>
		<TD class="<? if ($row["equipo1"] == "Aldosivi" OR $row["equipo2"] == "Aldosivi") { echo "EspecialesYellow"; } else { echo "EspecialesGreen"; } ?>"><? echo $row["equipo1"] ?></TD>
		<td class="<? if ($row["equipo1"] == "Aldosivi" OR $row["equipo2"] == "Aldosivi") { echo "EspecialesYellow"; } else { echo "EspecialesGreen"; } ?>"><? echo $row["goles_primer_club"] ?>&nbsp;-&nbsp;<? echo $row["goles_segundo_club"] ?></td>
		<td class="<? if ($row["equipo1"] == "Aldosivi" OR $row["equipo2"] == "Aldosivi") { echo "EspecialesYellow"; } else { echo "EspecialesGreen"; } ?>"><? echo $row["equipo2"] ?></td>
	</tr>
	<?
	} 
		}
	?>
</table>

