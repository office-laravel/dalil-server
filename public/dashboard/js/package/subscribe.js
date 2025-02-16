

var valid = true;
var fail_msg = "فشلت العملية"
var delmsg = "تم حذف الحساب بنجاح";
var success_msg = "تم الحفظ بنجاح";
$(document).ready(function () {
	//image sec


	$('.btn-submit').on('click', function (e) {
		e.preventDefault();
		// تحديث الـ textarea
		// if (CKEDITOR.instances.description) {
		// 	CKEDITOR.instances.description.updateElement();
		// }
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
	//price table


	// حذف السطر عند الضغط على زر حذف







	//subscribe
	//fill prices by package
	$(document).on('change', '#package_id', function (e) {
		var option = $(this).find(":selected").val();


		if (option != 0) {
			getduration(option);
		}

	});

	function getduration(option) {
		if (option == 0) {

			resetSelect("#year");
		} else {
			var newurl = durationurl;
			newurl = newurl.replace("ItemId", option);

			$.ajax({
				url: newurl,
				type: "GET",
				//	contentType: false,
				//	processData: false,
				//contentType: 'application/json',
				success: function (data) {
					if (data.length == 0) {
						resetSelect("#year");
					} else {
						fillDurations(data);
					}

				}, error: function (errorresult) {

				}
			});
		}

	}
	function resetSelect(selectId) {
		var choose = "اختر المدة";

		$(selectId).html('<option title="" value="0" >' + choose + '</option>');
	}
	function fillDurations(data) {
		resetSelect("#year");
		$.each(data, function (key, value) {

			if (selyear == value.id) {
				$("#year").append('<option selected value="' + value.id + '">' + value.duration.duration + ' (' + value.price + ')' + '</option>');

			} else {
				$("#year").append('<option value="' + value.id + '" >' + value.duration.duration + ' (' + value.price + ')' + '</option>');
			}
		});
	}

	getduration(selpackage);

});


function resetForm(formid) {

	jQuery(formid)[0].reset();

}





function noteSuccess() {
	swal(success_msg);
}
function noteError() {
	swal(fail_msg);
}
function notemsg(msg) {
	swal(msg);
}