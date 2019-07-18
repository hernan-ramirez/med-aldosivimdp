<? $path = "../" ?>
<? include "../common/conexion.php"; ?>
<? include "../inicio.php" ?>
<? include "../header.php"; ?>

<script language="JavaScript" type="text/JavaScript">
<!--
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
//-->
</script>

<? 
if(!isset($num_fecha)){ #A
$sql = "
SELECT numero_fecha
FROM futbol_partidos 
WHERE fecha_partido > DATE_SUB(now(), INTERVAL 2 DAY) 
AND numero_fecha<>0
ORDER BY fecha_partido ASC 
LIMIT 1
";
$res = mysql_query($sql);
	if(mysql_num_rows($res)!=0){ #B
		$r = mysql_fetch_array($res);
		$num_fecha = $r["numero_fecha"];
	}else{ #B
		$sql = "
		SELECT numero_fecha
		FROM futbol_partidos 
		WHERE fecha_partido < now() 
		AND numero_fecha<>0
		ORDER BY fecha_partido DESC 
		LIMIT 1
		";
		$res = mysql_query($sql);
		if(mysql_num_rows($res)!=0){
			$r = mysql_fetch_array($res);
			$num_fecha = $r["numero_fecha"];
		}else{
			$num_fecha = 1;
		}
	} #B
} #A
	
if(!isset($inc)){ $inc = "fixture";}
if(!isset($id_torneo)){ $id_torneo = 3;}
?>
<table width="751" border="0" cellpadding="0" cellspacing="0" bgcolor="E1E1E1">
  <tr> 
    <td align="center" valign="top"><table width="733" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td><img src="../img/top_especial.gif" width="733" height="8"></td>
        </tr>
      </table>
      <table width="733" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td width="230"><img src="../img/left_campana.gif" width="230" height="37"></td>
          <td width="100%" class="BackHespeciales">&nbsp;</td>
          <td width="89"><img src="../img/especiales_year.gif" width="89" height="37"></td>
        </tr>
      </table> 
<?
	$sql="SELECT numero_fecha FROM futbol_partidos
		  WHERE id_torneo = $id_torneo
		  GROUP BY numero_fecha 
		  ORDER BY numero_fecha DESC";
?>
	  <TABLE width="733" border="0" cellpadding="0" cellspacing="0">
		<TR> 
		  <TD valign="top"><TABLE width="100%" border="0" cellpadding="0" cellspacing="0">
			  <TR> 
				<TD class="EspecialesTitleGray"><TABLE border="0" cellpadding="0" cellspacing="2">
					<TR> 
					  <TD nowrap><FONT color="898989" size="3"><STRONG>fecha <? echo $num_fecha ?></STRONG></FONT></TD>
					  <TD><IMG src="../img/dashed_gray.gif" width="2" height="17" hspace="8"></TD>
					  <TD><FONT color="898989">Ir a fecha</FONT></TD>
					  <TD>
<FORM name="fechas">
	<SELECT name="fechas" onChange="MM_jumpMenu('parent',this,1)">
<?
	$result = mysql_query ($sql);
	if(mysql_num_rows($result)!=0){
		while ($row = mysql_fetch_array($result)){
?>
		<OPTION value="index.php?inc=fixture&num_fecha=<? echo $row["numero_fecha"] ?>" <? if ($row["numero_fecha"] == $num_fecha){ echo "selected"; } ?> ><? echo $row["numero_fecha"] ?></OPTION>
<?
}
	}
?>
	</SELECT>
</FORM>
						</TD>
					 
					</TR>
				  </TABLE></TD>
			  </TR>
			  <TR> 
				<TD class="BackGradeGary"><? include "resultado_aldosivi.inc.php"; ?></TD>
			  </TR>
			  </table>
			  			<table width="494" border="0" cellpadding="0" cellspacing="0">
							<TR> 
								<TD class="EspecialesGray">
									<TABLE width="239" border="0" cellspacing="0" cellpadding="0">
										<TR> 
											<TD><A HREF="?inc=posiciones"><IMG src="../img/btn_posiciones_<? if ($inc == "posiciones") { echo "on.gif"; } else { echo "off.gif"; } ?>" width="72" height="20" hspace="5" border="0"></A></TD>
											<TD><A HREF="?inc=fixture"><IMG src="../img/btn_fixture_<? if ($inc == "fixture") { echo "on.gif"; } else { echo "off.gif"; } ?>" width="57" height="20" hspace="5" border="0"></A></TD>
											<TD><A HREF="index.php?inc=llave"><IMG src="../img/btn_llave_<? if ($inc == "llave") { echo "on.gif"; } else { echo "off.gif"; } ?>" height="20" hspace="5" border="0"></A></TD>
											<!-- <TD><A HREF="?inc=descenso"><IMG src="../img/btn_descenso_<? if ($inc == "descenso") { echo "on.gif"; } else { echo "off.gif"; } ?>" width="67" height="20" hspace="5" border="0"></A> -->
										</TR>
									</TABLE>
								</TD>
							</TR>
							<TR>
								<TD><? include $inc. ".inc.php" ?></TD>
							</TR>
						</table>
			  <TD valign="top"><? if ($inc!="llave") { ?>
						<TABLE width="239" border="0" cellpadding="0" cellspacing="0">
							<TR> 
								<TD>
									<? include "goleadores.inc.php"; ?>
								</TD>
							</TR>
							<TR> 
								<TD> 
									<? include "amonestados.inc.php"; ?>
								</TD>
							</TR>
							<TR> 
								<TD> 
									<? include "expulsados.inc.php"; ?>
								</TD>
							</TR>
						</TABLE><? } ?>
					</TD>
		</TR>
	  </TABLE>
	  <br>
    </td>
  </tr>
</table>
<? include "../fin.php" ?>

