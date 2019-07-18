<!-- Inicio Infantiles -->
<tr> 
	<td colspan="3" class="InfantilesTable">Categor&iacute;as Inferiores</td>
</tr>
<tr> 
	<td colspan="3" class="shadow">&nbsp;</td>
</tr>
<?
$sql = "SELECT n.*, f.archivo_imagen FROM noticias n
LEFT JOIN fotos f ON (n.id_foto = f.id)
LEFT JOIN publicaciones pu ON (pu.id_publicado = n.id)
WHERE pu.id_seccion = 5
AND pu.id_lista_tablas = 5
AND pu.id_estructura = 3
LIMIT 3";
$result = mysql_query ($sql);
if(mysql_num_rows($result)!=0){
	while ($row = mysql_fetch_array($result)){
?>
<tr> 
	<td colspan="3">
		<table width="462" border="0" cellpadding="0" cellspacing="0">
			<tr> 
				<td><a href="javascript:abrirVentana('popup.php?id_not=<? echo $row["id"] ?>','<? echo $row["id"] ?>',503,350);" class="BigBold"><strong><? echo $row["titulo"] ?></strong></a><br>
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
				<td>
					<hr color="#E1E1E1" width="462" size="1" noshade>
				</td>
			</tr>
				</table>
</tr>
<?
} 
	}
	?>
<!-- Fin Infantiles -->							

