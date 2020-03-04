function loadAddAttendee(id, type) {
	let url = getPath() + 'templates/add_attendee.php?id=' + id + '&type=' + type;
	
	let modal = $('#addAttendee');
	modal.find('.modal-content').load(url);
	modal.modal('show');
}