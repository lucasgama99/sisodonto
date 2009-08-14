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
        echo '<script>Ajax("wallpapers/index", "conteudo", "");</script>';
        die();
	}
?>
<div id='calendario' name='calendario' style='display:none;position:absolute;'>
<?
	include "../lib/calendario.inc.php";
?>
</div>
<div class="conteudo" id="conteudo_central">
  <table width="100%" border="0" cellpadding="0" cellspacing="0" class="conteudo">
    <tr>
      <td width="43%">&nbsp;&nbsp;&nbsp;<img src="agenda/img/agenda.png" alt="Agenda"> <span class="h3"><?=$LANG['calendar']['manage_calendar']?></span></td>
      <td width="28%" valign="bottom">
      <select name="codigo_dentista" class="forms" id="codigo_dentista" onchange="javascript:Ajax('agenda/pesquisa', 'pesquisa', 'pesquisa='%2BgetElementById('procurar').value%2B'&codigo_dentista='%2Bthis.options[this.selectedIndex].value)">
      <option></option>
<?
		$dentista = new TDentistas();
		$lista = $dentista->ListDentistas("SELECT * FROM `dentistas` WHERE `ativo` = 'Sim' ORDER BY `nome` ASC");
		for($i = 0; $i < count($lista); $i++) {
			if($_SESSION[cpf] == $lista[$i][cpf]) {
				echo '<option value="'.$lista[$i][codigo].'" selected>'.$lista[$i][titulo].' '.$lista[$i][nome].'</option>';
			} else {
				echo '<option value="'.$lista[$i][codigo].'">'.$lista[$i][titulo].' '.$lista[$i][nome].'</option>';
			}
		}
?>     
			 </select></td>
      <td width="27%" align="right" valign="bottom">
        <?=$LANG['calendar']['date']?> <input name="procurar" id="procurar" value="<?=converte_data(hoje(), 2)?>" type="text" class="forms" size="20" maxlength="40"
		onkeyup="javascript:Ajax('agenda/pesquisa', 'pesquisa', 'pesquisa='%2Bthis.value%2B'&codigo_dentista='%2BgetElementById('codigo_dentista').options[getElementById('codigo_dentista').selectedIndex].value)"
		onfocus="javascript:Ajax('agenda/pesquisa', 'pesquisa', 'pesquisa='%2Bthis.value%2B'&codigo_dentista='%2BgetElementById('codigo_dentista').options[getElementById('codigo_dentista').selectedIndex].value)"
		onKeypress="return Ajusta_Data(this, event);"
		onclick="abreCalendario(this)"
		<?/*onblur="fechaCalendario(this)"*/?>></td>
      <td width="2%" valign="bottom">&nbsp;</td>
    </tr>
</table>
<div class="conteudo" id="table dados"><br>
  <table width="750" border="0" align="center" cellpadding="0" cellspacing="0" class="tabela_titulo">
    <tr>
      <td bgcolor="#009BE6" colspan="8">&nbsp;</td>
    </tr>
    <tr>
      <td width="7%" align="left" height="23">&nbsp;<?=$LANG['calendar']['time']?></td>
      <td width="24%" align="left"><?=$LANG['calendar']['patient']?></td>
      <td width="13%" align="left"><?=$LANG['calendar']['procedure']?></td>
      <td width="6%" align="left" style="border-right: 1px; border-right-color=: #000000; border-right-style: solid">&nbsp;<?=$LANG['calendar']['missed']?></td>
      <td width="7%" align="left">&nbsp;<?=$LANG['calendar']['time']?></td>
      <td width="24%" align="left"><?=$LANG['calendar']['patient']?></td>
      <td width="13%" align="left"><?=$LANG['calendar']['procedure']?></td>
      <td width="6%" align="left">&nbsp;<?=$LANG['calendar']['missed']?></td>
    </tr>
  </table>
  <div id="pesquisa"></div>
  <script>
  	function atualizaData() {
  		Ajax('agenda/pesquisa', 'pesquisa', 'pesquisa=<?=converte_data(hoje(), 2)?>&codigo_dentista=<?=$_SESSION[codigo]?>');
  	}
<?
  	if($_SESSION[nivel] == 'Dentista') {
  		echo 'atualizaData();';
  	}
?>
  </script>
</div>
