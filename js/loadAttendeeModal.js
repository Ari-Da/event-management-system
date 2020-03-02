function loadAttendeeModal(event, type) {
	let url = window.location.protocol + '//' + window.location.host + '/server-dev/projects/Project%201/event-management-system/templates/view_attendees.php?event=' 
	+ event + '&type=' + type;

	let modal = $('#attendees');
	modal.find('.modal-content').load(url);
	modal.modal('show');
}