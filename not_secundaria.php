<table width="289" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td class="shadow">&nbsp;</td>
  </tr>
<?
$sql = "SELECT n.*, f.archivo_imagen FROM noticias n
LEFT JOIN fotos f ON (n.id_foto = f.id)
LEFT JOIN publicaciones pu ON (pu.id_publicado = n.id)
WHERE pu.id_seccion = 2
AND pu.id_lista_tablas = 5
AND pu.id_estructura = $estruc
ORDER by posicion";
$result = mysql_query ($sql);
if(mysql_num_rows($result)!=0){
	while ($row = mysql_fetch_array($result)){
?>
  <tr>
    <td class="BigBold"><a href="javascript:abrirVentana('popup.php?id_not=<? echo $row["id"] ?>','<? echo $row["id"] ?>',503,350);"><? echo $row["titulo"] ?></a></td>
  </tr>
  <tr> 
    <td>
		<? 
		if( strlen($row["resumen"]) > 160 ){
			echo substr($row["resumen"],0,160). "...";
		}else{
			echo $row["resumen"];
		}
		?>	
	</td>
  </tr>
  <tr> 
    <td><img src="img/spacer.gif" width="1" height="10"></td>
<?
}
	} 
?>
  </tr>
</table>

