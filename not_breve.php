<?
$sql = "SELECT n.*, f.archivo_imagen FROM noticias n
LEFT JOIN fotos f ON (n.id_foto = f.id)
LEFT JOIN publicaciones pu ON (pu.id_publicado = n.id)
WHERE pu.id_seccion = 3
AND pu.id_lista_tablas = 5
AND pu.id_estructura = $estruc
ORDER by posicion";
$result = mysql_query ($sql);
if(mysql_num_rows($result)!=0){
	while ($row = mysql_fetch_array($result)){
?>
<table width="172" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td class="PaddingTerciaria"><a href="javascript:abrirVentana('popup.php?id_not=<? echo $row["id"] ?>','<? echo $row["id"] ?>',503,350);"><strong><? echo $row["titulo"] ?></strong></a></td>
  </tr>
  <tr> 
    <td>
		<? 
		if( strlen($row["resumen"]) > 90 ){
			echo substr($row["resumen"],0,90). "...";
		}else{
			echo $row["resumen"];
		}
		?>
	</td>
  </tr>
  <tr> 
    <td class="Dashed"><img src="img/dashed.gif" width="1" height="5"></td>
  </tr>
</table>
<?
} 
	}
	?>

