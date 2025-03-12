var valid = true;
var fail_msg = "فشلت العملية"
var delmsg = "تم حذف الحساب بنجاح";
var success_msg = "تم الحفظ بنجاح";
$(document).ready(function () {
	//image sec
	$(document).on('change', '#image', function () {
		var file = this.files[0];
		var imgTag = $('#imgshow');
		if (file) {
			var reader = new FileReader();
			reader.onload = function (e) {
				// عرض الصورة الجديدة
				imgTag.attr('src', e.target.result);
			}
			reader.readAsDataURL(file);
		}
	});

	$('.btn-submit').on('click', function (e) {
		e.preventDefault();
		// تحديث الـ textarea
		if (CKEDITOR.instances.description) {
			CKEDITOR.instances.description.updateElement();
		}
		var formId = $(this).parents("form").attr('id');
		sendform('#' + formId);


		// alert(valid);
	});
	function ClearErrors() {
		$("." + "invalid-feedback").html('').hide();
		$('.is-invalid').removeClass('is-invalid');
	}
	/*
		$('#modal-btn-yes').click(function () {
			//sendformbyType(recordId, tableRow);
			$('form[name="form-del-image"]').submit();
			$('.close').trigger('click');
		});
	*/
	//end image sec

	function sendform(formid) {
		ClearErrors();
		var form = $(formid)[0];
		var formData = new FormData(form);
		urlval = $(formid).attr("action");
		$.ajax({
			url: urlval,
			type: "POST",
			data: formData,
			contentType: false,
			processData: false,

			success: function (data) {
				//	$('.loading img').hide();
				if (data.length == 0) {
					noteError();
				} else if (data == "ok") {

					noteSuccess();
					resetForm(formid);

				} else if (data == "no-limit") {
					swal('تجاوزت الحد المسموح من المنتجات');
				} else {
					noteError();
				}

			}, error: function (errorresult) {
				var response = $.parseJSON(errorresult.responseText);
				noteError();
				$.each(response.errors, function (key, val) {
					//	$("#" + "info-form-error").append('<li class="text-danger">' + val[0] + '</li>');
					$("#" + key + "-error").addClass('invalid-feedback').text(val[0]).show();
					$("#" + key).addClass('is-invalid');
				});

			}, finally: function () {

			}
		});
	}

	function resetForm(formid) {

		jQuery(formid)[0].reset();

	}

});
function noteSuccess() {
	swal(success_msg);
}
function noteError() {
	swal(fail_msg);
}
function notemsg(msg) {
	swal(msg);
}