function getNumAllowed(id) {
	let venue = parseInt(id);
	let allowed = $("#allowed");
	
	if (venue == 0) {
		allowed.val("");
		allowed.prop("max", "1000");
        return;
    } else {
		$.get({
			url: getUrl() + "/api/getNumAllowed.php?id=" + venue,
			success: function(response) {
				allowed.val(response);
				allowed.prop("max", parseInt(response));
			}
		})
    }
}


function getUrl() {
	return window.location.protocol + "//" + window.location.host + "/server-dev/projects/Project\ 1/event-management-system";
}