<?
   /**
    * Gerenciador Cl�nico Odontol�gico
    * Copyright (C) 2006 - 2009
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
    * http://www.smileodonto.com.br/gco
    * smile@smileodonto.com.br
    *
    * Ou envie sua carta para o endere�o:
    *
    * Smile Odontol�ogia
    * Rua Laudemira Maria de Jesus, 51 - Lourdes
    * Arcos - MG - CEP 35588-000
    *
    *
    */
	include "../lib/config.inc.php";
	include "../lib/func.inc.php";
	include "../lib/classes.inc.php";
	require_once '../lang/'.$idioma.'.php';
	header("Content-type: text/html; charset=ISO-8859-1", true);
	if(!checklog()) {
		die($frase_log);
	}
?>
  <table width="750" border="0" align="center" cellpadding="0" cellspacing="0">
<?	
	if($_GET[pg] != '') {
		$limit = ($_GET[pg]-1)*PG_MAX;
	} else {
		$limit = 0;
		$_GET[pg] = 1;
	}
	$sql = "SELECT * FROM `estoque` WHERE `descricao` LIKE '%".$_GET['pesquisa']."%' ORDER BY `descricao` ASC";
	$conta = new TEstoque('clinica');
	$lista = $conta->ListConta($sql.' LIMIT '.$limit.', '.PG_MAX_MEN);
	$total_regs = $conta->ListConta($sql);
	$par = "F0F0F0";
	$impar = "F8F8F8";
	$saldo = 0;
	for($i = 0; $i < count($lista); $i++) {
		if($i % 2 == 0) {
			$odev = $par;
		} else {
			$odev = $impar;
		}
		$conta->LoadConta($lista[$i][codigo]);
		$saldo += $conta->RetornaDados('valor');
?>
    <tr bgcolor="#<?=$odev?>" onmouseout="style.background='#<?=$odev?>'" onmouseover="style.background='#DDE1E6'">
      <td width="75%" align="left"><?=$conta->RetornaDados('descricao')?></td>
      <td width="15%" align="center"><input type="text" size="13" name="quantidade" id="quantidade" value="<?=$conta->RetornaDados('quantidade')?>" onblur="Ajax('estoque/atualiza', 'conta_atualiza', 'codigo=<?=$conta->RetornaDados('codigo')?>&estoque='%2Bthis.value)"></td>
      <td width="10%" align="center"><a href="javascript:Ajax('estoque/extrato', 'conteudo', 'codigo=<?=$conta->RetornaDados('codigo')?>" onclick="return confirmLink(this)"><img src="imagens/icones/excluir.gif" alt="Excluir" width="19" height="19" border="0"></a></td>
    </tr>
<?
	}
?>
  </table>
  <br>
  <table width="750" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr bgcolor="#<?=$odev?>" onmouseout="style.background='#<?=$odev?>'" onmouseover="style.background='#DDE1E6'">
      <td width="160">
      <?=$LANG['stock']['total_stock']?>: <b><?=count($total_regs)?></b>
      </td>
      <td width="450" align="center">
<?
	$pg_total = ceil(count($total_regs)/PG_MAX_MEN);
	$i = $_GET[pg] - 5;
	if($i <= 1) {
		$i = 1;
		$reti = '';
	} else {
		$reti = '...&nbsp;&nbsp;';
	}
	$j = $_GET[pg] + 5;
	if($j >= $pg_total) {
		$j = $pg_total;
		$retf = '';
	} else {
		$retf = '...';
	}
	echo $reti;
	while($i <= $j) {
		if($i == $_GET[pg]) {
			echo $i.'&nbsp;&nbsp;';
		} else {
			echo '<a href="javascript:;" onclick="javascript:Ajax(\'estoque/pesquisa\', \'pesquisa\', \'pg='.$i.'\')">'.$i.'</a>&nbsp;&nbsp;';
		}
		$i++;
	}
	echo $retf;
?>
      </td>
      <td width="140" align="right"><img src="imagens/icones/imprimir.gif" border="0"> <a href="relatorios/estoque.php?sql=<?=$sql?>" target="_blank"><?=$LANG['stock']['print_report']?></a></td>
    </tr>
  </table>
  <div id="conta_atualiza"></div>
