<!-- Inicio Opinion -->
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr> 
    <td><img src="img/spacer.gif" width="1" height="6"></td>
  </tr>
  <?
$sql = "SELECT o.*, fc.archivo_columnistas, c.nombre
		FROM opiniones o
		LEFT JOIN columnistas c ON (o.id_columnista = c.id)
		LEFT JOIN fotos_columnistas fc ON (o.id_columnista = fc.id_columnista)
		ORDER by 'id' DESC LIMIT 2";
$result = mysql_query ($sql);
if(mysql_num_rows($result)!=0){
	while ($row = mysql_fetch_array($result)){
?>
  <tr> 
    <td height="52">
			<TABLE width="100%" border="0" cellspacing="3" cellpadding="3">
				<TR>
					<TD width="83"><img src="clipart/columnistas/<? echo $row["archivo_columnistas"] ?>" width="83" height="55" border="1" align="left"></TD>
					<TD><a href="javascript:abrirVentana('columna.php?id_col=<? echo $row["id"] ?>','<? echo $row["id"] ?>',503,350);" class="GreenBold"><? echo $row["nombre"] ?>: 
						<? echo $row["titulo"] ?></a><br>
						<? 
		if( strlen($row["resumen"]) > 55 ){
			echo substr($row["resumen"],0,55). "...";
		}else{
			echo $row["resumen"];
		}
		?>
					</TD>
				</TR>
			</TABLE>
			
		</td>
  </tr>
  <tr> 
    <td><img src="img/spacer.gif" width="1" height="6"></td>
  </tr>
  <?
}
	} 
?>
</table>
<!-- Fin Opinion -->

