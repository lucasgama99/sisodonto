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
<div class="conteudo" id="conteudo_central">
  <table width="100%" border="0" cellpadding="0" cellspacing="0" class="conteudo">
    <tr>
      <td width="74%">&nbsp;&nbsp;&nbsp;<img src="backup/img/backuprestaurar.png" alt="Sobre"> <span class="h3"><?=$LANG['backup_restoration']['backup_restoration']?></span></td>
      <td width="7%" valign="bottom">&nbsp;</td>
      <td width="19%" valign="bottom">&nbsp;</td>
    </tr>
  </table>
<div class="conteudo" id="table dados"><br />
  <div class="sobre" id="sobre">
    <p>&nbsp;</p>
    <fieldset>
  <legend><?=$LANG['backup_restoration']['explanation']?> </legend>
  <p><?=$LANG['backup_restoration']['dear_user']?>, <br />
  <br />
  <?=$LANG['backup_restoration']['the_area_you_accessed']?><br />
  <br />
  <?=$LANG['backup_restoration']['what_happens_is_the_php']?><br />
  <br />
  <?=$LANG['backup_restoration']['because_of_this']?><br />
  <br />
  <?=$LANG['backup_restoration']['however_you_dont_need']?><br />
  <br />
  <?=$LANG['backup_restoration']['the_mysql_front']?><br />
  <br />
  <?=$LANG['backup_restoration']['any_question_about_mysql_front']?><br />
  <br />
  <?=$LANG['backup_restoration']['thank_you_for_comprehension']?></p>
    </fieldset>
  </div>
</div>
