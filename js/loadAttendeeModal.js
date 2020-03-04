function loadAttendeeModal(event, type) {
	let url = getPath() + 'templates/view_attendees.php?id=' + event + '&type=' + type;
	
	let modal = $('#attendees');
	modal.find('.modal-content').load(url);
	modal.modal('show');
}
