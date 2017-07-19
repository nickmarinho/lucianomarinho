var newfieldcount = 0;
var filteron = 0;

/* LOADING */
var loading = function(){
	var loadingdiv = "";
	loadingdiv += '  <div style="width:100%;" id="loaderContainer">';
	loadingdiv += '   <div id="loaderContainerWH">';
	loadingdiv += '    <div id="loader" style="z-index: 2147483647;">';
	loadingdiv += '     <img id="loaderAnimation" style="background:url(\'/img/loading.gif\');height:15px;width:15px;" src="/img/1x1.gif" />';
	loadingdiv += '	     <strong>please wait, page is loading ...</strong>';
	
	if(filteron > 0) loadingdiv += '';
	
	loadingdiv += '	     <img id="loaderAnimation" style="background:url(\'/img/loading.gif\');height:15px;width:15px;" src="/img/1x1.gif" />';
	loadingdiv += '	    </div>';
	loadingdiv += '	   </div>';
	loadingdiv += '	  </div>';
	$("#maincontent").html(loadingdiv);
};

/* LISTS */
var listbancos = function(p, cpfcnpj, email, id_cliente, name, nome, title, user){
	loading();
	$.get('/admin/listbancos', { p : p, nome : nome }, function(data){
		$("#maincontent").html(data);
		$('.button').button();
		loadfilters();
		$("#grid").simpleResizableTable();
	});
};

var listblog = function(p, cpfcnpj, email, id_cliente, name, nome, title, user){
	loading();
	$.get('/admin/listblog', { p : p, title : title }, function(data){
		$("#maincontent").html(data);
		$('.button').button();
		loadfilters();
		$("#grid").simpleResizableTable();
	});
};

/* 
 * criei 2 funcoes:
 * 'listboleto': pra listar apenas com id do cliente
 * 'listboletos': para paginacao com todos os campos
 */
var listboleto = function(id_cliente){
	loading();
	$.get('/admin/listboletos', { id_cliente : id_cliente }, function(data){
		$("#maincontent").html(data);
		$('.button').button();
		loadfilters();
		$("#grid").simpleResizableTable();
	});
};

var listboletos = function(p, cpfcnpj, email, id_cliente, name, nome, title, user){
	loading();
	$.get('/admin/listboletos', { p : p, id_cliente : id_cliente }, function(data){
		$("#maincontent").html(data);
		$('.button').button();
		loadfilters();
		$("#grid").simpleResizableTable();
	});
};

var listclientes = function(p, cpfcnpj, email, id_cliente, name, nome, title, user){
	loading();
	$.get('/admin/listclientes', { p : p, name : name, nome : nome, email : email, cpfcnpj : cpfcnpj }, function(data){
		$("#maincontent").html(data);
		$('.button').button();
		loadfilters();
		$("#grid").simpleResizableTable();
	});
};

var listscripts = function(p, cpfcnpj, email, id_cliente, name, nome, title, user){
	loading();
	$.get('/admin/listscripts', { p : p, name : name }, function(data){
		$("#maincontent").html(data);
		$('.button').button();
		loadfilters();
		$("#grid").simpleResizableTable();
	});
};

var listscriptscategories = function(p, cpfcnpj, email, id_cliente, name, nome, title, user){
	loading();
	$.get('/admin/listscriptscategories', { p : p, name : name }, function(data){
		$("#maincontent").html(data);
		$('.button').button();
		loadfilters();
		$("#grid").simpleResizableTable();
	});
};

var listusers = function(p, cpfcnpj, email, id_cliente, name, nome, title, user){
	loading();
	$.get('/admin/listusers', { p : p, user : user, name : name, email : email }, function(data){
		$("#maincontent").html(data);
		$('.button').button();
		loadfilters();
		$("#grid").simpleResizableTable();
	});
};

/*
 * functions to use in place
 */
