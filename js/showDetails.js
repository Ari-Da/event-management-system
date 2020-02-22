$(function() {
	$('#eventModal').on('shown.bs.modal', function (e) {
		let link = $(e.relatedTarget); 
		let details = link.data('details').split('|');
		let type = link.data('type');
		let registered = parseInt(link.data('registered'));
		let modal = $(this);
		let num = '';
		let date = '';
		let title = '';

		if(type == 'session') {
			title = details[1] + ' session';
			num = details[2];
			date = details[4] + ' - ' + details[5];
		}
		else if(type == 'event') {
			title = details[1] + ' event';
			num = details[4];
			date = details[2] + ' - ' + details[3];
		}

		modal.find('.modal-title').text(title);
		modal.find('#num_allowed').html('<i class="fas fa-user-friends"></i>Number of participants: ' + num);
		modal.find('#dates').html('<i class="fas fa-calendar-alt"></i>' + date);
		modal.find('div.modal-footer > button[type="button"]').text((registered == 1) ? 'Unregister' : 'Register');
	});	

	$('#eventModal').on('hidden.bs.modal', function (e) {
		let modal = $(this);
		modal.find('.modal-title').empty();
		modal.find('#num_allowed').empty();
		modal.find('#dates').empty();
		modal.find('div.modal-footer > button[type="button"]').empty();
	});	
});
