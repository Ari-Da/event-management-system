function loadAttendeeModal(event, type) {
	let parts = window.location.pathname.split('/');
	let relativePath = '';

	for(let i = 0; i <= 4; i++) {
		relativePath += parts[i] + '/';
	}

	let url = window.location.protocol + '//' + window.location.host + relativePath + 'templates/view_attendees.php?event=' 
	+ event + '&type=' + type;
	
	let modal = $('#attendees');
	modal.find('.modal-content').load(url);
	modal.modal('show');
}