/* ADD */
var addboletos = function(id_cliente){
	if(id_cliente != '')
	{
		$.get('/admin/addboletos', { id_cliente : id_cliente }, function(data){
			if(data != '' && data != '0'){ var lastnumero = parseInt(data)+1; }
			else{ var lastnumero = 1; }
			
			var newfield = "<tr id='list_"+newfieldcount+"' class='impar' onmouseover='this.className=\"over\";' onmouseout='this.className=\"impar\"'>\n";
			newfield += " <td id='td_"+newfieldcount+"' colspan='9' style='width:944px;'>";
			newfield += "Valor: <input type='text' name='valornew_"+newfieldcount+"' id='valornew_"+newfieldcount+"' value='' onkeypress='javascript:saveboletos(\""+id_cliente+"\",\""+newfieldcount+"\", event);' size='10' /> \n";
			newfield += "Vencimento: <input type='text' name='vencimentonew_"+newfieldcount+"' id='vencimentonew_"+newfieldcount+"' value='' onkeypress='javascript:saveboletos(\""+id_cliente+"\",\""+newfieldcount+"\", event);' size='12' /> \n";
			newfield += "M&ecirc;s Ref.: <input type='text' name='mesrefnew_"+newfieldcount+"' id='mesrefnew_"+newfieldcount+"' value='' onkeypress='javascript:saveboletos(\""+id_cliente+"\",\""+newfieldcount+"\", event);' size='7' /> \n";
			newfield += "N&uacute;mero: <input type='text' name='numeronew_"+newfieldcount+"' id='numeronew_"+newfieldcount+"' value='"+lastnumero+"' onkeypress='javascript:saveboletos(\""+id_cliente+"\",\""+newfieldcount+"\", event);' size='10' /> \n";
			newfield += "Obs: <input type='text' name='obsnew_"+newfieldcount+"' id='obsnew_"+newfieldcount+"' value='' size='90' /> \n";
			newfield += "<a class='button' onclick='javascript:savemboletos(\""+id_cliente+"\",\""+newfieldcount+"\");'>Ok</a> \n";
			newfield += "<a class='button' onclick=\"canceladd('"+newfieldcount+"');\">Cancel</a>\n";
			newfield += " </td>\n";
			newfield += "</tr>\n";
			
			if($("#list_empty").length){
				$("#list_empty").fadeOut().slideUp(500);
			}
			$("#list").append(newfield);
			$("#vencimentonew_"+newfieldcount).mask("99/99/9999");
			$("#mesrefnew_"+newfieldcount).mask("99/9999");
			$("#valornew_"+newfieldcount).maskMoney({symbol:"R$ ", showSymbol:false, thousands:".", decimal:",", symbolStay: true});
			$("#valornew_"+newfieldcount).focus().select();
			$(".button").button();
			
			newfieldcount++;
		});
	}
	else alert('Nenhum cliente selecionado');
};

var addscriptscategories = function(){
	var newfield = "<tr id='list_"+newfieldcount+"' class='impar' onmouseover='this.className=\"over\";' onmouseout='this.className=\"impar\"'>\n";
	newfield += " <td id='td_"+newfieldcount+"' colspan='3' style='width:944px;'>\n";
	newfield += "  <input type='text' name='namenew_"+newfieldcount+"' id='namenew_"+newfieldcount+"' value='' onkeypress='javascript:savescriptscategories(\""+newfieldcount+"\", event);' size='20' />\n";
	newfield += "  <a class='button' onclick='javascript:savemscriptscategories(\""+newfieldcount+"\");'>Ok</a>\n";
	newfield += "  <a class='button' onclick=\"canceladd('"+newfieldcount+"');\">Cancel</a>\n";
	newfield += " </td>\n";
	newfield += "</tr>\n";
	
	if($("#list_empty").length){
		$("#list_empty").fadeOut().slideUp(500);
	}
	$("#list").append(newfield);
	$('#namenew_'+newfieldcount).focus().select();
	$(".button").button();
	newfieldcount++;
};

/* EDIT */
var editboletos = function(id_cliente, id, div){
	$("#list_"+div).removeAttr('onclick');
	$.get('/admin/editboletos', { id_cliente : id_cliente, id : id, div : div }, function(savedfield){
		$("#list_"+div).html(savedfield);
		$('#valornew_'+id).focus().select();
	});
};

var editscriptscategories = function(id, div){
	$("#list_"+div).removeAttr('onclick');
	$.get('/admin/editscriptscategories', { id : id, div : div }, function(savedfield){
		$("#list_"+div).html(savedfield);
		$('#namenew_'+id).focus().select();
	});
};

/* SAVE */
var saveboletos = function(id_cliente, div, event){
	var keyNum = 0;
    if(window.event){ keyNum = event.keyCode; } // IE
    else if (event.which){ keyNum = event.which; } // Netscape/Firefox/Opera
	
	if(keyNum == '13' && id_cliente != '' && $("#valornew_"+div).val() != '' && $("#vencimentonew_"+div).val() != '' && $("#mesrefnew_"+div).val() != '' && $("#numeronew_"+div).val() != '')
	{
		var valor = $("#valornew_"+div).val();
		var vencimento = $("#vencimentonew_"+div).val();
		var mes_referencia = $("#mesrefnew_"+div).val();
		var numero = $("#numeronew_"+div).val();
		var obs = $("#obsnew_"+div).val();
		$.get('/admin/saveboletos', { id_cliente : id_cliente, valor : valor, vencimento : vencimento, mes_referencia : mes_referencia, numero : numero, obs : obs }, function(id){
			if(id == 'error'){ alert(id); }
			else{
				$.get('/admin/fetchbyidboletos', { id : id, div : div }, function(savedfield){
					$("#list_"+div).html(savedfield);
					var js = "javascript:editboletos('" + id + "', '" + div + "');";
					//this below doesnt work, so, i do in pure javascript
					//$("#list_"+data).attr("onclick", js);
					document.getElementById("td_"+div).setAttribute("onclick", js);
				});
			}
		});
	}
};

