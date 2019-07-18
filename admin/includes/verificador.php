<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
<TITLE> Verificador </TITLE>
<META NAME="Generator" CONTENT="EditPlus">
<LINK href="../includes/estilos_admin.css" rel="stylesheet" type="text/css">
</HEAD>

<BODY>
<? include "../../common/conexion.php"; 
if(isset($id_estructura) && $id_estructura!=""){
?>
<table>
<?
$sql = "SELECT s.seccion, p.posicion, n.titulo
FROM publicaciones p
LEFT JOIN secciones s ON (p.id_seccion = s.id)
LEFT JOIN noticias n ON (p.id_publicado = n.id)
WHERE p.id_estructura = $id_estructura 
AND p.id_lista_tablas = 40 
ORDER BY p.id_seccion, p.posicion";

$result = mysql_query($sql);
if (mysql_num_rows($result)!=0){
	while ($row = mysql_fetch_array($result)){
		if ($row["seccion"] != $almacen_seccion){
			$almacen_seccion = $row["seccion"];
			?><tr><td><?
			echo "<BR><BR>" . $row["seccion"]; 
			?></td></tr><?
		}
		if ($row["posicion"]-1 == $almacen_posicion || $row["posicion"] == 1){
			?><tr><td class="BackVioletWorkFrame"><?
			echo $row["posicion"]. ": " . $row["titulo"] ;
			?></td></tr><?
		}else{
			?><tr><td bgcolor="white"><?
			echo "HUECO"; 
			?></td></tr><?
		}
		$almacen_posicion = $row["posicion"];
	}
}
?>
</table>
<?
}else{
	echo "Debe seleccionar la sección a publicar";
}
?>
</BODY>
</HTML>