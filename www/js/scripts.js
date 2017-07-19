<!--
	$(document).ready(function(){
		$("#submitbutton").button();
		$(".button").button();
	});
//-->

var showImage = function(path){
	if($('#divimageloaded').length){ $('#divimageloaded').remove(); }
	var divimageloaded = $(document.createElement('div'))
	.attr('style', 'display:none;text-align:center;')
	.attr('id', 'divimageloaded');
	divimageloaded.appendTo('#layout');
	
	var imageloaded = $(document.createElement('img'))
	.attr('id', 'imageloaded')
	.attr('src', path)
	.attr('style', 'text-align:center;')
	.appendTo('#divimageloaded');
	
	var imagelayer = new Image();
	imagelayer.src = path;
	
	if(imagelayer.complete) {
		jQuery(document).ready(function(){
			jQuery.fn.modalBox({
				setWidthOfModalLayer: (imagelayer.width+100),
				directCall: { 
					element : '#divimageloaded'
				}
			});
		});
	}
};

var upperc = function(x)
{
	var y=document.getElementById(x).value
	document.getElementById(x).value=y.toUpperCase()
}

var isvalidEmail = function(e)
{
	var email = document.getElementById(e).value;
	var sPatt = /^\w+$/;
	var mPatt = /^\w+$/;
	var ePatt1 = /^\w+@\w+(\.\w{2,3})$/;
	var ePatt2 = /^\w+@\w+(\.\w{2,3})(\.\w{2,3})$/;

	if((ePatt1.test(email) || ePatt2.test(email)) != true)
	{
		alert('A valid email address is required');
	}
}

var textCounter = function(field, countfield, maxlimit)
{
	if(field.value.length > maxlimit) // if too long...trim it!
		field.value = field.value.substring(0, maxlimit);
		// otherwise, update 'characters left' counter
	else countfield.value = maxlimit - field.value.length;
}

var greetings = function()
{
	today = new Date();
	if(today.getMinutes() < 10){ pad = "0"; } 
	else{ pad = ""; document.write ; }

	var hour = today.getHours();
	var minutes = today.getMinutes();

	if(today.getDate() < 10){ var day = "0"+today.getDate(); }
	else{ var day = today.getDate(); }

	if(today.getMonth() < 10){ var month = "0"+(today.getMonth()+1); }
	else{ var month = (today.getMonth()+1); }

	var year = today.getFullYear();

	document.write("<h3>"+day+"/"+month+"/"+year+" "+hour+":"+minutes+" - ");

	if((hour >=06) && (hour <=11)){ document.write("Bom dia</h3>"); }
	if((hour >=12) && (hour <=17)){ document.write("Boa Tarde</h3>"); } 
	if((hour >=18) && (hour <=23)){ document.write("Boa Noite</h3>"); } 
	if((hour >=00) && (hour <=05)){ document.write("Bom Dia</h3>"); }

	document.write("</h3>");
};

var saveContact = function(){
	var erro = 0;
	var msg = "";

	if($("#name").val() == '')
	{
		erro++;
		msg += "<b>Digite seu nome</b><br />";
	}

	if($("#email").val() == '')
	{
		erro++;
		msg += "<b>Digite seu email</b><br />";
	}

	if($("#message").val() == '')
	{
		erro++;
		msg += "<b>Digite sua mensagem</b><br /><br />";
	}

	if(erro > 0)
	{
		$("#errormsg").html("<h1 style='color:#000080;font-size:12px;text-align:center;'>Os campos com * são de preenchimento obrigatório, faltam preencher (" + erro + ") deles</h1> <br /> " + msg + " <br /> ");
		$("#errormsg").attr('title','<h1 style="color:#FF0000;font-size:11px;text-align:center;">Por favor corriga os erros a seguir:</h1>');
		$("#errormsg").dialog( { width:400 } );
	}
	else
	{
		var loadingImage = "<img src='/img/loading.gif' style='border:0;margin:10px 0 0 0;' />";
		$("#tdbuttons").html($("#tdbuttons").html() + loadingImage);
		$("#tdbuttons").removeAttr('onclick');
		
		$("#form_contact").submit();
	}
};

var _lanim_el;
var _lanim_frame;
var _lanim_frames;
var _lanim_frame_size;

function _onload()
{
	loff();
}

function _onunload()
{
	lon();
}

function _lanim_start(frames, frame_size)
{
	_lanim_el = document.getElementById('loaderAnimation');
	if (!_lanim_el) return;
	_lanim_frame = 0;
	_lanim_frames = frames;
	_lanim_frame_size = frame_size;
	setInterval('_lanim_proc()', 2000 / _lanim_frames)
}