var savemboletos = function(id_cliente, div, event){
	if(id_cliente != '' && $("#valornew_"+div).val() != '' && $("#vencimentonew_"+div).val() != '' && $("#mesrefnew_"+div).val() != '' && $("#numeronew_"+div).val() != '')
	{
		var valor = $("#valornew_"+div).val();
		var vencimento = $("#vencimentonew_"+div).val();
		var mes_referencia = $("#mesrefnew_"+div).val();
		var numero = $("#numeronew_"+div).val();
		var obs = $("#obsnew_"+div).val();
		$.get('/admin/saveboletos', { id_cliente : id_cliente, valor : valor, vencimento : vencimento, mes_referencia : mes_referencia, numero : numero, obs : obs }, function(id){
			if(id == 'error'){ alert(id); }
			else{
				$.get('/admin/fetchbyidboletos', { id : id, div : div }, function(savedfield){
					$("#list_"+div).html(savedfield);
					var js = "javascript:editboletos('" + id + "', '" + div + "');";
					//this below doesnt work, so, i do in pure javascript
					//$("#list_"+data).attr("onclick", js);
					document.getElementById("td_"+div).setAttribute("onclick", js);
				});
			}
		});
	}
};

var savescriptscategories = function(div, event){
	var keyNum = 0;
    if(window.event){ keyNum = event.keyCode; } // IE
    else if (event.which){ keyNum = event.which; } // Netscape/Firefox/Opera
	
	if(keyNum == '13' && $("#namenew_"+div).val() != '')
	{
		var name = $("#namenew_"+div).val();
		$.get('/admin/savescriptscategories', { name : name }, function(id){
			if(id == 'error'){ alert(id); }
			else{
				$.get('/admin/fetchbyidscriptscategories', { id : id, div : div }, function(savedfield){
					$("#list_"+div).html(savedfield);
					var js = "javascript:editscriptscategories('" + id + "', '" + div + "');";
					//this below doesnt work, so, i do in pure javascript
					//$("#list_"+data).attr("onclick", js);
					document.getElementById("td_"+div).setAttribute("onclick", js);
				});
			}
		});
	}
};

var savemscriptscategories = function(div, event){
	if($("#namenew_"+div).val() != '')
	{
		var name = $("#namenew_"+div).val();
		$.get('/admin/scriptscategoriessave', { name : name }, function(id){
			if(id == 'error'){ alert(id); }
			else{
				$.get('/admin/fetchbyidscriptscategories', { id : id, div : div }, function(savedfield){
					$("#list_"+div).html(savedfield);
					var js = "javascript:editscriptscategories('" + id + "', '" + div + "');";
					//this below doesnt work, so, i do in pure javascript
					//$("#list_"+data).attr("onclick", js);
					document.getElementById("td_"+div).setAttribute("onclick", js);
				});
			}
		});
	}
};

/* UPDATE */
var updateboletos = function(id_cliente, id, div, event){
	var keyNum = 0;
    if(window.event){ keyNum = event.keyCode; } // IE
    else if (event.which){ keyNum = event.which; } // Netscape/Firefox/Opera
	
	if(keyNum == '13' && $("#id_cliente_"+div).val() != '' && $("#valornew_"+div).val() != '' && $("#vencimentonew_"+div).val() != '' && $("#mesrefnew_"+div).val() != '' && $("#numeronew_"+div).val() != '')
	{
		var id_cliente = $("#id_cliente_"+id).val();
		var valor = $("#valornew_"+id).val();
		var vencimento = $("#vencimentonew_"+id).val();
		var mes_referencia = $("#mesrefnew_"+id).val();
		var numero = $("#numeronew_"+id).val();
		var obs = $("#obsnew_"+id).val();
		$.get('/admin/saveboletos', { id : id, div : div, id_cliente : id_cliente, valor : valor, vencimento : vencimento, mes_referencia : mes_referencia, numero : numero, obs : obs }, function(data){
			if(data == 'error'){ alert(data); }
			else{
				$.get('/admin/fetchbyidboletos', { id : data, div : div }, function(updatedfield){
					$("#list_"+div).html(updatedfield);

					var js = "javascript:editboletos('" + id + "', '" + div + "');";
					//this below doesnt work, so, i do in pure javascript
					//$("#list_"+div).attr("onclick", js);
					document.getElementById("td_"+div).setAttribute("onclick", js);
				});
			}
		});
	}
	
	if(keyNum == '27')
	{
		$.get('/admin/fetchbyidboletos', { id : id, div : div }, function(updatedfield){
			$("#list_"+div).html(updatedfield);

			var js = "javascript:editboletos('" + id + "', '" + div + "');";
			//this below doesnt work, so, i do in pure javascript
			//$("#list_"+div).attr("onclick", js);
			document.getElementById("td_"+div).setAttribute("onclick", js);
		});
	}
};

var updatemboletos = function(id_cliente, id, div){
	if($("#id_cliente_"+div).val() != '' && $("#valornew_"+div).val() != '' && $("#vencimentonew_"+div).val() != '' && $("#mesrefnew_"+div).val() != '' && $("#numeronew_"+div).val() != '')
	{
		var id_cliente = $("#id_cliente_"+id).val();
		var valor = $("#valornew_"+id).val();
		var vencimento = $("#vencimentonew_"+id).val();
		var mes_referencia = $("#mesrefnew_"+id).val();
		var numero = $("#numeronew_"+id).val();
		var obs = $("#obsnew_"+id).val();
		$.get('/admin/saveboletos', { id : id, div : div, id_cliente : id_cliente, valor : valor, vencimento : vencimento, mes_referencia : mes_referencia, numero : numero, obs : obs }, function(data){
			if(data == 'error'){ alert(data); }
			else{
				$.get('/admin/fetchbyidboletos', { id : data, div : div }, function(updatedfield){
					$("#list_"+div).html(updatedfield);

					var js = "javascript:editboletos('" + id + "', '" + div + "');";
					//this below doesnt work, so, i do in pure javascript
					//$("#list_"+div).attr("onclick", js);
					document.getElementById("td_"+div).setAttribute("onclick", js);
				});
			}
		});
	}
};

