$(function() {
	$('#editUser').on('shown.bs.modal', function (e) {
		let link = $(e.relatedTarget); 
		let details = link.data('details').split('|');
		let id = parseInt(details[0]);
		let name = details[1];
		let role = parseInt(details[3]);

		let modal = $(this);
		modal.find('#id').val(id);
		modal.find('#name').val(name);
		modal.find('#role').val(role);
	});	

	$('#editUser').on('hidden.bs.modal', function (e) {
		let modal = $(this);
		modal.find('#id').empty();
		modal.find('#name').empty();
		modal.find('#role').val("");
	});	
});
