"use strict";
var adtDataTableScourceCall = function() {
	var adtDataTable = function(selector) {
		var table = $(selector);
		table.DataTable({
			processing: true,
			serverSide: true,
			order:  table.attr('sort')?[[ table.attr('sort'), table.attr('sort_type') ]]:[[ 0, "asc" ]],
			destroy: true,
			ajax: {
				url: "index.php",
				type: "POST",
				data:function (data) {
					data.dt_table = table.attr('data');
					data.dt_prams = table.attr('prams');
				}
			},
		});
	};
	return {
		init: function(elm='.dataTable') {
			adtDataTable(elm);
		},
	};
}();

jQuery(document).ready(function() {
	adtDataTableScourceCall.init();
	adtDataTableScourceCall.init('.dataTableSub');
	$('table').delegate('.print_button','click',function(){
		var targetRpt=$(this).attr('target');
		var prName=$(this).attr('pram');
		var trID=$(this).attr('data_val');
		window.open('index.php?rpt='+targetRpt+'&&'+prName+'='+trID,'POPUPW','width=1000,height=800');
	});
	$('table').delegate('.link_button','click',function(){
		var targetPage=$(this).attr('target');
		var prName=$(this).attr('pram');
		var trID=$(this).attr('data_val');
		//parent.location='?pg=atndnc';
		parent.location='?pg='+targetPage+'&&'+prName+'='+trID;
	});
});