var updatescriptscategories = function(id, div, event){
	var keyNum = 0;
    if(window.event){ keyNum = event.keyCode; } // IE
    else if (event.which){ keyNum = event.which; } // Netscape/Firefox/Opera
	
	if(keyNum == '13' && $("#namenew_"+div).val() != '')
	{
		var name = $("#namenew_"+id).val();
		$.get('/admin/savescriptscategories', { id : id, div : div, name : name }, function(data){
			if(data == 'error'){ alert(data); }
			else{
				$.get('/admin/fetchbyidscriptscategories', { id : data, div : div }, function(updatedfield){
					$("#list_"+div).html(updatedfield);

					var js = "javascript:editscriptscategories('" + id + "', '" + div + "');";
					//this below doesnt work, so, i do in pure javascript
					//$("#list_"+div).attr("onclick", js);
					document.getElementById("td_"+div).setAttribute("onclick", js);
				});
			}
		});
	}
};

var updatemscriptscategories = function(id, div){
	if($("#namenew_"+div).val() != '')
	{
		var name = $("#namenew_"+id).val();
		$.get('/admin/savescriptscategories', { id : id, div : div, name : name }, function(data){
			if(data == 'error'){ alert(data); }
			else{
				$.get('/admin/fetchbyidscriptscategories', { id : data, div : div }, function(updatedfield){
					$("#list_"+div).html(updatedfield);

					var js = "javascript:editscriptscategories('" + id + "', '" + div + "');";
					//this below doesnt work, so, i do in pure javascript
					//$("#list_"+div).attr("onclick", js);
					document.getElementById("td_"+div).setAttribute("onclick", js);
				});
			}
		});
	}
};

/* REMOVE */
var removebancos = function(id, list){
	if(confirm('Do you really want to remove this ?')){
		$.get('/admin/removebancos', { id : id }, function(data){
			if(data = '1')
			{
				$("#list_"+list).fadeOut().slideUp(500);
				setTimeout("$('#list_"+list+"').remove();",1000);
				newfieldcount--;

				if($("#list tr").length <= 2){
					if($("#list_empty").length){
						$("#list_empty").fadeIn().slideDown(500);
					}
					else{
						var newfield = "<tr id='list_empty' class='impar' onmouseover='this.className=\"over\"' onmouseout='this.className=\"impar\"'>\n";
						newfield += " <td colspan='7' style='text-align:center;'><a class='button openmodalbox' onclick='javascript:void(0);'>\n";
						newfield += "Nothing in database, click here to add<input type='hidden' name='ajaxhref' value='addbancos' /></a></td>\n";
						newfield += "</tr>\n";
						$("#list").append(newfield);
						$(".button").button();
					}
				}
			}
			else alert(data);
	    });
	}
};

var removeblog = function(id, list){
	if(confirm('Do you really want to remove this ?')){
		$.get('/admin/removeblog', { id : id }, function(data){
			if(data = '1')
			{
				$("#list_"+list).fadeOut().slideUp(500);
				setTimeout("$('#list_"+list+"').remove();",1000);
				newfieldcount--;

				if($("#list tr").length <= 2){
					if($("#list_empty").length){
						$("#list_empty").fadeIn().slideDown(500);
					}
					else{
						var newfield = "<tr id='list_empty' class='impar' onmouseover='this.className=\"over\"' onmouseout='this.className=\"impar\"'>\n";
						newfield += " <td colspan='7' style='text-align:center;'><a class='button openmodalbox' onclick='javascript:void(0);'>\n";
						newfield += "Nothing in database, click here to add<input type='hidden' name='ajaxhref' value='addblog' /></a></td>\n";
						newfield += "</tr>\n";
						$("#list").append(newfield);
						$(".button").button();
					}
				}
			}
			else alert(data);
	    });
	}
};

var removeboletos = function(id_cliente, id, list){
	if(confirm('Do you really want to remove this ?')){
		$.get('/admin/removeboletos', { id : id }, function(data){
			if(data = '1')
			{
				$("#list_"+list).fadeOut().slideUp(500);
				setTimeout("$('#list_"+list+"').remove();",1000);
				newfieldcount--;

				if($("#list tr").length <= 2){
					if($("#list_empty").length){
						$("#list_empty").fadeIn().slideDown(500);
					}
					else{
						var newfield = "<tr id='list_empty' class='impar' onmouseover='this.className=\"over\"' onmouseout='this.className=\"impar\"'>\n";
						newfield += " <td colspan='7' style='text-align:center;'><a class='button' onclick='addboletos(\""+id_cliente+"\");'>\n";
						newfield += "Nothing in database, click here to add</a></td>\n";
						newfield += "</tr>\n";
						$("#list").append(newfield);
						$(".button").button();
					}
				}
			}
			else alert(data);
	    });
	}
};

