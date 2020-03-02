$(function() {
	$('#addSession').on('shown.bs.modal', function (e) {
		let link = $(e.relatedTarget); 
		let event = link.data('event');
		let max = link.data('max');
		let title = 'Add session for ' + link.data('name');
		
		let modal = $(this);
		modal.find('.modal-title').text(title);
		modal.find('#event').val(event);
		modal.find('#allowed').attr('max', max);	
	});	
});
