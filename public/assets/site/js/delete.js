var delId = "";
$(document).ready(function () {

	$('.delete').on('click', function (e) {
		e.preventDefault();
		delId = $(this).attr("id");
		$('#DeleteModal').modal('show');

	});


	$('#btn-modal-del').on('click', function (e) {

		$('#' + delId).closest('form').submit();

		//$("#btn-cancel-modal").trigger("click");
		$('#DeleteModal').modal('hide');
	});
	$('.btn-close').on('click', function (e) {	 
		$('#DeleteModal').modal('hide');
	});
	$('.no-btn').on('click', function (e) {	 
		$('#DeleteModal').modal('hide');
	});

});


