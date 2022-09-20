$(function () {
	//Select2Select
	$('.select2auto').select2({
		theme: "bootstrap",
		//theme: "material",
		minimumInputLength: 1,
		//tags: true,
		placeholder: 'Type / Search / Select ',
		ajax: {
			url: 'index.php',
			dataType: 'json',
			type: 'POST',
			delay: 250,
			data: function(params) {
				return {
					field_num: $(this).attr("name"), //search term
					field_val: params.term, //search term
					page: params.page, // page
					page_limit: 10, // page size
					ppg: $(this).attr("ppg"),
				};
			},
			processResults: function(data, page) {
				return {
					results: data.results
				};
			}

		}
	});
	$(".select2-selection__arrow").addClass("material-icons").html("arrow_drop_down");
	
	//Image Live Upload view//
	Test = {
		UpdatePreview: function(obj, rndid) {
			// if IE < 10 doesn't support FileReader
			var rndrid = rndid;
			//alert (rndrid);
			if (!window.FileReader) {
				// don't know how to proceed to assign src to image tag
			} else {
				var reader = new FileReader();
				var target = null;

				reader.onload = function(e) {
					target = e.target || e.srcElement;
					$(rndrid).attr("src", target.result);
				};
				reader.readAsDataURL(obj.files[0]);
			}
		}
	};
	//Dynamic From Show by class//
	$(".show_from").click(function(e) {
		var data_render_in=$(this).attr("data_disp");
		if(data_render_in){
			var render_id="#"+data_render_in;
		}else{
			var render_id='#display_div';
		}
		target_form=$(this).parents("form:first");
		$.ajax({
			type: 'POST',
			url: 'index.php',
			data: target_form.serialize() + '&action=' + $(this).attr("name"),
			dataType: 'json',
			beforeSend: function() {
				$('.page-loader-wrapper').fadeIn();
			},
			success: function(data) {
				$('.page-loader-wrapper').fadeOut(300, function(){
					if(data.disp_data){
						$(render_id).html(data.disp_data);
					}
					if(data.massage_type==='success'){
						var title_txt = 'Done!';
					}else{
						var title_txt = 'Opps!';
					}
					if(data.massage){
						swal({
							title:title_txt,
							text: data.massage,
							type: data.massage_type,
							timer: 3000,
							showConfirmButton: true
						});
					}
				});
			}
		});
	});
	//Dynamic From Show//
	//Test //
	$("#display_data").delegate(".receive_qty","keyup",function(){
		var pid = $(this).val();
		var tr = $(this).parent().parent();
		var data_form = $(this).parent().parent();
		alert(pid)
		//$(".overlay").show();
		//$.ajax({
		//	url : DOMAIN+"/includes/process.php",
		//	method : "POST",
		//	dataType : "json",
		//	data : {getPriceAndQty:1,id:pid},
		//	success : function(data){
		//		tr.find(".tqty").val(data["product_stock"]);
		//		tr.find(".pro_name").val(data["product_name"]);
		//		tr.find(".qty").val(1);
		//		tr.find(".price").val(data["product_price"]);
		//		tr.find(".amt").html( tr.find(".qty").val() * tr.find(".price").val() );
		//		calculate(0,0);
		//	}
		//})
	});
	//Test//
	//Modal_load//
	$(".modal_load").click(function() {
		var control=$(this).attr("data_prm");
		//$(xpost_frm).serialize();
		$.ajax({
			type: 'POST',
			url: 'index.php',
			data: post_data,
			dataType: 'json',
			beforeSend: function() {
				$('#' + resp_id).html('waiting......');
			},
			success: function(data) {
				$('#' + resp_id).html(data.txtmsg);
				if (resp_id2) {
					$('#' + resp_id2).html(data.style_info);
				}
				if (is_modal) {
					$('#' + is_modal).modal('toggle');
				}
			}
		});
	});
	//END Modal_load//
	//delete button //
	$(".delete_data").click(function() {
		var row_id=$(this).closest('tr').attr('id');
		var row_span=$(this).closest('tr').attr('clspan_no');
		var prv_html=$("#"+row_id).html();
		var new_html='<td colspan="'+row_span+'"><div class="alert bg-orange" role="alert">Please waite...........</div></td>';
		//alert(prv_html);
		var target=$(this).attr('target');
		var p_name=$(this).attr('p_name');
		var p_value=$(this).attr('value');
		var post_data="ppg=" + target + "&&"+p_name+"=" + p_value;
		//alert(post_data);
		$.ajax({
			type: 'POST',
			url: 'index.php',
			data: post_data,
			dataType: 'json',
			beforeSend: function() {
				$("#"+row_id).html(new_html);
			},
			success: function(data) {
				if(data.sts==1){
					$('#' + row_id).html('<td colspan="'+row_span+'"><div class="alert bg-green" role="alert">'+data.msg+'</div></td>');
					$('#' + row_id).delay(1000).fadeOut(500);
				}else{
					$('#' + row_id).delay(5000).html('<td colspan="'+row_span+'"><div class="alert bg-red" role="alert">'+data.msg+'</div></td>');
				}
			}
		});
		
	});
	$(".edit_data").click(function() {
		var target_modal=$(this).attr('target_modal');
		var modal_body=$('#'+target_modal).find('.modal-body');
		var modal_html='<div align="center" ><div class="preloader pl-size-xl"><div class="spinner-layer"><div class="circle-clipper left"><div class="circle"></div></div><div class="circle-clipper right"><div class="circle"></div></div></div></div><p>Please wait...</p></div>';
		//alert(prv_html);
		var target=$(this).attr('target');
		var p_name=$(this).attr('p_name');
		var p_value=$(this).attr('value');
		var post_data="ppg=" + target + "&&"+p_name+"=" + p_value;
		//alert(post_data);
		$.ajax({
			type: 'POST',
			url: 'index.php',
			data: post_data,
			dataType: 'json',
			beforeSend: function() {
				$(modal_body).html(modal_html);
				$('#'+target_modal).modal('toggle');
			},
			success: function(data) {
				if(data.sts==1){
					$(modal_body).html(data.msg);
				}else{
					$(modal_body).html('Somethings is wrong!');
				}
			}
		});
		
	});
	//Search Button action//
	$(".sarch_btn").click(function() {
		var srch_val=$("#"+$(this).attr("target_val")).val();
		if(srch_val){
			srch_val=$(this).attr("target_url")+"&&"+$(this).attr("target_cap")+"="+srch_val;
			window.location.assign(srch_val);
		}
	});
	//End Search Button action//
	
	//Load TinyMCE //
	if($('textarea.txtedt').length){
		var s = document.createElement("script");
		s.src = "assets/plugins/tinymce/tinymce.min.js";
		s.onload = function(e){
			tinymce.init({
				selector: "textarea.txtedt",
				theme: "modern",
				height:200,
				plugins: [
					"advlist autolink lists link image charmap print preview hr anchor pagebreak",
					"searchreplace wordcount visualblocks visualchars code fullscreen",
					"insertdatetime media nonbreaking save table contextmenu directionality",
					"emoticons template paste textcolor colorpicker textpattern"
				],
				toolbar1: "insertfile undo redo | styleselect | bold underline italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
				toolbar2: "print preview media | forecolor backcolor emoticons",
				image_advtab: true,
				templates: [
					{title: 'Text Area', content: 'Text Area'}
				]
			});
		}; 
		document.head.appendChild(s); 
	}
	// Datepicker Function Define//
	$(".datepicker").attr('placeholder','YYYY-MM-DD');
	$(".datepicker").flatpickr({
		allowInput:true
	})
	//Input Mask for Date//
	$('.datepicker').inputmask('yyyy-mm-dd', { placeholder: '____/__/__' });
	//Export From jasper To Defined Formate// 
	$(".export_report").click(function(e) {
		target_form=$(this).parents("form:first");
		$.ajax({
			type: 'POST',
			url: 'index.php',
			data: target_form.serialize() + "&&pgr=" + $(this).attr("target")+ "&&action_val=" + $(this).attr("name"),
			dataType: 'text',
			beforeSend: function() {
				$('.page-loader-wrapper').fadeIn();
			},
			success: function(data) {
				$('.page-loader-wrapper').fadeOut(300, function(){
					swal({
						title:'Exported!',
						text: '<a href="'+data+'">Click here to download!</a>',
						html:true,
						type: 'success',
						showConfirmButton: true
					});
				});
			}
		});
	});
	//End Export From jasper To Defined Format//
	//Business set//
	$( "#business_cod").change(function() {
		var business_id=$(this).val();
		//var post_data="ppg=" + target + "&&"+p_name+"=" + p_value;
		var post_data="ppg=business/_dbusiness_info&set_business="+business_id;
		$.ajax({
			type: 'POST',
			url: 'index.php',
			data: post_data,
			dataType: 'json',
			beforeSend: function() {
				return confirm("Are you sure?");
			},
			success: function(data) {
				if(data.status==='success'){
					//alert(data.message);
					location.reload();
				}else{
					alert(data.message);
				}
			}
		});
	});
	//Tab Remember//
	$('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
		localStorage.setItem('activeTab', $(e.target).attr('href'));
	});
	var activeTab = localStorage.getItem('activeTab');
	if(activeTab){
		$('#myTab a[href="' + activeTab + '"]').tab('show');
	}
});