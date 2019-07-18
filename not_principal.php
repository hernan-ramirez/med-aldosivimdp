<?
$sql = "SELECT n.*, f.archivo_imagen FROM noticias n
LEFT JOIN fotos f ON (n.id_foto = f.id)
LEFT JOIN publicaciones pu ON (pu.id_publicado = n.id)
WHERE pu.id_seccion = 1
AND pu.id_lista_tablas = 5
AND pu.id_estructura = $estruc
LIMIT 1";
$result = mysql_query ($sql);
if(mysql_num_rows($result)!=0){
	$row = mysql_fetch_array($result);
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr> 
	<td width="9" height="8" valign="top"><img src="img/corner_ppal.gif" width="9" height="8"></td>
	<td width="284"><img src="img/spacer.gif" width="1" height="1"></td>
	<td width="176" rowspan="2" valign="top" style="border-top: 2px #FFFFFF solid;"  class="BackFirstNew">
	<? if(file_exists("clipart/imagen/".$row["archivo_imagen"]) && $row["archivo_imagen"]!="" ){ ?>
	<img src="clipart/imagen/<? echo $row["archivo_imagen"] ?>" width="176" height="116" hspace="0" vspace="0" border="0">
	<? }else{ ?>
	&nbsp;
	<? } ?>
	</td>
  </tr>
  <tr> 
	<td class="BackFirstNew" style="border-left: 2px #FFFFFF solid;">&nbsp;</td>
	<td class="BackFirstNew"><table width="100%" border="0">
        <tr>
          <td class="BigBold"><a href="javascript:abrirVentana('popup.php?id_not=<? echo $row["id"] ?>','<? echo $row["id"] ?>',503,350);"><? echo $row["titulo"] ?></a></td>
        </tr>
        <tr>
          <td><? echo $row["resumen"] ?></td>
        </tr>
      </table>
	  </td>
  </tr>
</table>
<?
} 
?>

