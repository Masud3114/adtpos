"use strict";
var adtDatePickerScourceCall = function() {
	var adtDatePicker = function(selector) {
		$(selector).click(function (){
			var ContainerElm=$(this).parent('div');
			$(this).datepicker({
				weekStart: 5,
				daysOfWeekHighlighted: "5",
				autoclose: true,
				container:ContainerElm
			}).on('change', function(){
				this.focus();
			});
		});
	};
	return {
		init: function() {
			adtDatePicker('.datepicker');
		},
	};
}();

jQuery(document).ready(function() {
	adtDatePickerScourceCall.init();
});