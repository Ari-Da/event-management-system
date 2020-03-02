$(function() {
	$('#addSession').on('shown.bs.modal', function (e) {
		let link = $(e.relatedTarget); 
		let event = link.data('event');
		let max = link.data('max');
		
		let modal = $(this);
		modal.find('#event').val(event);
		modal.find('#allowed').attr('max', max);	
	});	
});
