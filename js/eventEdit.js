$(function() {
	$('#editEvent').on('shown.bs.modal', function (e) {
		let link = $(e.relatedTarget); 
		let details = link.data('details').split('|');
		let type = link.data('type');
		let id = parseInt(details[0]);

		let modal = $(this);
		let name = details[1];
		let start;
		let end;
		let allowed;
		let venue;
		let title;
		let event;

		if(type == 'event') {
			title = 'Event modification';
			start = details[2];
			end = details[3];
			allowed= details[4];
			venue = details[5];
		}
		else {
			title = 'Session modification';
			start = details[4];
			end = details[5];
			allowed = details[2];
			event = details[3];
		}

		modal.find('.modal-title').text(title);
		modal.find('#name').val(name);
		modal.find('#start').val(start);
		modal.find('#end').val(end);
		modal.find('#allowed').val(allowed);

		if(type == 'event') {
			modal.find('#venue').val(venue);
			modal.find('div.input-group > #venue').parent().show();
		}
		else {
			modal.find('#event').val(event);
			modal.find('div.input-group > #venue').parent().hide();
		}

		modal.find('#id').val(id);
		modal.find('#type').val(type);
	});	

	$('#editEvent').on('hidden.bs.modal', function (e) {
		let modal = $(this);
		modal.find('.modal-title').empty();
		modal.find('#name').empty();
		modal.find('#start').empty();
		modal.find('#end').empty();
		modal.find('#allowed').empty();
		modal.find('#event').empty();
		modal.find('#id').empty();
		modal.find('#type').empty();
	});	
});