var removeclientes = function(id, list){
	if(confirm('Do you really want to remove this ?')){
		$.get('/admin/removeclientes', { id : id }, function(data){
			if(data = '1')
			{
				$("#list_"+list).fadeOut().slideUp(500);
				setTimeout("$('#list_"+list+"').remove();",1000);
				newfieldcount--;

				if($("#list tr").length <= 2){
					if($("#list_empty").length){
						$("#list_empty").fadeIn().slideDown(500);
					}
					else{
						var newfield = "<tr id='list_empty' class='impar' onmouseover='this.className=\"over\"' onmouseout='this.className=\"impar\"'>\n";
						newfield += " <td colspan='7' style='text-align:center;'><a class='button openmodalbox' onclick='javascript:void(0);'>\n";
						newfield += "Nothing in database, click here to add<input type='hidden' name='ajaxhref' value='addclientes' /></a></td>\n";
						newfield += "</tr>\n";
						$("#list").append(newfield);
						$(".button").button();
					}
				}
			}
			else alert(data);
	    });
	}
};

var removescripts = function(id, list){
	if(confirm('Do you really want to remove this ?')){
		$.get('/admin/removescripts', { id : id }, function(data){
			if(data = '1')
			{
				$("#list_"+list).fadeOut().slideUp(500);
				setTimeout("$('#list_"+list+"').remove();",1000);
				newfieldcount--;

				if($("#list tr").length <= 2){
					if($("#list_empty").length){
						$("#list_empty").fadeIn().slideDown(500);
					}
					else{
						var newfield = "<tr id='list_empty' class='impar' onmouseover='this.className=\"over\"' onmouseout='this.className=\"impar\"'>\n";
						newfield += " <td colspan='7' style='text-align:center;'><a class='button openmodalbox' onclick='javascript:void(0);'>\n";
						newfield += "Nothing in database, click here to add<input type='hidden' name='ajaxhref' value='addscripts' /></a></td>\n";
						newfield += "</tr>\n";
						$("#list").append(newfield);
						$(".button").button();
					}
				}
			}
			else alert(data);
	    });
	}
};

var removescriptscategories = function(id, list){
	if(confirm('Do you really want to remove this ?')){
		$.get('/admin/removescriptscategories', { id : id }, function(data){
			if(data = '1')
			{
				$("#list_"+list).fadeOut().slideUp(500);
				setTimeout("$('#list_"+list+"').remove();",1000);
				newfieldcount--;

				if($("#list tr").length <= 2){
					if($("#list_empty").length){
						$("#list_empty").fadeIn().slideDown(500);
					}
					else{
						var newfield = "<tr id='list_empty' class='impar' onmouseover='this.className=\"over\"' onmouseout='this.className=\"impar\"'>\n";
						newfield += " <td colspan='7' style='text-align:center;'><a class='button' onclick='addscriptscategories();'>\n";
						newfield += "Nothing in database, click here to add</a></td>\n";
						newfield += "</tr>\n";
						$("#list").append(newfield);
						$(".button").button();
					}
				}
			}
			else alert(data);
	    });
	}
};

var removeusers = function(id, list){
	if(confirm('Do you really want to remove this ?')){
		$.get('/admin/removeusers', { id : id }, function(data){
			if(data = '1')
			{
				$("#list_"+list).fadeOut().slideUp(500);
				setTimeout("$('#list_"+list+"').remove();",1000);
				newfieldcount--;

				if($("#list tr").length <= 2){
					if($("#list_empty").length){
						$("#list_empty").fadeIn().slideDown(500);
					}
					else{
						var newfield = "<tr id='list_empty' class='impar' onmouseover='this.className=\"over\"' onmouseout='this.className=\"impar\"'>\n";
						newfield += " <td colspan='7' style='text-align:center;'><a class='button openmodalbox' onclick='javascript:void(0);'>\n";
						newfield += "Nothing in database, click here to add<input type='hidden' name='ajaxhref' value='addusers' /></a></td>\n";
						newfield += "</tr>\n";
						$("#list").append(newfield);
						$(".button").button();
					}
				}
			}
			else alert(data);
	    });
	}
};

/* CANCEL */
var cancelfilter = function(){
	if($("#list_search").length){
		$("#list_search").fadeOut().slideUp(500);
		$("#list").fadeIn().slideDown(500);
		$("#list_search").remove();
	}
	
}

var canceladd = function(list){
    $("#list_"+list).fadeOut().slideUp(500);
    setTimeout("$('#list_"+list+"').remove();",1000);
    newfieldcount--;
    
    if($("#list tr").length <= 2 && $("#list_empty").length){ $("#list_empty").fadeIn().slideDown(500); }
};

var canceledit = function(id, div, pagetoreload){
	$.get('/admin/fetchbyid'+pagetoreload, { id : id, div : div }, function(updatedfield){
		$("#list_"+div).html(updatedfield);

		var js = "javascript:edit"+pagetoreload+"('" + id + "', '" + div + "');";
		//this below doesnt work, so, i do in pure javascript
		//$("#list_"+div).attr("onclick", js);
		document.getElementById("td_"+div).setAttribute("onclick", js);
	});
};

