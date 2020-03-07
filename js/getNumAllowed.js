function getNumAllowed(id) {
	let venue = parseInt(id);
	let allowed = $("#allowed");
	
	if (venue == 0) {
		allowed.attr("max", "1000");
        return;
    } else {
		$.get({
			url: getPath() + "api/getNumAllowed.php?id=" + venue,
			success: function(response) {
				allowed.attr("max", parseInt(response));
			}
		})
    }
}