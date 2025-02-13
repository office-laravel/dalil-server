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
		gettabledata();
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
	$('#addRow').click(function () {

		var year = $('#year').find(":selected").text();
		var yearId = $('#year').val();
		var price = $('#price').val();

		if (year && price) {
			var newRow = `<tr>
                        <td class="text-center" id="year-${yearId}">${year}</td>
                        <td class="text-center">${price}</td>
                        <td class="editt">
                        
                            <button type="button" class="btn btn-danger btn-sm delete" title="Delete">حذف</button>
                        </td>
                    </tr>`;
			$('#tableBody').append(newRow);

			// تفريغ الحقول بعد الإضافة
			$('#year').val('');
			$('#price').val('');
		} else {
			swal('يرجى ملء جميع الحقول');
		}
	});

	$('#addRow-edit').click(function () {

		var year = $('#year').find(":selected").text();
		var yearId = $('#year').val();
		var price = $('#price').val();

		if (year && price) {
			var newRow = `<tr>
                        <td class="text-center" id="year-${yearId}">${year}</td>
                        <td class="text-center">${price}</td>
                        <td class="editt">
                            <button  type="button" class="btn btn-primary btn-sm">تعديل</button>
                            <button type="button" class="btn btn-danger btn-sm delete" title="Delete">حذف</button>
                        </td>
                    </tr>`;
			$('#tableBody').append(newRow);

			// تفريغ الحقول بعد الإضافة
			$('#year').val('');
			$('#price').val('');
		} else {
			swal('يرجى ملء جميع الحقول');
		}
	});



	// حذف السطر عند الضغط على زر حذف
	$(document).on('click', '.delete', function () {
		$(this).closest('tr').remove();
	});

	function gettabledata() {
		var data = []; // مصفوفة لتخزين البيانات

		// التكرار على كل سطر في الجدول
		$('#tableBody tr').each(function () {
			var year = $(this).find('td:eq(0)').attr('id'); // الحصول على المدة
			year = year.replace("year-", "");
			var price = $(this).find('td:eq(1)').text(); // الحصول على السعر

			// إضافة كائن يحتوي على المدة والسعر إلى المصفوفة
			data.push({
				year: year,
				price: price
			});
		});

		// تحويل المصفوفة إلى JSON
		var jsonData = JSON.stringify(data);

		// تعيين قيمة الحقل المخفي بالبيانات JSON
		$('#year_price').val(jsonData);


	};


	//edit modal
	$(document).on('click', '.edit-row-btn', function (e) {
		e.preventDefault();
		// الحصول على قيم السنة والسعر من السطر الذي تم النقر عليه
		var year = $(this).closest('tr').find('td:eq(0)').text(); // السنة
		var price = $(this).closest('tr').find('td:eq(1)').text(); // السعر

		// تعبئة حقول الـ Modal
		$('#year-edit').text(year); // تعبئة السنة
		$('#price-edit').val(price); // تعبئة السعر

		// فتح الـ Modal
		$('#edit-Modal').modal('show');

		// حفظ المرجع إلى السطر الذي يتم تعديله
		$('#edit-Modal').data('row', $(this).closest('tr'));
	});

	// تحديث السعر في الجدول عند الضغط على زر التعديل في الـ Modal
	$('#btn-modal-edit').click(function () {
		// الحصول على السعر الجديد من الـ Modal
		var newPrice = $('#price-edit').val();

		// التأكد من أن السعر الجديد غير فارغ
		if (newPrice) {
			// تحديث السعر في الجدول
			var row = $('#edit-Modal').data('row'); // الحصول على السطر الذي يتم تعديله
			row.find('td:eq(1)').text(newPrice); // تحديث السعر

			// إغلاق الـ Modal
			$('#edit-Modal').modal('hide');
		} else {
			alert('يرجى إدخال سعر صحيح');
		}
	});

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