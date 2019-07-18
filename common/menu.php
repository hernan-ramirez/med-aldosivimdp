<table width="165" border="0" cellspacing="0" cellpadding="0">
<tr>
	    <td class="SpacerMenu"><img src="img/spacer_menu.gif" width="100%" height="2"></td>
</tr>
<?
function impresion() {
	global $row, $espacios;
?>
<tr>
	<td class="Menu" onmouseover="this.className='MenuOver';" onmouseout="this.className='MenuOff';">
	<? #if($espacios>0){  echo str_repeat ("&nbsp;", $espacios) . "!&#8212;";}  ?>
    <A href="?id_estruc=<? echo $row["id"] ?>" ><? echo $row["nombre"] ?></A>
	</td>
</tr>
<tr>
	    <td class="SpacerMenu"><img src="img/spacer_menu.gif" width="100%" height="2"></td>
</tr>
<?
}
include $path."common/estructura.fnc.php";
$espacios = -6;
$id_estructura = $id_estruc;
estructura();
?>
</table>