/* ONOFF */
var activeonoff = function(page, id, list){
	$.get('/admin/activeonoff'+page, { id : id, list : list }, function(data){ $('#activeonoff_' + id).html(data)});
};

var displayonoff = function(page, id, list){
	$.get('/admin/displayonoff'+page, { id : id, list : list }, function(data){ $('#displayonoff_' + id).html(data)});
};

var pagonoff = function(page, id, list){
	$.get('/admin/pagonoff'+page, { id : id, list : list }, function(data){ $('#pagonoff_' + id).html(data)});
};

/* EXPORT */
var exportpdf = function(page, id){
	jQuery.fn.modalBox({
		directCall: {
			source : '/admin/exportpdf'+page+'?id='+id
		}
	});
}

var exportpdfaction = function(page, tipo){
	var banco = '';
	var form = $("#form_"+page+"pdf");

	$("#tipo").val(tipo);
	$("#id_banco option:selected").each(function(){ banco = $(this).val(); });

	if(banco == "")
	{
		alert("Por favor, escolha o banco");
		$("#id_banco").focus().select();
		return false;
	}
	else
	{
		if(tipo == '1'){ alert('esse é do tipo 1, faremos via ajax'); } // tipo 1 = gerar pdf
		else{ form.attr('target', '_blank'); form.submit(); } // aqui só mostra
	}
}

/* FILTER */
var filter = function(page, event){
	if($("#ftitle").length){
		if($("#ftitle").val() != 'filter by title' && $("#ftitle").val() != ''){ var title = $("#ftitle").val(); }
	}
	if($("#fname").length){
		if($("#fname").val() != 'filter by name' && $("#fname").val() != ''){ var name = $("#fname").val(); }
	}
	if($("#fnome").length){
		if($("#fnome").val() != 'filter by nome' && $("#fnome").val() != ''){ var nome = $("#fnome").val(); }
	}
	if($("#fcategory").length){
		if($("#fcategory").val() != 'filter by category' && $("#fcategory").val() != ''){ var category = $("#fcategory").val(); }
	}
	if($("#fuser").length){
		if($("#fuser").val() != 'filter by user' && $("#fuser").val() != ''){ var user = $("#fuser").val(); }
	}
	if($("#femail").length){
		if($("#femail").val() != 'filter by email' && $("#femail").val() != ''){ var email = $("#femail").val(); }
	}
	if($("#fcpfcnpj").length){
		if($("#fcpfcnpj").val() != 'filter by cpfcnpj' && $("#fcpfcnpj").val() != ''){ var cpfcnpj = $("#fcpfcnpj").val(); }
	}

	var keyNum = 0;
    if(window.event){ keyNum = event.keyCode; } // IE
    else if(event.which){ keyNum = event.which; } // Netscape/Firefox/Opera
	
	if(keyNum == '13')
	{
		filteron++;
		loading();
		
		$.get('/admin/list'+page, { title : title, name : name, nome : nome, category : category, user : user, email : email, cpfcnpj : cpfcnpj }, function(data){
			$("#maincontent").html(data);
			$('.button').button();
			loadfilters();
			filteron--;
		});
	}
}

var filterm = function(page){
	if($("#ftitle").length){
		if($("#ftitle").val() != 'filter by title' && $("#ftitle").val() != ''){ var title = $("#ftitle").val(); }
	}
	if($("#fname").length){
		if($("#fname").val() != 'filter by name' && $("#fname").val() != ''){ var name = $("#fname").val(); }
	}
	if($("#fnome").length){
		if($("#fnome").val() != 'filter by nome' && $("#fnome").val() != ''){ var nome = $("#fnome").val(); }
	}
	if($("#fcategory").length){
		if($("#fcategory").val() != 'filter by category' && $("#fcategory").val() != ''){ var category = $("#fcategory").val(); }
	}
	if($("#fuser").length){
		if($("#fuser").val() != 'filter by user' && $("#fuser").val() != ''){ var user = $("#fuser").val(); }
	}
	if($("#femail").length){
		if($("#femail").val() != 'filter by email' && $("#femail").val() != ''){ var email = $("#femail").val(); }
	}
	if($("#fcpfcnpj").length){
		if($("#fcpfcnpj").val() != 'filter by cpfcnpj' && $("#fcpfcnpj").val() != ''){ var cpfcnpj = $("#fcpfcnpj").val(); }
	}

	filteron++;
	loading();
	
	$.get('/admin/list'+page, { title : title, name : name, nome : nome, category : category, user : user, email : email, cpfcnpj : cpfcnpj }, function(data){
		$("#maincontent").html(data);
		$('.button').button();
		loadfilters();
		filteron--;
	});
}

