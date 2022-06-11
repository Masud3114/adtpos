function xbtn_link(xpath, pg_lnk, sxcod) {
	if (sxcod) {
		sx_cod = "&&sx_code=" + sxcod;
	} else {
		sx_cod = "";
	}
	window.location.assign(xpath + "?pg=" + pg_lnk + sx_cod)
}

function xbtn_linkd(xpath, pg_lnk, sxcod, sxcodin) {
	window.location.assign(xpath + "?pg=" + pg_lnk + "&&sx_coded=" + sxcod + "&&sx_code=" + sxcodin)
}

function x_pikitmd(xpath, xpage, xitem_cod, xitem_codin, lst_pag, lst_pagin) {
	if (xitem_cod) {
		xitem_cod = "&&sx_coded=" + xitem_cod;
	} else {
		xitem_cod = "";
	}
	if (xitem_codin) {
		xitem_codin = "&&sx_code=" + xitem_codin;
	} else {
		xitem_codin = "";
	}
	if (lst_pag) {
		lst_pag = "&&sx_pag=" + lst_pag;
	} else {
		lst_pag = "";
	}
	if (lst_pagin) {
		lst_pagin = "&&sx_pagdin=" + lst_pagin;
	} else {
		lst_pagin = "";
	}
	sx_cod = xitem_cod + xitem_codin + lst_pagin;
	window.location.assign(xpath + "?pg=" + xpage + sx_cod)
}

function x_pikitmdin(xpath, xpage, xitem_cod, xitem_codin, lst_pag) {
	window.location.assign(xpath + "?pg=" + xpage + "&&sx_coded=" + xitem_cod + "&&sx_code=" + xitem_codin + "&&sx_pagdin=" + lst_pag)
}

function nx_pgdin(xpath, xpage, sx_coded, lst_pag) {
	window.location.assign(xpath + "?pg=" + xpage + "&&sx_coded=" + sx_coded + "&&sx_pagdin=" + lst_pag)
}

function newDoc(xpath, x_code, xnum, xdescrip, xrate, xcolor, xunit, xrmrk, xac_sts, op_sts, op_msg) {
	window.location.assign(xpath + "?x_code=" + x_code + "&&xnum=" + xnum + "&&xdescrip=" + xdescrip + "&&xrate=" + xrate + "&&xcolor=" + xcolor + "&& xunit=" + xunit + "&&xrmrk=" + xrmrk + "&& op_sts=" + op_sts + "&& xac_sts=" + xac_sts + "&& op_msg=" + op_msg)
}

function x_trucon(xpath, op_sts) {
	window.location.assign(xpath + "?pg=" + op_sts)
}

function x_pikitm(xpath, xpage, xitem_code, lst_pag) {
	if (xitem_code && lst_pag) {
		sxcod = "&&sx_code=" + xitem_code + "&&sx_pag=" + lst_pag;
	} else if (xitem_code && !lst_pag) {
		sxcod = "&&sx_code=" + xitem_code;
	} else if (!xitem_code && lst_pag) {
		sxcod = "&&sx_pag=" + lst_pag;
	} else {
		xitem_code = "";
	}

	window.location.assign(xpath + "?pg=" + xpage + sxcod)
}

function nx_pg(xpath, xpage, lst_pag) {
	window.location.assign(xpath + "?pg=" + xpage + "&&sx_pag=" + lst_pag)
}

function hidnxtbtn(xpgl, xcrntpg) {
	if (xpgl == xcrntpg) {
		document.getElementById('nxtbtn').style.visibility = 'hidden';
	}
}

function displayResult() {
	var x = document.getElementById("nume").value;
	if (isNaN(x)) {
		var rslt = (x + "  this value is not valide");
		document.getElementById("rslt").innerHTML = rslt;
	}
}
// Loding 
function load_pag() {
	if (document.readyState === "complete") {
		document.getElementById("loading").style.visibility = "hidden";
	} else {
		document.getElementById("loading").style.visibility = "visible";
	}

}

function wtmsg() {
	var butt = document.getElementById("wtmsg");
	butt.innerHTML = "<div id = 'loading'></br></br></br></br></br></br></br></br></br></br></br>Loading</br>Please Wait.....</div>";
	return true;
}

//Loding End 
//SARCH BUTTON
function srchbtn(xpath, pg_lnk, sx_fld, sxcodd, srchfld) {
	var srchval = document.getElementById(srchfld).value;
	window.location.assign(xpath + "?pg=" + pg_lnk + "&&" + sx_fld + "=" + sxcodd + "&&sx_srsval=" + srchval)
}

//End
//Live img preview 

function fieldevent(msg) {
	alert("Test Ok" + msg);
}
//End img preview
// Start AJAX Relational Field view
function relation_fld(str, post_pg, disp_id) {
	var xmlhttp;
	if (str == "") {
		if (disp_id) {
			document.getElementById(disp_id).innerHTML = "";
			return;
		} else {
			document.getElementById("e_joindt").innerHTML = "";
			return;
		}
	}
	if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp = new XMLHttpRequest();
	} else { // code for IE6, IE5
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			if (disp_id) {
				document.getElementById(disp_id).innerHTML = xmlhttp.responseText;
			} else {
				document.getElementById("e_joindt").innerHTML = xmlhttp.responseText;
			}
		}
	}

	if (!post_pg) {
		xmlhttp.open("GET", "_controller/_dlev_aply.php?qfld=" + str, true);
	} else {
		xmlhttp.open("GET", post_pg + ".php?qfld=" + str, true);
	}
	xmlhttp.send();
}

function ajax_frm_sbmt(str) {
	$.ajax({
		type: "POST",
		url: "contact.php",
		data: $("#contactform").serialize(),
		beforeSend: function() {
			$('#result').html('<img src="loading.gif" />');
		},
		success: function(data) {
			$('#result').html(data);
		}

	})
	var xmlhttp;
	if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp = new XMLHttpRequest();
	} else { // code for IE6, IE5
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			document.getElementById("act_msg").innerHTML = xmlhttp.responseText;
		}
	}
	xmlhttp.open("POST", "_controller/_dimpt_atndnc.php", true);
	xmlhttp.send();
}
//EndAJAX Relational Field view
