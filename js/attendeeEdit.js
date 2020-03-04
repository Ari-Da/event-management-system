$(function() {
	$('#editAttendee').on('shown.bs.modal', function (e) {
		let link = $(e.relatedTarget); 
		let details = link.data('details').split('|');
		let event = parseInt(details[0]);
		let attendee = parseInt(details[1]);
		let paid = parseInt(details[2]);

		let modal = $(this);
		modal.find('#event').val(event);
		modal.find('#attendee').val(attendee);
		modal.find('#paid').val(paid);
	});	

	$('#editAttendee').on('hidden.bs.modal', function (e) {
		let modal = $(this);
		modal.find('#event').empty();
		modal.find('#attendee').empty();
		modal.find('#paid').empty();	
	});	
});
