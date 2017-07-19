<?php
// DADOS DO BOLETO PARA O SEU CLIENTE
$dias_de_prazo_para_pagamento = 5;
$taxa_boleto = 3.50;

if(!empty($_POST['data_vencimento'])) $data_venc = $_POST['data_vencimento'];
else $data_venc = date("d/m/Y", time() + ($dias_de_prazo_para_pagamento * 86400));  // Prazo de X dias OU informe data: "13/04/2006"; 

if(!empty($_POST['valor'])) $valor_cobrado = $_POST['valor'];
else $valor_cobrado = "30,00"; // Valor - REGRA: Sem pontos na milhar e tanto faz com "." ou "," ou com 1 ou 2 ou sem casa decimal

$valor_cobrado = str_replace(",", ".", $valor_cobrado); 
$valor_boleto=number_format($valor_cobrado+$taxa_boleto, 2, ',', '');

if(!empty($_POST['nosso_numero'])) $dadosboleto["nosso_numero"] = $_POST["nosso_numero"];
else $dadosboleto["nosso_numero"] = '1';  // Nosso numero - REGRA: Máximo de 8 caracteres!

$dadosboleto["numero_documento"] = '1';	// Num do pedido ou nosso numero
$dadosboleto["data_vencimento"] = $data_venc; // Data de Vencimento do Boleto - REGRA: Formato DD/MM/AAAA
$dadosboleto["data_documento"] = date("d/m/Y"); // Data de emissão do Boleto
$dadosboleto["data_processamento"] = date("d/m/Y"); // Data de processamento do boleto (opcional)
$dadosboleto["valor_boleto"] = $valor_boleto; 	// Valor do Boleto - REGRA: Com vírgula e sempre com duas casas depois da virgula

// DADOS DO SEU CLIENTE
$dadosboleto["sacado"] = utf8_decode(htmlentities($_POST['sacado']));
$dadosboleto["endereco1"] = utf8_decode(htmlentities($_POST["endereco1"])); // RUA NUMERO B J
$dadosboleto["endereco2"] = utf8_decode(htmlentities($_POST["endereco2"])); // CIDADE / UF

// INFORMACOES PARA O CLIENTE
$dadosboleto["demonstrativo1"] = utf8_decode(htmlentities($_POST["demonstrativo1"])); //"Pagamento de Hospedagem de Website Mensal";
$dadosboleto["demonstrativo2"] = utf8_decode(htmlentities($_POST["demonstrativo2"])); //"Mensalidade referente a " . date('m/Y');
$dadosboleto["demonstrativo3"] = "Taxa bancária - R$ " . number_format($taxa_boleto, 2, ',', '');

$dadosboleto["instrucoes1"] = utf8_decode(htmlentities($_POST["instrucoes1"])); //"- Sr. Caixa, cobrar multa de 2% após o vencimento";
$dadosboleto["instrucoes2"] = utf8_decode(htmlentities($_POST["instrucoes2"])); //"- Receber até 10 dias após o vencimento";
$dadosboleto["instrucoes3"] = utf8_decode(htmlentities($_POST["instrucoes3"])); //"- Em caso de dúvidas entre em contato conosco: contato@lucianomarinho.com.br";
$dadosboleto["instrucoes4"] = "";

// DADOS OPCIONAIS DE ACORDO COM O BANCO OU CLIENTE
$dadosboleto["quantidade"] = "";
$dadosboleto["valor_unitario"] = "";
$dadosboleto["aceite"] = "";		
$dadosboleto["especie"] = "R$";
$dadosboleto["especie_doc"] = "";

// ---------------------- DADOS FIXOS DE CONFIGURAÇÃO DO SEU BOLETO --------------- //
// DADOS DA SUA CONTA - ITAÚ
$dadosboleto["agencia"] = "3128";	// Num da agencia, sem digito
$dadosboleto["conta"] = "06783";	// Num da conta, sem digito
$dadosboleto["conta_dv"] = "6"; 	// Digito do Num da conta

// DADOS PERSONALIZADOS - ITAÚ
$dadosboleto["carteira"] = "157";  // Código da Carteira: pode ser 175, 174, 104, 109, 178, ou 157

// SEUS DADOS
$dadosboleto["identificacao"] = "LUCIANO MARINHO DE ALMEIDA";
$dadosboleto["cpf_cnpj"] = "114.946.638-30";
$dadosboleto["endereco"] = "TRAV XAVIER SAMPAIO 136 B J NOVA BRASILIA";
$dadosboleto["cidade_uf"] = "SÃO PAULO / SP";
$dadosboleto["cedente"] = "LUCIANO MARINHO DE ALMEIDA<br />Análise e Desenvolvimento de Websites e Sistemas";

// NÃO ALTERAR!
include("include/funcoes_itau.php"); 

if(!empty($_POST['tipo']))
{
	if($_POST['tipo'] == '1') include("include/layout_itau_pdf.php");
	else include("include/layout_itau.php");
}
?>