function _lanim_proc()
{
	el = document.getElementById('loaderContainer');
	if (!el || el.style.display == 'none') return;
	_lanim_frame++;
	if (_lanim_frame >= _lanim_frames) _lanim_frame = 0;
	_lanim_el.style.backgroundPosition = '0px -' + _lanim_frame_size * _lanim_frame + 'px';
}

function lon(target)
{
	try
	{
		if (parent.visibilityToolbar) parent.visibilityToolbar.set_display("standbyDisplayNoControls");
	}
	catch (e)
	{
	}
	try
	{
		if (!target) target = this;
		if (!target._lon_disabled_arr) target._lon_disabled_arr = new Array();
		else if (target._lon_disabled_arr.length > 0) return true;
		lresize(target);
		target.document.getElementById("loaderContainer").style.display = "";
		_lon(target);
		var select_arr = target.document.getElementsByTagName("select");
		for (var i = 0; i < select_arr.length; i++)
		{
			if (select_arr[i].disabled) continue;
			select_arr[i].disabled = true;
			_lon_disabled_arr.pop(select_arr[i]);
			var clone = target.document.createElement("input");
			clone.type = "hidden";
			clone.name = select_arr[i].name;
			var values = new Array();
			for (var n = 0; n < select_arr[i].length; n++)
			{
				if (select_arr[i][n].selected)
				{
					values[values.length] = select_arr[i][n].value;
				}
			}
			clone.value = values.join(",");
			select_arr[i].parentNode.insertBefore(clone, select_arr[i]);
		}
	}
	catch (e)
	{
		return false;
	}
	return true;
}

function _lon(target)
{
	try
	{
		if (!target) target = this;
		oLoader = target.document.getElementById("loader");
		oBody = target.document.getElementsByTagName("body")[0];
		if (oLoader || oBody)
		{
			zIndex = oLoader.style.zIndex;
			if (zIndex == "") zIndex = oLoader.currentStyle.zIndex;
			zIndex = parseInt(zIndex);
			if (!isNaN(zIndex) && zIndex > 1)
			{
				sHiderID = oLoader.id + "SubLayer";
				oIframe = target.document.getElementById(sHiderID);
				if (!oIframe)
				{
					oBody.insertAdjacentHTML("afterBegin", '<iframe src="" id="' + sHiderID + '" scroll="no" frameborder="0" style="position:absolute;visibility:hidden;border:0;top:0;left;0;width:0;height:0;background-color:#ccc;z-index:' + (zIndex - 1) + ';"></iframe>');
					oIframe = target.document.getElementById(sHiderID);
				}
				oIframe.style.width = oLoader.offsetWidth - 10 + "px";
				oIframe.style.height = oLoader.offsetHeight + "px";
				oIframe.style.left = oLoader.offsetLeft + "px";
				oIframe.style.top = oLoader.offsetTop + "px";
				oIframe.style.visibility = "visible";
			}
		}
	}
	catch (e)
	{
		return false;
	}
	return true;
}

function _loff(target)
{
	try
	{
		if (!target) target = this;
		target.document.getElementById("loaderSubLayer").style.display = "none";
	}
	catch (e)
	{
		return false;
	}
	return true;
}

function loff(target)
{
	try
	{
		if (parent.visibilityToolbar)
		{
			parent.visibilityToolbar.set_display(visibilityCount ? "standbyDisplay" : "standbyDisplayNoControls");
		}
	}
	catch (e)
	{
	}
	try
	{
		if (!target) target = this;
		_loff(target);
		target.document.getElementById("loaderContainer").style.display = "none";
		if (target._lon_disabled_arr)
		{
			while (_lon_disabled_arr.length > 0)
			{
				var select = _lon_disabled_arr.push();
				select.disabled = false;
				var clones_arr = target.document.getElementsByName(select.name);
				for (var n = 0; n < clones_arr.length; n++)
				{
					if ("hidden" == clones_arr[n].type) clones_arr[n].parent.removeChild(clones_arr[n]);
				}
			}
		}
	}
	catch (e)
	{
		return false;
	}
	return true;
}

function lresize(target)
{
	try
	{
		if (!target) target = this;
		el = target.document.getElementById("loaderContainer");
		if (target.document.body.scrollHeight > target.document.body.offsetHeight)
		{
			el.style.width = target.document.body.scrollWidth - 10;
			el.style.height = target.document.body.scrollHeight;
		}
		else
		{
			el.style.width = target.document.body.offsetWidth - 10;
			el.style.height = target.document.body.offsetHeight;
		}
	}
	catch (e)
	{
	}
}

function botao(b)
{
	var divs = document.getElementsByTagName("div");
	for (var i = 0; i < divs.length; i++)
	{
		if (menuHasClass(divs[i], "bl"))
		{
			divs[i].style.display = 'none';
		}
		if (divs[i].className == 'bl_'+b)
		{
			divs[i].style.display = 'block';
		}
	}
}
