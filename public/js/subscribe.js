var delId = "";
$(document).ready(function () {

	$('.sub-btn').on('click', function (e) {
		e.preventDefault();
		delId = $(this).attr("id");
		$('#subModal').modal('show');

	});
	$('.closemodal').on('click', function (e) {
		e.preventDefault();
		$('#subModal').modal('hide');
	});

	$('#btn-modal-del').on('click', function (e) {	 
		 $('#' + delId).closest('form').submit();	 
		$('#subModal').modal('hide');
	});


});


