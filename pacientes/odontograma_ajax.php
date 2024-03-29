<?
   /**
    * Gerenciador Cl�nico Odontol�gico
    * Copyright (C) 2006 - 2008
    * Autores: Ivis Silva Andrade - Engenharia e Design(ivis@expandweb.com)
    *          Pedro Henrique Braga Moreira - Engenharia e Programa��o(ikkinet@gmail.com)
    *
    * Este arquivo � parte do programa Gerenciador Cl�nico Odontol�gico
    *
    * Gerenciador Cl�nico Odontol�gico � um software livre; voc� pode
    * redistribu�-lo e/ou modific�-lo dentro dos termos da Licen�a
    * P�blica Geral GNU como publicada pela Funda��o do Software Livre
    * (FSF); na vers�o 2 da Licen�a invariavelmente.
    *
    * Este programa � distribu�do na esperan�a que possa ser �til,
    * mas SEM NENHUMA GARANTIA; sem uma garantia impl�cita de ADEQUA��O
    * a qualquer MERCADO ou APLICA��O EM PARTICULAR. Veja a
    * Licen�a P�blica Geral GNU para maiores detalhes.
    *
    * Voc� recebeu uma c�pia da Licen�a P�blica Geral GNU,
    * que est� localizada na ra�z do programa no arquivo COPYING ou COPYING.TXT
    * junto com este programa. Se n�o, visite o endere�o para maiores informa��es:
    * http://www.gnu.org/licenses/old-licenses/gpl-2.0.html (Ingl�s)
    * http://www.magnux.org/doc/GPL-pt_BR.txt (Portugu�s - Brasil)
    *
    * Em caso de d�vidas quanto ao software ou quanto � licen�a, visite o
    * endere�o eletr�nico ou envie-nos um e-mail:
    *
    * http://www.smileprev.com/gco
    * smileprev@smileprev.com
    *
    * Ou envie sua carta para o endere�o:
    *
    * SmilePrev Cl�nicas Odontol�gicas
    * Rua Laudemira Maria de Jesus, 51 - Lourdes
    * Arcos - MG - CEP 35588-000
    *
    * Ou nos contate pelo telefone:
    *
    * Tel.: 0800-285-8787
    *
    *
    */
	include "../lib/config.inc.php";
	include "../lib/func.inc.php";
	include "../lib/classes.inc.php";
	header("Content-type: text/html; charset=ISO-8859-1", true);
	if(!checklog()) {
		die($frase_log);
	}
	$acao = '&acao=editar';
	$paciente = new TPacientes();
    $query = mysql_query("SELECT * FROM odontograma WHERE codigo_paciente = ".$_GET['codigo']) or die('Line 39: '.mysql_error());
    while($row = mysql_fetch_assoc($query)) {
        $dente[$row['dente']] = $row['descricao'];
    }
	$strLoCase = encontra_valor('pacientes', 'codigo', $_GET[codigo], 'nome').' - '.$_GET['codigo'];
?>
<link href="../css/smileprev.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.style4 {color: #FFFFFF}
-->
</style>
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="conteudo">
  <tr>
    <td width="100%">&nbsp;&nbsp;&nbsp;<img src="pacientes/img/pacientes.png" alt="Gerenciar Dentistas"> <span class="h3">GERENCIAR PACIENTES &nbsp;[<?=$strLoCase?>] </span></td>
  </tr>
</table>
<div class="conteudo" id="table dados">
<br />
<?include('submenu.php')?>
<br />
<table width="610" border="0" align="center" cellpadding="0" cellspacing="0" class="tabela_titulo">
  <tr>
    <td height="26">&nbsp;ODONTOGRAMA</td>
  </tr>
</table>
<table width="610" border="0" align="center" cellpadding="0" cellspacing="0" class="tabela">
  <tr>
    <td>
      <form id="form2" name="form2" method="POST" action="pacientes/incluir_ajax.php<?=$frmActEdt?>" onsubmit="formSender(this, 'conteudo'); return false;"><br /><fieldset>
      <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" style="background: url('pacientes/img/odontograma.gif') center center no-repeat;">
        <tr>
          <td width="35%" align="right">
            <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
<?
    for($i = 18; $i != 49; $i++) {
?>
              <tr>
                <td width="100%" align="right" style="height: 25px" valign="middle">
                  <input type="text" name="dente[<?=$i?>]" value="<?=$dente[$i]?>" class="forms"
                  onblur="Ajax('pacientes/atualiza', 'pacientes_atualiza', 'descricao='%2Bthis.value%2B'&codigo_paciente=<?=$_GET['codigo']?>&dente=<?=$i?>');" />
                </td>
              </tr>
<?
        if($i == 11) {
            $i = 40;
        }
        if($i < 40) {
            $i -= 2;
        }
    }
?>
            </table>
          </td>
          <td width="30%" align="center">

          </td>
          <td width="35%" align="center">
            <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
<?
    for($i = 28; $i != 39; $i++) {
?>
              <tr>
                <td width="100%" align="left" style="height: 25px" valign="middle">
                  <input type="text" name="dente[<?=$i?>]" value="<?=$dente[$i]?>" class="forms"
                  onblur="Ajax('pacientes/atualiza', 'pacientes_atualiza', 'descricao='%2Bthis.value%2B'&codigo_paciente=<?=$_GET['codigo']?>&dente=<?=$i?>');" />
                </td>
              </tr>
<?
        if($i == 21) {
            $i = 30;
        }
        if($i < 30) {
            $i -= 2;
        }
    }
?>
            </table>
          </td>
        </tr>
      </table>
    </form>
    </td>
  </tr>
    <tr>
      <td align="right"> <br />
        <img src="../imagens/icones/imprimir.gif"> <a href="../relatorios/odontograma.php?codigo=<?=$_GET['codigo']?>" target="_blank">Imprimir Odontograma</a>&nbsp;
      </td>
    </tr>
</table>
<div id="pacientes_atualiza"></div>
