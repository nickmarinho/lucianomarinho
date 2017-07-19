<html>
 <head>
  <title>Luciano Marinho - Sistema de Boletos</title>
  <script type="text/javascript" src="/boleto/js/jquery-1.5.1.js"></script>
  <script type="text/javascript" src="/boleto/js/scripts.js"></script>
  <meta http-equiv="Content-Type" content="text/html;charset=iso-8859-1" />
 </head>
 <body>
  <form method="post" name="for" id="for" target="_blank">
  <table width="70%" border="0" cellpadding="0" cellspacing="0" align="center">
<!--
   <tr align="center">
    <td colspan="2">Demonstração do Boleto do Banco Itaú</td>
   </tr>
   <tr>
    <th colspan="2">Dados do Cedente - (Cedente é o emisor do boleto)</th>
   </tr>
   <tr>
    <td align="right">Empresa:</td>
    <td><input class="long" type="text" name="cedente" id="cedente" value="LUCIANO MARINHO DE ALMEIDA" /></td>
   </tr>
   <tr>
    <td align="right">CNPJ:</td>
	<td><input class="medium" type="text" name="cpf_cnpj_cedente" id="cpf_cnpj_cedente" value="114.946.638-30" /></td>
   </tr>
   <tr>
    <td align="right">Ag�ncia:</td><td><input class="medium" type="text" name="agencia" id="agencia" value="3128" /><input class="tiny" type="text" name="digito_agencia" id="digito_agencia" value="" /></td>
   </tr>
   <tr>
    <td align="right">Conta:</td><td><input class="medium" type="text" name="conta" id="conta" value="06783" /><input class="tiny" type="text" name="digito_conta" id="digito_conta" value="6" /></td>
   </tr>
   <tr>
    <td align="right">Carteira:</td><td><input class="tiny" type="text" name="carteira" id="carteira" value="157" /></td>
   </tr>
   <tr>
    <td align="right">Endere�o:</td><td><input class="long" type="text" name="endereco" id="endereco" value="TRAV XAVIER SAMPAIO 136 B J NOVA BRASILIA" /></td>
   </tr>
   <tr>
    <td align="right">Cidade:</td><td><input class="long" type="text" name="cidade" id="cidade" value="SÃO PAULO / SP" /></td>
   </tr>
   <tr><td>&nbsp;</td></tr>
-->
   <tr>
    <th colspan="2">Dados do Boleto</th>
   </tr>
   <tr>
    <td align="right">Banco</td>
	<td>
	 <select id="banco" name="banco" size="1">
	  <option value="boleto_bb.php">BB</option>
	  <option value="boleto_bradesco.php">Bradesco</option>
	  <option value="boleto_cef.php">CEF</option>
	  <option value="boleto_itau.php" selected>Itau</option>
	 </select>
	</td>
   </tr>
   <tr>
    <td align="right">Valor R$:</td>
    <td>
	 <input class="short" type="text" name="valor" id="valor" value="30,00" maxlength='10' onkeydown="formataValor('valor')" onkeyup="formataValor('valor')" />
    </td>
   </tr>
   <tr>
    <td align="right">Nosso N�mero:</td>
    <td><input class="short" type="text" name="nosso_numero" id="nosso_numero" value="00000001" /></td>
   </tr>
   <tr>
    <td align="right">Data de Vencimento:</td>
	<td><input class="short" type="text" name="data_vencimento" id="data_vencimento" value="10/<?php echo date("m/Y"); ?>" maxlength='10' onkeydown="mask('data_vencimento', 'data')" onkeyup="mask('data_vencimento', 'data')" /> (dd/mm/aaaa)</td>
   </tr>
   <tr>
    <td align="right">Nº do Pedido:</td>
	<td><input class="short" type="text" name="numero_documento" id="numero_documento" value="1" /></td>
   </tr>
   <tr><td>&nbsp;</td></tr>
   
   <tr>
    <th colspan="2">Dados do Sacado - (Sacado é quem irá pagar o boleto)</th>
   </tr>
   <tr>
    <td align="right">Nome:</td>
    <td><input size="90" class="long" type="text" name="sacado" id="sacado" value="Maurício José Batista" /></td>
   </tr>
   <tr>
    <td align="right">Endereço 1:</td>
    <td><input size="90" class="long" type="text" name="endereco1" id="endereco1" value="Rua Manoel Joaquim Ginjo, 12" /></td>
   </tr>
   <tr>
    <td align="right">Endereço 2:</td>
    <td><input size="90" class="long" type="text" name="endereco2" id="endereco2" value="São Paulo/SP - CEP: 03924-195" /></td>
   </tr>
   <tr><td>&nbsp;</td></tr>
   
   <tr>
    <th colspan="2">Demonstrativo</th>
   </tr>
   <tr>
    <td align="right">Demonstrativo 1:</td>
	<td><input size="90" class="long" type="text" name="demonstrativo1" id="demonstrativo1" value="Pagamento de Hospedagem de Website Mensal" /></td>
   </tr>
   <tr>
    <td align="right">Demonstrativo 2:</td>
	<td><input size="90" class="long" type="text" name="demonstrativo2" id="demonstrativo2" value="Mensalidade referente a <?php echo date('m/Y'); ?>" /></td>
   </tr>
   
   <tr>
    <th colspan="2">Instruções do Boleto</th>
   </tr>
   <tr>
    <td align="right">Instrução 1:</td>
	<td><input size="90" class="long" type="text" name="instrucoes1" id="instrucoes1" value="- Sr. Caixa, cobrar multa de 10% após o vencimento" /></td>
   </tr>
   <tr>
    <td align="right">Instrução 2:</td>
	<td><input size="90" class="long" type="text" name="instrucoes2" id="instrucoes2" value="- Receber até 15 dias após o vencimento" /></td>
   </tr>
   <tr>
    <td align="right">Instrução 3:</td>
	<td><input size="90" class="long" type="text" name="instrucoes3" id="instrucoes3" value="- Juros diários de 1% após o vencimento" /></td>
   </tr>
   
   <tr><td>&nbsp;</td></tr>
   <tr>
    <td align="center" colspan="2">
	 <input type="hidden" name="tipo" id="tipo" value="" />
	 <input type='button' class="botao_padrao" value="Gerar PDF" onclick="javascript:enviaform('1');" />
	 <input type='button' class="botao_padrao" value="Visualizar Boleto" onclick="javascript:enviaform('2');" />
	</td>
   </tr>
   <tr><td>&nbsp;</td></tr>
  </table>
</form>
