<!------------------------ COMIENZA ESTRUCTURA ------------------------->
<?
if(!isset($path)){$path = "";}
include $path."especiales/common.inc.php";
if(isset($Submit) && is_array($estructura)){
	ejecutar("estructura");
}
if(isset($del_id)){
	mysql_query("DELETE FROM estructura WHERE id=".$del_id);
}
########### Formulario ############
?>
<SCRIPT>
<!--
function agregarSub(id){
	document.forms[0].elements[1].value = id;
	document.forms[0].action = document.forms[0].action + "?Submit=si";
	document.forms[0].submit();
}
function seleccionarUbi(id){
	opener.document.forms[0].id_estructura.value = id;
	window.close();
}
function cambiarBoton(id){
	document.all.maestro.style.display = "none";
	document.all.subordinado.style.display = "inline";
	document.all.subordinado.href = "javascript:agregarSub('" + id + "');";
}
//-->
</SCRIPT>
<link rel="stylesheet" href="../includes/estilos_admin.css" type="text/css">
<FORM name="" action="<? echo $PHP_SELF ?>" method="post" enctype="multipart/form-data">
  <table width="100%" border="0" cellspacing="0" cellpadding="0" >
	<tr >
		    <td class="HeaderContenido">Edición</td>
	</tr>
</table>
    <TABLE width="100%" border="0" align="center" cellspacing="0">
	    <INPUT type="hidden" name="estructura[id]">
	    <INPUT type="hidden" name="estructura[id_estructura]">
        <TR class="Submenu"> 
	 		<TD width="250px">Nombre</TD>
			<TD width="90%">
				<INPUT type="text" name="estructura[nombre]" style="font-size:10px; width:100%">
			</TD>
		</TR>
	
	    <TR class="Submenu"> 
	 		<TD>Link</TD>
			<TD>
				<INPUT name="estructura[link]" type="text" style="font-size:10px; width:100%">
			</TD>
		</TR>
 
        <TR class="Submenu"> 
	 		<TD>Orden</TD>
			<TD>
				<INPUT type="text" name="estructura[orden]" style="font-size:10px; width:50px">
			</TD>
		</TR>
		<TR class="Submenu">
			<TD></TD>
			<TD align="right">
				<table border="0" cellspacing="1" cellpadding="1" width="300">
					<tr>
		  				<td width="50%" class="simBot">
							<input type="submit" name="Submit" id="maestro" value="Agregar"  class="bottexto" style="width:100%">
							<a id="subordinado" href="" style="width:100%; display:none">Agregar SUB</a></td>
						<td width="50%">
							<input value="Cancelar" type="reset"  class="bot"  style="width:100%" onClick="javascript:document.forms[0].Submit.value='Agregar';" name="reset">
						</td>
					</tr>
	   			</table>
			</TD>
		</TR>
    </TABLE>
	 <INPUT type="hidden" name="include" value="<? echo $include ?>">	
	<INPUT type="hidden" name="tabla" value="<? echo $tabla ?>">	
	<INPUT type="hidden" name="path" value="<? echo $path ?>">	
	<? if(isset($seleccionar)){?><INPUT type="hidden" name="seleccionar" value="<? echo $seleccionar ?>">
	<? } ?>
    <?
########### Despliego La estructura  ################
?>
    <TABLE border="0" align="center" cellspacing="0" width="100%">
    <TR>
	 <TD colspan="4"  class="HeaderContenido">Estructura</TD>
    </TR>
    &nbsp;
    <? 
function impresion(){
	global $row, $espacios, $seleccionar;	?>
    <TR class="Celeste"> 
	  
	 <TD> <INPUT type="button" value="Modificar"  class="bot" 
	  onClick="javascript:modificar('<? echo $row["id"] ?>','<? echo $row["id_estructura"] ?>','<? echo $row["nombre"] ?>','<? echo $row["link"] ?>','<? echo $row["orden"]?>');document.forms[0].Submit.value='Modificar';"></TD>
	 <TD width="100%" style="border-bottom: 1px #7B92AD solid; border-left: 1px #7B92AD solid">
	   <? if($espacios>0){  echo str_repeat ("&nbsp;", $espacios) . "!&#8212;";}  ?>
	   (<? echo $row["orden"] ?>)&nbsp;<A href=<?
	   
	   if(isset($seleccionar)){
	   	echo "'' title='Seleccionar Ubicación' onClick=\"javascript:seleccionarUbi('".$row['id']."')\" ";
		}else{
	   	echo "javascript:abrirVentana('especiales/estructura_contenidos.php?id=". $row['id'] ."&nom_estructura=". $row["nombre"] ."','est_cont',350,400)  title='Editar Contenido' ";
	   }
	   
	   ?>><? echo $row["nombre"] ?></A></TD>
	 <TD><INPUT type="button" value="Agregar SUB"  class="bot" onClick="javascript:cambiarBoton('<? echo $row["id"]?>');"></TD>
	  <TD><INPUT type="button" value="Borrar"  class="bot" onClick="javascript:borrar('<? echo $row["nombre"] ?>','<? echo $row["id"] ?>')"></TD>
    </TR>
    <? 
}
########### GERARQUIAS  ################
include $path."../common/estructura.fnc.php";
$espacios = -6;
estructura();
?>
  </TABLE>
</FORM>
<!------------------------ FIN ESTRUCTURA ------------------------->

