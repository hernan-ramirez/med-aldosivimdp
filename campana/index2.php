<? $path = "../" ?>
<? $inc = "fixture" ?>
<? $id_torneo = "2" ?>
<? include "../common/conexion.php"; ?>
<? include "../inicio.php" ?>
<? include "../header.php"; ?>
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
<TABLE width="733" border="0" cellpadding="0" cellspacing="0">
		<TR> 
		  <TD class="BackGradeGary"> 
			<? include "resultado_aldosivi.inc.php"; ?>
		  </TD>
		</TR>
	  </table>
	  <TABLE width="733" border="0" cellspacing="0" cellpadding="0">
		<TR>
		  <TD class="EspecialesGray"><TABLE width="239" border="0" cellspacing="0" cellpadding="0">
			  <TR> 
				<TD><A HREF="index2.php?inc=posiciones"><IMG src="../img/btn_posiciones_<? if ($inc == "posiciones") { echo "on.gif"; } else { echo "off.gif"; } ?>" width="72" height="20" hspace="5" border="0"></A></TD>
				<TD><A HREF="index2.php?inc=fixture"><IMG src="../img/btn_fixture_<? if ($inc == "fixture") { echo "on.gif"; } else { echo "off.gif"; } ?>" width="57" height="20" hspace="5" border="0"></A></TD>
				<TD><A HREF="index.php?inc=llave"><IMG src="../img/btn_llave_<? if ($inc == "llave") { echo "on.gif"; } else { echo "off.gif"; } ?>" height="20" hspace="5" border="0"></A></TD>
				<!-- <TD><A HREF="?inc=descenso"><IMG src="../img/btn_descenso_<? if ($inc == "descenso") { echo "on.gif"; } else { echo "off.gif"; } ?>" width="67" height="20" hspace="5" border="0"></A> -->
			  </TR>
			</TABLE></TD>
		</TR>
	  </TABLE>
	  <TABLE width="733" border="0" cellspacing="0" cellpadding="0">
		<TR valign="top"> 
		  <TD> 
			<? include "goleadores.inc.php"; ?>
		  </TD>
		  <TD align="center"> 
			<? include "amonestados.inc.php"; ?>
		  </TD>
		  <TD align="right"> 
			<? include "expulsados.inc.php"; ?>
		  </TD>
		</TR>
	  </TABLE>
	  <table width="733" border="0" cellpadding="0" cellspacing="0">
		<TR> 
		  <TD> 
			<? include $inc. ".inc.php" ?>
		  </TD>
		</TR>
	  </table>
	  <BR>
	  <br>
    </td>
  </tr>
</table>
<? include "../fin.php" ?>