var loadfilters = function(){
	if($("#ftitle").length){
		$("#ftitle").attr('style', 'color:#CCC;');
		$("#ftitle").val('filter by title');
		
		$("#ftitle").click(function(){
			if($("#ftitle").val() == 'filter by title'){ $("#ftitle").attr('style', 'color:#000;'); $("#ftitle").val(''); }
			else{ $("#ftitle").attr('style', 'color:#000;'); }
		});
		$("#ftitle").blur(function(){
			if($("#ftitle").val() == ''){ $("#ftitle").val('filter by title'); $("#ftitle").attr('style', 'color:#CCC;'); }
			else if($("#ftitle").val() == 'filter by title'){ $("#ftitle").attr('style', 'color:#CCC;'); }
			else{ $("#ftitle").attr('style', 'color:#000;'); }
		});
	}

	if($("#fname").length){
		$("#fname").attr('style', 'color:#CCC;');
		$("#fname").val('filter by name');
		
		$("#fname").click(function(){
			if($("#fname").val() == 'filter by name'){ $("#fname").attr('style', 'color:#000;'); $("#fname").val(''); }
			else{ $("#fname").attr('style', 'color:#000;'); }
		});
		$("#fname").blur(function(){
			if($("#fname").val() == ''){ $("#fname").val('filter by name'); $("#fname").attr('style', 'color:#CCC;'); }
			else if($("#fname").val() == 'filter by name'){ $("#fname").attr('style', 'color:#CCC;'); }
			else{ $("#fname").attr('style', 'color:#000;'); }
		});
	}

	if($("#fnome").length){
		$("#fnome").attr('style', 'color:#CCC;');
		$("#fnome").val('filter by nome');
		
		$("#fnome").click(function(){
			if($("#fnome").val() == 'filter by nome'){ $("#fnome").attr('style', 'color:#000;'); $("#fnome").val(''); }
			else{ $("#fnome").attr('style', 'color:#000;'); }
		});
		$("#fnome").blur(function(){
			if($("#fnome").val() == ''){ $("#fnome").val('filter by nome'); $("#fnome").attr('style', 'color:#CCC;'); }
			else if($("#fnome").val() == 'filter by nome'){ $("#fnome").attr('style', 'color:#CCC;'); }
			else{ $("#fnome").attr('style', 'color:#000;'); }
		});
	}

	if($("#fcategory").length){
		$("#fcategory").attr('style', 'color:#CCC;');
		$("#fcategory").val('filter by category');
		
		$("#fcategory").click(function(){
			if($("#fcategory").val() == 'filter by category'){ $("#fcategory").attr('style', 'color:#000;'); $("#fcategory").val(''); }
			else{ $("#fcategory").attr('style', 'color:#000;'); }
		});
		$("#fcategory").blur(function(){
			if($("#fcategory").val() == ''){ $("#fcategory").val('filter by category'); $("#fcategory").attr('style', 'color:#CCC;'); }
			else if($("#fcategory").val() == 'filter by category'){ $("#fcategory").attr('style', 'color:#CCC;'); }
			else{ $("#fcategory").attr('style', 'color:#000;'); }
		});
	}

	if($("#fuser").length){
		$("#fuser").attr('style', 'color:#CCC;');
		$("#fuser").val('filter by user');
		
		$("#fuser").click(function(){
			if($("#fuser").val() == 'filter by user'){ $("#fuser").attr('style', 'color:#000;'); $("#fuser").val(''); }
			else{ $("#fuser").attr('style', 'color:#000;'); }
		});
		$("#fuser").blur(function(){
			if($("#fuser").val() == ''){ $("#fuser").val('filter by user'); $("#fuser").attr('style', 'color:#CCC;'); }
			else if($("#fuser").val() == 'filter by user'){ $("#fuser").attr('style', 'color:#CCC;'); }
			else{ $("#fuser").attr('style', 'color:#000;'); }
		});
	}

	if($("#femail").length){
		$("#femail").attr('style', 'color:#CCC;');
		$("#femail").val('filter by email');
		
		$("#femail").click(function(){
			if($("#femail").val() == 'filter by email'){ $("#femail").attr('style', 'color:#000;'); $("#femail").val(''); }
			else{ $("#femail").attr('style', 'color:#000;'); }
		});
		$("#femail").blur(function(){
			if($("#femail").val() == ''){ $("#femail").val('filter by email'); $("#femail").attr('style', 'color:#CCC;'); }
			else if($("#femail").val() == 'filter by email'){ $("#femail").attr('style', 'color:#CCC;'); }
			else{ $("#femail").attr('style', 'color:#000;'); }
		});
	}

	if($("#fcpfcnpj").length){
		$("#fcpfcnpj").attr('style', 'color:#CCC;');
		$("#fcpfcnpj").val('filter by cpfcnpj');
		
		$("#fcpfcnpj").click(function(){
			if($("#fcpfcnpj").val() == 'filter by cpfcnpj'){ $("#fcpfcnpj").attr('style', 'color:#000;'); $("#fcpfcnpj").val(''); }
			else{ $("#fcpfcnpj").attr('style', 'color:#000;'); }
		});
		$("#fcpfcnpj").blur(function(){
			if($("#fcpfcnpj").val() == ''){ $("#fcpfcnpj").val('filter by cpfcnpj'); $("#fcpfcnpj").attr('style', 'color:#CCC;'); }
			else if($("#fcpfcnpj").val() == 'filter by cpfcnpj'){ $("#fcpfcnpj").attr('style', 'color:#CCC;'); }
			else{ $("#fcpfcnpj").attr('style', 'color:#000;'); }
		});
	}
};

