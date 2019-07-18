<? $path = "../" ?>
<? include "../common/conexion.php"; ?>
<? include "../inicio.php" ?>
<? include "../header.php"; ?>
 <table width="751" border="0" cellpadding="0" cellspacing="0" bgcolor="E1E1E1">
  <tr> 
    <td align="center" valign="top"><table width="733" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td><img src="../img/top_especial.gif" width="733" height="8"></td>
        </tr>
      </table>
      <table width="733" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td width="212"><img src="../img/left_plantel.gif" width="212" height="37"></td>
          <td width="100%" background="../img/back_h_especiales.gif" class="BackHespeciales">&nbsp;</td>
          <td width="89"><img src="../img/especiales_year.gif" width="89" height="37"></td>
        </tr>
      </table> 
      		<table border="0" cellspacing="0" cellpadding="0" width="733">
				<tr> 
					<td class="EspecialesTitle">Nombre Completo</td>
					<td align="center" class="EspecialesTitle">Puesto</td>
					<td class="EspecialesTitleY">Fecha de Nacim</td>
					<td align="center" class="EspecialesTitleY">Lugar de Nacimiento</td>
					<td align="center" class="EspecialesTitleY">Altura</td>
					<td align="center" class="EspecialesTitleY">Peso</td>
					<td align="center" class="EspecialesTitle">Ver Ficha</td>		
				</tr>
				<?
			$sql = "SELECT j.*, p.puesto
					FROM futbol_planteles pl
					LEFT JOIN futbol_jugadores j ON (pl.id_jugador = j.id)
					LEFT JOIN futbol_jugadores_puestos p ON (j.id_puesto = p.id)
					WHERE id_clubes = 1
					ORDER by j.id_puesto";
					$result = mysql_query ($sql);
					if(mysql_num_rows($result)!=0){
					while ($row = mysql_fetch_array($result)){
			?>
				<tr> 
					<td class="EspecialesGreen"><? echo $row["apellido"] ?>, <? echo $row["nombre"] ?></td>
					<td align="center" bgcolor="#f7f7f7" class="EspecialesGreen"> <? echo $row["puesto"] ?> </td>
					<td align="center" bgcolor="#f7f7f7" class="EspecialesYellow"><? echo $row["fecha_nacimiento"] ?></td>
					<td align="center" bgcolor="#f7f7f7" class="EspecialesYellow"><? echo $row["lugar_nacimiento"] ?></td>
					<td align="center" bgcolor="#f7f7f7" class="EspecialesYellow"><? echo $row["altura"] ?> mts.</td>
					<td align="center" bgcolor="#f7f7f7" class="EspecialesYellow"><? echo $row["peso"] ?> kg.</td>
				    <td align="center" bgcolor="#f7f7f7" class="EspecialesGreen"><A href="javascript:abrirVentana('jugador.php?id=<? echo $row["id"] ?>','INST',503,350);"><FONT color="#000000">Ver 
						Ficha</FONT></A></td>					
					
				</tr>
				<?
				} 
					}
				?>
			</table>
		<BR>

    </td>
  </tr>
</table>
<? include "fin.php" ?>

