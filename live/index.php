<?php session_start();
header("Cache-control: private"); // IE 6 Fix. 
header( 'Expires: Mon, 26 Jul 1997 05:00:00 GMT' );
header( 'Last-Modified: ' . gmdate( 'D, d M Y H:i:s' ) . ' GMT' );
header( 'Cache-Control: no-store, no-cache, must-revalidate' );
header( 'Cache-Control: post-check=0, pre-check=0', false );
header( 'Pragma: no-cache' );
header( 'Content-Type: text/html; charset=ISO-8859-1',true);
$_SESSION['refresh']++; ?>
<html>
<head>
<title>CRONOMAP Timing - Live</title>
<link rel="shortcut icon" href="../../images/quad.ico" type="image/x-icon"/>
<link href="cronomap11.css" type="text/css" rel="stylesheet">
<script src="script.js" type="text/javascript"></script>
<script type="text/javascript">
  function update_relatorio() {
		 loadFragmentInToElement('retorno.php', 'retorno');
		 window.setTimeout('update_relatorio()', 10000);
          }		  
</script>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"></head>
<body bgcolor="#666666" leftmargin="4" topmargin="2" marginwidth="0" marginheight="0" onLoad = "update_relatorio()">
<div>
		<span id="retorno"></span>
</div>
	
 <table width="640" height="59" border="0" cellpadding="0" cellspacing="0">
        <td width="631"></tr>
        <tr>
    <td height="37" class="copyright2"><font color="#CCCCCC">©<b>Copyright 2000-2012
          CRONOMAP Timing</b><br>
          All rights reserved</font></td>
        </tr>
		    <td class="refresh">
		        <div align="right"></div>
		    <div align="left"><font color="#666666">XF5: <? echo $_SESSION['refresh'];?></font>
        <table width="512" border="0" hight="16" align="right" cellpadding="0" cellspacing="2">
          
        </table>
      </div><td width="9"></td>
</table>
 <p>&nbsp;</p>
</body>
</html>