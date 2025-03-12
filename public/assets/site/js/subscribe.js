var delId = "";
$(document).ready(function () {

	$('.sub-btn').on('click', function (e) {
		e.preventDefault();
	 
	 var form = $(this).closest('form'); 
	 var pk = form.find('input[type="hidden"][name="package"]').val();

	 //selected Year
	 var year_inp = form.find('input[type="radio"]:checked');
	 var year = year_inp.val();
	var yearLbl= year_inp.parent().find('.form-check-label').text();
	$('#selected-year').text(yearLbl);
 //selected package
	var container = $(this).parent().parent(); // الانتقال إلى العنصر الأب (form) ثم إلى الأب (div.container)
	var pName = container.find('.p-name').text();
$('#selected-p').text(pName);
//fill reg fields
$('input[type="hidden"][name="package_reg"]').val(pk);
$('input[type="hidden"][name="year_reg"]').val(year);
	 $('#selected-sec').show();
	 $('html, body').animate({
		scrollTop: $('.sign-in').offset().top
	}, 1000);  
 
	});
	// $('.closemodal').on('click', function (e) {
	// 	e.preventDefault();
	// 	$('#subModal').modal('hide');
	// });

	// $('#btn-modal-del').on('click', function (e) {	 
	// 	 $('#' + delId).closest('form').submit();	 
	// 	$('#subModal').modal('hide');
	// });


});


