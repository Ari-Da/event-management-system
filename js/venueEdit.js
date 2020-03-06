$(function() {
	$('#editVenue').on('shown.bs.modal', function (e) {
		let link = $(e.relatedTarget); 
		let details = link.data('details').split('|');
		let id = parseInt(details[0]);
		let name = details[1];
		let capacity = parseInt(details[2]);

		let modal = $(this);
		modal.find('#id').val(id);
		modal.find('#name').val(name);
		modal.find('#capacity').val(capacity);
	});	

	$('#editVenue').on('hidden.bs.modal', function (e) {
		let modal = $(this);
		modal.find('#id').empty();
		modal.find('#name').empty();
		modal.find('#capacity').empty();	
	});	
});
