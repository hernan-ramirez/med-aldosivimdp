<? include "common/conexion.php" ?>
<HTML>
<HEAD>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<TITLE>Club Atl&eacute;tico Aldosivi</TITLE>
<META http-equiv="" content="text/html; charset=iso-8859-1">
<LINK href="estilos.css" rel="stylesheet" type="text/css">
<meta http-equiv="" content="text/html; charset=iso-8859-1"></HEAD>
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
<table width="486" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td class="PopHeaderColumna"><img src="img/spacer.gif" width="1" height="11"></td>
  </tr>
</table>
<table width="486" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td width="158"><img src="img/caa_pop.gif" alt="Club Atl&eacute;tico Aldosivi" width="158" height="22"></td>
    <td width="251" class="PopDashed">&nbsp;</td>
    <td width="72"><a href="javascript:printWindow()"javascript.print();""><img src="img/imprimir.gif" width="72" height="22" border="0"></a></td>
    <td width="7" class="PopDashed"><img src="img/spacer.gif" width="7" height="1"></td>
  </tr>
</table>
<?
$sql = "SELECT o.*, fc.archivo_columnistas, c.nombre FROM opiniones o
		LEFT JOIN fotos_columnistas fc ON (o.id_columnista = fc.id_columnista)
		LEFT JOIN columnistas c ON (o.id_columnista = c.id)
		WHERE o.id= $id_col";

$result = mysql_query ($sql);
if(mysql_num_rows($result)!=0){
	$row = mysql_fetch_array($result);
?>
<table width="486" border="0" cellspacing="0" cellpadding="0">
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
    <td bgcolor="#FFFFFF"><TABLE width="100%" border="0" cellspacing="2" cellpadding="2">
        <TR>
          <TD class="titOpinion">La Opini&oacute;n de <? echo $row["nombre"] ?> </TD>
        </TR>
        <TR> 
          <TD class="BigBold"> <? echo $row["titulo"] ?> </TD>
        </TR>
        <TR> 
          <TD class="Copete"> <b><? echo $row["resumen"] ?> </b></TD>
        </TR>
        <TR> 
          <TD valign="top"> <TABLE width="228" border="0" align="left" cellpadding="0" cellspacing="0">
              <TR> 
                <TD width="220"> <TABLE width="220" border="0" cellpadding="0" cellspacing="0">
                    <TR  > 
                      <TD><IMG src="clipart/columnistas/<? echo $row["archivo_columnistas"] ?>" width="220" height="145" border="1"></TD>
                    </TR>
                    <TR> 
                      <TD class="Epigrafe"> <? echo $row["epigrafe"] ?> </TD>
                    </TR>
                  </TABLE></TD>
                <TD width="8"><IMG src="img/spacer.gif" width="8" height="1"></TD>
              </TR>
            </TABLE>
            <? echo nl2br($row["cuerpo"]) ?> </TD>
        </TR>
      </TABLE></td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td bgcolor="EAEAEA">&nbsp;</td>
  </tr>
<tr> 
	<td bgcolor="EAEAEA"><img src="img/spacer.gif" width="1" height="1"></td>
	<td><img src="img/corner_pop_izq_bottom.gif" width="4" height="4"></td>
	<td bgcolor="#FFFFFF"><img src="img/spacer.gif" width="1" height="1"></td>
	<td><img src="img/corner_pop_der_bottom.gif" width="4" height="4"></td>
	<td bgcolor="EAEAEA"><img src="img/spacer.gif" width="1" height="1"></td>
</tr>  
</table>
<br>
<?
} 
?>
</BODY>
</HTML>

