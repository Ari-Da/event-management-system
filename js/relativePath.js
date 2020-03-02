function getPath() {
	let parts = window.location.pathname.split('/');
	let relativePath = '';

	for(let i = 0; i < parts.length; i++) {
		relativePath += parts[i] + '/';

		if(parts[i] == 'event-management-system')
			break;
	}

	return window.location.protocol + '//' + window.location.host + relativePath;
}