<? include "common/conexion.php"; ?>
<? include "inicio.php"; ?>
<? include "header.php"; ?>

<? 
if(!isset($estruc)){
	$estruc = "1";
}
?>

<table width="751" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td class="BackContent"><table width="731" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
        <tr> 
          <td width="470" valign="top"> 
				
            <table width="470" height="0" border="0" cellpadding="0" cellspacing="0">
              <tr> 
                <td><?  include "not_principal.php" ?></td>
              </tr>
            </table>
			
			          
			<table width="470" height="0" border="0" cellpadding="0" cellspacing="0">
              <tr> 
                <td><a href="http://www.sportsya.com" target="_blank"><img src="img/mundo_deporte.gif" width="468" height="60" hspace="0" vspace="2" border="0" align="right"></a></td>
              </tr>
            </table>
			

			<table width="466" border="0" align="right" cellpadding="0" cellspacing="0">
				<tr> 
					<td width="289" valign="top"> 
						<? include "not_secundaria.php"; ?>
					</td>
					<td width="5" class="MiddleBody"><img src="img/spacer.gif" width="1" height="1"></td>
					<td width="172" valign="top"> 
						<? include "not_breve.php"; ?>
					</td>
				</tr>
			</table>
						<BR>
					</td>
          <td width="2"><img src="img/spacer.gif" width="2" height="1"></td>
          <td width="259" align="center" valign="top" class="SecndColmn"><table border="0" cellpadding="0" cellspacing="0">
              <tr> 
                <td> 
                  <? include "encuesta.php"; ?>
                </td>
              </tr>
            </table>
            <table width="244" border="0" cellpadding="0" cellspacing="0">
              <tr> 
                <td> 
                  <? include "opinion.php"; ?>
                </td>
              </tr>
              <tr> 
                <td><img src="img/spacer.gif" width="1" height="6"></td>
              </tr>
              <tr> 
                <td><a href="http://www.porloschicos.com/servlet/PorLosChicos?comando=donar" target="_blank"><img src="img/xlosch.gif" width="244" height="88" border="0"></a></td>
              </tr>
              <tr> 
                <td><img src="img/spacer.gif" width="1" height="6"></td>
              </tr>
              <tr> 
                <td> 
                  <? include "foro.php"; ?>
                </td>
              </tr>
              <tr>
                <td><img src="img/spacer.gif" width="1" height="15"></td>
              </tr>
            </table> </td>
        </tr>
      </table></td>
  </tr>
</table>
<? include "fin.php" ?>

