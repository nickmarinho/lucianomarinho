<!--
function mask(targ, type, rev)
{
	var patt = new Array();
	patt['cep'] = '#####-###';
	patt['cnpj'] = '##.###.###/####-##';
	patt['cpf'] = '###.###.###-##';
	patt['data'] = '##/##/####';
	patt['hora'] = '##:##:##';
	patt['tel'] = '####-####';
	patt['valor'] = '####-####';
	ele = $("#" + targ);
	val = ele.val();
	pos = ele.val().length - 1;
	msk = patt[type];

	if(rev)
	{
		pos = val.length - pos;
	}
	
	if(msk.charAt(pos) != '#' && val.charAt(pos) != msk.charAt(pos))
	{
		ele.value = val.substring(0, pos) + msk.charAt(pos) + val.charAt(pos);
	}
}

function formataValor(arg)
{
	var campo = $("#" + arg);
	var strVal;

	strVal = campo.val();

	if(isNaN(strVal.substring((strVal.length-1), strVal.length)))
	{
		strVal = strVal.substring(0, strVal.length-1);
	}	
	else
	{
		if((strVal.length == 3) && (strVal.substring(1,2) == ","))
		{
			strVal = "0," + strVal.substring(0,1) + strVal.substring(2,3);
		}

		//if(strVal.length == 0) strVal = "0,0";
		if(strVal.length == 1) strVal = "0,0" + strVal;
		//retira a vírgula
		strVal = strVal.substring(0, strVal.indexOf(",")) + strVal.substring(strVal.indexOf(",") + 1 , strVal.length);

		if((strVal.substring(0,1) == "0") && (strVal.length == 4))
		strVal = strVal.substring(1, strVal.length);

		if(strVal.length > 2)
		strVal = strVal.substring(0, strVal.length - 2) + "," + strVal.substring(strVal.length - 2, strVal.length );
	}

	campo.val(strVal);
}

var enviaform = function(tipo)
{
	$("#tipo").val(tipo);

	$("#banco option:selected").each(function()
	{
		banco = $(this).val();
	});
	
	var form = $("#for");
	if(banco == "") alert("Por favor, escolha um banco");
	else
	{
		form.attr('action', banco);
		form.submit();
	}
}
//-->