<?php session_start();
    header("Cache-control: private"); // IE 6 Fix.
    header( 'Expires: Mon, 26 Jul 1997 05:00:00 GMT' );
    header( 'Last-Modified: ' . gmdate( 'D, d M Y H:i:s' ) . ' GMT' );
    header( 'Cache-Control: no-store, no-cache, must-revalidate' );
    header( 'Cache-Control: post-check=0, pre-check=0', false );
    header( 'Pragma: no-cache' );
    header( 'Content-Type: text/html; charset=ISO-8859-1',true);
    
    $_SESSION['contador_retorno']++;
    
    $filename_cabecalho = "crono_cabecalho.txt";
    
    if ( filesize($filename_cabecalho)>0){
        
        $file_cabecalho = fopen($filename_cabecalho,"r");
        
        
        $content_cabecalho = fread($file_cabecalho, filesize($filename_cabecalho));
        if ($content_cabecalho){
            $_SESSION['cabecalho'] = $content_cabecalho;
            
        }
        fclose($file_cabecalho);
    }
    
    $linha_cabecalho	=	explode("\n", $_SESSION['cabecalho']);
    
    $_SESSION['arquivo_pilotos'] = $linha_cabecalho[6];
    
    
    if (trim($linha_cabecalho[1]) == "b_vermelha.gif"){
        $corband  = "#FF0000";
		$corbck = "../images/b_RED24.gif";
        $fontband = "";
    }
    else if (trim($linha_cabecalho[1]) == "b_amarela.gif"){
        $corband  = "#FFFF00";
		$corbck = "../images/b_YLW24.gif";
        $fontband = "b";
    }
    
    else  if (trim($linha_cabecalho[1]) ==  "b_verde.gif"){
        $corband  = "#339900";
		$corbck = "../images/b_GRE24.gif";
        $fontband = "";
    }
    
    else{
        $corband  = "#0099FF";
		$corbck = "../images/b_BLU24.gif";
        $fontband = "";
    }
    
    
    if ($corband){
        $_SESSION['corband'] = $corband;
    }
    
    if ($fontband){
        $_SESSION['fontband'] = $fontband;
    }
    
    
    
    $filename_pilotos = trim($linha_cabecalho[6]);
    
    
    
    // LE LISTA PILOTOS
    
    //$filename_pilotos = "sc.txt";
    //echo $filename_pilotos;
    
    
    if ( filesize($filename_pilotos)>0){
        
        $file_pilotos = fopen($filename_pilotos,"r");
        
        $content_pilotos = fread($file_pilotos, filesize($filename_pilotos));
        
        $linha_pilotos	=	explode("\n", $content_pilotos);
        
        
        
        for ($i=0;$i<=100;$i++){
            $coluna_pilotos = explode("|", $linha_pilotos[$i]);
            
            if ($coluna_pilotos){
                $pilotos_nome[$coluna_pilotos[0]] = $coluna_pilotos[1]."-".$coluna_pilotos[4]."-".$coluna_pilotos[7];
                
                
                
            }
        }
        
        fclose($file_pilotos);
        //$piloto_melhor = $pilotos_nome[$separa_melhor[0]];
    }
    // FECHA LE LISTA PILOTOS
    
    $filename = "crono_corpo.txt";
    
    if ( filesize($filename)>0){
        
        $fileToOpen = fopen($filename,"r");
        
        $content_corpo = fread($fileToOpen, filesize($filename));
        
        if ($content_corpo){
            $_SESSION['corpo'] = $content_corpo;
            
        }
        //} // maxihost
        fclose($fileToOpen);
        
        
    }
    
    $linha_corpo	=	explode("\n", $_SESSION['corpo']);
    
    $coluna_cabecalho = explode("|", $linha_cabecalho[0]);
    
    $retorno = "<table width=\"700\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
    <tr>
    <td width=\"16\" colspan=\"2\">&nbsp;</td>
    <td><img src=\"../images/dot.gif\" width=\"110\" height=\"1\" border=\"0\" ></td>
    <td><td>
    </tr>";
    
    $retorno .= "<tr>
    <td>&nbsp;</td>
    <td valign=\"top\">
    <table width=\"640\" border=\"0\" height=\"60\" cellspacing=\"0\" cellpadding=\"0\">
    <tr><td colspan=\"3\" height=\"20\" align=\"center\"><a class=\"cabecalho10\">".$coluna_cabecalho[0]." &nbsp; </a></td></tr>";
    
    $retorno .= "<tr>
    <td width=\"3%\" height=\"20\"><img src=\"../images/dot.gif\" width=\"1\" height=\"1\" border=\"0\"></td>
    <td width=\"48%\" background=\"".$corbck."\" height=\"20\"". $fontband."\"><font size=\"1\" color=\"#FFFF00\"></font></td>
    <td width=\"50%\" background=\"".$corbck."\" height=\"20\" class=\"cabecalho11".$fontband."\">". $linha_cabecalho[2]." &nbsp;</td>
    </tr>
    </table>
    
    
    <table width=\"640\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
    <tr>
    <td width=\"2%\"><img src=\"../images/dot.gif\" width=\"1\" height=\"1\" border=\"0\"></td>
    <td height=\"10\" class=\"cabecalho4\" nowrap>";
    
    
    $retorno .="  ".$linha_cabecalho[4]."</td>
    <td img src=\"../images/dot.gif\" width=\"30\" height=\"1\" border=\"0\" class=\"cabecalho4\"></td>
    </tr>
    </table>
    
    
    <table width=\"640\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
    <tr>
    <td width=\"20\">&nbsp;</td>
    <td width=\"640\">
    <table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
    
    if (trim($linha_cabecalho[3])== "C") {
        $arrTITULOS = Array("PROVA", "MELHOR VOLTA", "", "", "", "Pos", "No", "Piloto(s)              ", "   TEMPO/Dif.", "   Dif/Ant.", "     Vlts", "   Última", "   Tempo", " Km/h", "na");
        $arrWidth   = Array(80, 60, 20, 77, 77, 58, 25);
        $arrCompl   = Array("", "&nbsp;&nbsp;", "&nbsp;&nbsp;", "&nbsp;&nbsp;", "&nbsp;&nbsp;", "", "&nbsp;&nbsp;");
        $XXX        = "C";
    } else {
        $arrTITULOS = Array("MELHOR", "ÚLTIMA VOLTA", "", "", "", "Pos", "No", "Piloto(s)                      ", "       TEMPO", "      Dif.", "     na", "   Km/h", "     Tempo", "    Km/h", "Vlts");
        $arrWidth   = Array(80, 65, 25, 62, 78, 62, 30);
        $arrCompl   = Array("&nbsp;&nbsp;", "&nbsp;&nbsp;", "", "&nbsp;&nbsp;", "&nbsp;&nbsp;", "&nbsp;&nbsp;", "");
        $XXX        = "T";
    }
    
    
    $retorno .="
    <tr>
    <td height=\"18\" width=\"10\">&nbsp;</td>
    <td height=\"18\" colspan=\"4\" class=\"tituloPS\"><img src=\"../images/dot.gif\" width=\"1\" height=\"18\" border=\"0\"></td>
    <td height=\"18\" colspan=\"4\" class=\"tituloRS\">".$arrTITULOS[0]."</td>
    <td height=\"18\" colspan=\"3\" class=\"tituloPS\">".$arrTITULOS[1]."</td>
    </tr>
    <tr>
    <td width=\"10\" height=\"18\"></td>
    <td width=\"25\" height=\"18\" class=\"tituloP\">".$arrTITULOS[5]."</td>
    <td width=\"30\" height=\"18\" class=\"tituloP\">".$arrTITULOS[6]."</td>
    <td width=\"150\" height=\"18\" class=\"tituloP\" align=\"left\" >".$arrTITULOS[7]."</td>
    <td width=\"32\" height=\"18\" class=\"tituloP\">".$arrTITULOS[2]."</td>
    <td width=\"".$arrWidth[0]."\" height=\"18\" class=\"tituloR\">".$arrTITULOS[8]."</td>
    <td width=\"".$arrWidth[1]."\" height=\"18\" class=\"tituloR\">".$arrTITULOS[9]."</td>
    <td width=\"".$arrWidth[2]."\" height=\"18\" class=\"tituloR\">".$arrTITULOS[10]."</td>
    <td width=\"".$arrWidth[3]."\" height=\"18\" class=\"tituloR\">".$arrTITULOS[11]."</td>
    <td width=\"".$arrWidth[4]."\" height=\"18\" class=\"tituloP\">".$arrTITULOS[12]."</td>
    <td width=\"".$arrWidth[5]."\" height=\"18\" class=\"tituloP\">".$arrTITULOS[13]."</td>
    <td width=\"".$arrWidth[6]."\" height=\"18\" class=\"tituloP\">".$arrTITULOS[14]."</td>
    </tr>";
    
    
    $link = mysql_connect('192.168.0.101', 'teste', 'teste');
    if (!$link) {
        die('N‹o foi poss’vel conectar: ' . mysql_error());
    }    
    if (!mysql_select_db("cronomap")) {
        echo "N‹o foi poss’vel selecionar mydbname: " . mysql_error();
        exit;
    }
    $sql = "SELECT posicao, numero, nome, diferenca, diferenca2, ultima, velocidade from prova_tomada ORDER BY posicao";
    $result = mysql_query($sql);
    if (!$result) {
        echo "N‹o foi poss’vel executar a consulta ($sql) no banco de dados: " . mysql_error();
        exit;
    }
    
    if (mysql_num_rows($result) == 0) {
        echo "Erro. Sem resultados para mostrar!";
        exit;
    }
    $i = 0;
    while ($row = mysql_fetch_assoc($result)) {
        if (($i % 2) == 0){
            $cor = "D6D6D6";                     //  <!--   "7D4800"       "713800" -->
            $corb = "../images/f_bsc.gif";                   //f_liveP.png";
        } else {
            $cor = "C3C3C3";                     //  <!--   "462500"       "713800" -->
            $corb = "../images/f_bsc.gif";                   //f_liveP.png";
        }
        $vclass = "coluna_br";
        $bclass ="../images/b_X.gif";
        $arrAlinha = Array ("r", "r", "c", "r", "r", "r", "c");
        $retorno .="<tr>
            
            <td background=\"".$bclass."\" height=\"16\" width=\"16\"></td>
            <td background=\"".$corb."\" height=\"16\" class=\"coluna_brc\" nowrap>". $row["posicao"]."</td>
            <td background=\"".$corb."\" height=\"16\" class=\"". $vclassC."\" nowrap>".$row["numero"]."</td>
            <td background=\"".$corb."\" height=\"16\" class=\"coluna_brl\" nowrap>&nbsp; ". $row["nome"] ."&nbsp;</td>
            <td background=\"".$corb."\" height=\"16\" width=\"32\" class=\"logo_".trim($piloto[1])."\" </td>
            <td background=\"".$corb."\" height=\"16\" class=\"". $vclass.$arrAlinha[0]."\" nowrap><b>". $row["diferenca"]."&nbsp;&nbsp;</b></td>
            <td background=\"".$corb."\" height=\"16\" class=\"". $vclass.$arrAlinha[1]."\" nowrap>". $row["diferenca2"]."&nbsp;&nbsp;</td>
            <td background=\"".$corb."\" height=\"16\" class=\"". $vclass.$arrAlinha[2]."\" nowrap>      ". $row["ultima"] ."</td>
            <td background=\"".$corb."\" height=\"16\" class=\"". $vclass.$arrAlinha[3]."\" nowrap>". $row["velocidade"]." &nbsp;&nbsp;</td>
            <td background=\"".$corb."\" height=\"16\" class=\"". $vclass.$arrAlinha[4]."\" nowrap>". $row["nome"]." &nbsp;&nbsp;</td>
            <td background=\"".$corb."\" height=\"16\" class=\"". $vclass.$arrAlinha[5]."\" nowrap>". $row["nome"]." &nbsp;&nbsp;</td>
            <td background=\"".$corb."\" height=\"16\" class=\"". $vclass.$arrAlinha[6]."\" nowrap>". $row["nome"]."</td>
            </tr>";
            
        $i++;
    }
    mysql_free_result($result);

    mysql_close($link);

    
    /* for($i = 0; $i <= (count($linha_corpo)-2); $i++)
    {
        
        if ($i==0){
            
            $separa_melhor = explode("|", $linha_corpo[$i]);	       //    [$i]   NOME DO USUÁRIO NA POSIÇÃO "0" DO ARRAY
            $p_melhor = $pilotos_nome[$separa_melhor[0]];
            
            
        }
        
        // SEPARAMOS OS DADOS PELO CARACTER ";"
        $separa=	explode("|", $linha_corpo[$i]);	           // NOME DO USUÁRIO NA POSIÇÃO "0" DO ARRAY
        
        if (($i % 2) == 0){
            $cor = "D6D6D6";                     //  <!--   "7D4800"       "713800" -->
            $corb = "../images/f_bsc.gif";                   //f_liveP.png";
        } else {
            $cor = "C3C3C3";                     //  <!--   "462500"       "713800" -->
            $corb = "../images/f_bsc.gif";                   //f_liveP.png";
        }
        
        
        if ($separa[0] == "»»"){
            $vclass = "coluna_am";
            $bclass ="../images/b_M.gif";
        } else {
            $vclass = "coluna_br";
            $bclass ="../images/b_X.gif";
        }
        
        if ($XXX == "T"){
            $arrAlinha = Array ("r", "r", "c", "r", "r", "r", "c");
            
            $BBB=$separa[4];
            $CCC=$separa[7];
            
            if (strlen($CCC)>8){
                ($CCC="+10 min");
            }
            
            if ((strlen($CCC)==8) and (strval($CCC{0}) > 2 )){
                ($CCC = "+3 min");
            }
            
            if (strlen($BBB)>7){
                ($BBB="+1 min");
            }
            
            $separa[4]=$BBB;
            $separa[7]=$CCC;
            
        } else {
            $arrAlinha = Array ("r", "r", "c", "r", "r", "r", "c");
            
            $AAA=$separa[4];
            $BBB=$separa[6];
            $CCC=$separa[5];
            $DDD=$separa[3];
            $EEE=$separa[9];
            $FFF=$separa[8];
            
            if (strlen($BBB)>8){
                ($BBB="+10 min");
            }
            
            if ((strlen($BBB)==8) and (strval($BBB{0}) > 2 )){
                ($BBB = "+3 min");
            }
            
            if (strlen($CCC)>7){
                ($CCC="+1 min");
            }
            
            $separa[3]=$AAA;
            $separa[6]=$BBB;
            $separa[4]=$CCC;
            $separa[5]=$DDD;
            $separa[8]=$EEE;
            $separa[9]=$FFF;
            
        }
        
        if ($separa[1] == "1"){ $arrAlinha = Array ("w", "r", "c","r", "r", "r", "c" , "p", "n");}
        
        
        if ($i>0){
            
            $pilotos = $pilotos_nome[$separa[2]];
            $piloto	=	explode("-", $pilotos);
            
            
            
            if ($piloto[2] == "5" ) ($vclassC = "coluna_br5");
            if ($piloto[2] == "4" ) ($vclassC = "coluna_br4");
            if ($piloto[2] == "3" ) ($vclassC = "coluna_br3");
            if ($piloto[2] == "2" ) ($vclassC = "coluna_br2");
            if ($piloto[2] == "1" ) ($vclassC = "coluna_br1");
            if ($piloto[2] == "" xor $piloto[2] == "-")  ($vclassC = "coluna_br ");
            //if ($piloto[2] == "" )  ($vclassC = "coluna_brc");
            //if ($piloto[2] == "-" )  ($vclassC = "coluna_brc");
            /// <td class=\"coluna_azc\">".$separa[0]."</td>
            
            $retorno .="<tr>
            
            <td background=\"".$bclass."\" height=\"16\" width=\"16\"></td>
            <td background=\"".$corb."\" height=\"16\" class=\"coluna_brc\" nowrap>". $separa[1]."</td>
            <td background=\"".$corb."\" height=\"16\" class=\"". $vclassC."\" nowrap>".$separa[2]."</td>
            <td background=\"".$corb."\" height=\"16\" class=\"coluna_brl\" nowrap>&nbsp; ". $piloto[0] ."&nbsp;</td>
            <td background=\"".$corb."\" height=\"16\" width=\"32\" class=\"logo_".trim($piloto[1])."\" </td>
            <td background=\"".$corb."\" height=\"16\" class=\"". $vclass.$arrAlinha[0]."\" nowrap><b>". $separa[3]."&nbsp;&nbsp;</b></td>
            <td background=\"".$corb."\" height=\"16\" class=\"". $vclass.$arrAlinha[1]."\" nowrap>". $separa[4]."&nbsp;&nbsp;</td>
            <td background=\"".$corb."\" height=\"16\" class=\"". $vclass.$arrAlinha[2]."\" nowrap>      ". $separa[5]."</td>
            <td background=\"".$corb."\" height=\"16\" class=\"". $vclass.$arrAlinha[3]."\" nowrap>". $separa[6]." &nbsp;&nbsp;</td>
            <td background=\"".$corb."\" height=\"16\" class=\"". $vclass.$arrAlinha[4]."\" nowrap>". $separa[7]." &nbsp;&nbsp;</td>
            <td background=\"".$corb."\" height=\"16\" class=\"". $vclass.$arrAlinha[5]."\" nowrap>". $separa[8]." &nbsp;&nbsp;</td>
            <td background=\"".$corb."\" height=\"16\" class=\"". $vclass.$arrAlinha[6]."\" nowrap>". $separa[9]."</td>
            </tr>";
        }
    }*/
    //  <td background=\"".$corb."\" height=\"16\" class=\"coluna_brcs\" nowrap>&nbsp;". $piloto[1] ."&nbsp;</td>
    
    //$p_melhor = left($piloto_melhor,10) ;
    $retorno .= " <table width=\"640\" border=\"0\" cellspacing=\"5\" cellpadding=\"0\">
    <tr>
    <td width=\"25\">&nbsp;</td>
    <td width=\"610\" height=\"24\" bgcolor=\"#970000\" class=\"melhorvoltaP\"> <b>Melhor Volta: </b>
    ". $p_melhor." (".$separa_melhor[0]."), ".$separa_melhor[1]." (média de: ".$separa_melhor[2]." Km/h) na ".$separa_melhor[3]."ª volta </td>
    <td width=\"1\"> </td>
    </tr>
    </table>
    <table width=\"640\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
    </table>";
    //<td class=\"refresh\">#".$_SESSION['contador_retorno']."</td>
    echo $retorno; ?>