$(function () {
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
});