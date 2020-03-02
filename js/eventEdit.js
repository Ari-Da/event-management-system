$(function() {
	$('#editEvent').on('shown.bs.modal', function (e) {
		let link = $(e.relatedTarget); 
		let details = link.data('details').split('|');
		let id = parseInt(details[0]);

		let modal = $(this);
		let name = details[1];
		let start = details[2];
		let end = details[3];
		let allowed= details[4];
		let venue = details[5];

		// if(type == 'session') {
		// 	title = details[1] + ' session';
		// 	num = details[2];
		// 	date = details[4] + ' - ' + details[5];
		// }
		// else if(type == 'event') {
		// 	title = details[1] + ' event';
		// 	num = details[4];
		// 	date = details[2] + ' - ' + details[3];
		// }

		modal.find('.modal-title').text('Event modification');
		modal.find('#name').val(name);
		modal.find('#start').val(start);
		modal.find('#end').val(end);
		modal.find('#allowed').val(allowed);
		modal.find('#venue').val(venue);
		modal.find('input[type="hidden"]').val(id);
		// modal.find('#type').val(type);
	
	});	

	$('#editEvent').on('hidden.bs.modal', function (e) {
		let modal = $(this);
		modal.find('.modal-title').empty();
		modal.find('#name').empty();
		modal.find('#start').empty();
		modal.find('#end').empty();
		modal.find('#allowed').empty();
		// modal.find('#venue').empty();
		modal.find('input[type="hidden"]').empty();
	});	
});