var loadtools = function(){
	if($("#name").length && $("#name").val() != '')
	{
		var varString = $("#name").val();
		var stringAcentos   = 'áàâãäéèêëíìîïóòôõöúùûüçñÁÀÂÃÄÉÈÊËÍÌÎÏÓÒÔÕÖÚÙÛÜÇÑ';
		var stringSemAcento = 'aaaaaeeeeiiiiooooouuuucnAAAAAEEEEIIIIOOOOOUUUUCN';
		var varRes = "";

		for(var i = 0; i < varString.length; i++){
			if(varString[i] == stringAcentos.substring(i,1)){
				varRes += stringSemAcento.substring(i,1);
			}
			else{ varRes += varString[i]; }
		}
		
		varRes = varRes.replace(/ /g,"-")
		.replace(/(\-)\1+/gi,"-")
		//.replace(/[^0-9a-zA-Z]/g,"-")
		.toLowerCase();
		$("#name").val(varRes);
	}
	
	if($("#url").length && $("#url").val() != '')
	{
		var varString = $("#url").val();
		var stringAcentos   = 'áàâãäéèêëíìîïóòôõöúùûüçñÁÀÂÃÄÉÈÊËÍÌÎÏÓÒÔÕÖÚÙÛÜÇÑ';
		var stringSemAcento = 'aaaaaeeeeiiiiooooouuuucnAAAAAEEEEIIIIOOOOOUUUUCN';
		var varRes = "";

		for(var i = 0; i < varString.length; i++){
			if(varString[i] == stringAcentos.substring(i,1)){
				varRes += stringSemAcento.substring(i,1);
			}
			else{ varRes += varString[i]; }
		}
		
		varRes = varRes.replace(/ /g,"-")
		.replace(/(\-)\1+/gi,"-")
		//.replace(/[^0-9a-zA-Z]/g,"-")
		.toLowerCase();
		$("#url").val(varRes);
	}
	
	if($("#meta_keywords").length && $("#meta_keywords").val() != '')
	{
		var varString = $("#meta_keywords").val();
		varRes = varString.replace(/ /g,",")
		.replace(/(,)\1+/gi,",")
		.toLowerCase();
		$("#meta_keywords").val(varRes);
	}	
	//Áreas  de  atuação  é  preso após vítima
	
	if($("#valor").length)
	{
		$(document).ready(function(){
			$("#valor").maskMoney({symbol:'R$ ', showSymbol:false, thousands:'.', decimal:',', symbolStay: true});
		});
	}	
	
	if($("#vencimento").length)
	{
		$(document).ready(function(){
			$("#vencimento").mask('99/99/9999');
		});
	}
	
};

var formatblogfields = function(){
	if($("#title").val() != '')
	{
		var title = $("#title").val();
		$("#url").val(title);
		$("#meta_keywords").val(title);
		$("#meta_description").val(title);
		loadtools();
		$("#meta_description").focus();
	}
};

var formatscriptfields = function(){
	if($("#title").val() != '')
	{
		var title = $("#title").val();
		$("#name").val(title);
		$("#meta_keywords").val(title);
		$("#meta_description").val(title);
		loadtools();
		$("#meta_description").focus();
	}
};

var imagetemplate = function(field){
	var template = "<div style=\"text-align:center;\">\n";
	template += "<img src=\"\" style=\"cursor:pointer;width:300px;\" onclick=\"showImage('');\" /><br />\n";
	template += "</div>\n";
	//$("#"+field).val($("#"+field).val()+template);
	alert(template);
};

var ptemplate = function(field){
	var template = "<p></p>\n";
	//$("#"+field).val($("#"+field).val()+template);
};

var formataCampos = function(camp, Mascara){
	var campo = document.getElementById(camp);
	var boleanoMascara;
	exp = /\-|\.|\/|\(|\)| /g
	campoSoNumeros = campo.value.toString().replace(exp, "");
	var posicaoCampo = 0;
	var NovoValorCampo = "";
	var TamanhoMascara = campoSoNumeros.length;;
	for (i = 0; i <= TamanhoMascara; i++)
	{
		boleanoMascara = ((Mascara.charAt(i) == "-") || (Mascara.charAt(i) == ".") || (Mascara.charAt(i) == "/"))
		boleanoMascara = boleanoMascara || ((Mascara.charAt(i) == "(") || (Mascara.charAt(i) == ")") || (Mascara.charAt(i) == " "))
		if(boleanoMascara)
		{
			NovoValorCampo += Mascara.charAt(i);
			TamanhoMascara++;
		}
		else
		{
			NovoValorCampo += campoSoNumeros.charAt(posicaoCampo);
			posicaoCampo++;
		}
	}
	campo.value = NovoValorCampo;
	return true;
}

var mascaracpf = function(campo){
	if(document.getElementById(campo).value.length > 14){ return mascaracnpj(campo); }
	document.getElementById(campo+'-label').innerHTML = '<label class="required" for="cpfcnpj">* <span style="font-size:13px;">CPF</span>/Cnpj:</label>';
	return formataCampos(campo, '000.000.000-00');
}

var mascaracnpj = function(campo){
	document.getElementById(campo+'-label').innerHTML = '<label class="required" for="cpfcnpj">* CPF/<span style="font-size:13px;">Cnpj</span>:</label>'
    return formataCampos(campo, '00.000.000/0000-00');
}
