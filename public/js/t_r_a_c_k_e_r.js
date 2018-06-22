let trackerInit = () => {


	let trackingTag = document.querySelector('#tracking-data');
	let tracking    = {};
	
	if(trackingTag)
	{
		tracking = JSON.parse(trackingTag.innerHTML);
	}
	
	tracking.url = window.location.href;

	let trackingString = Object.keys(tracking).map((key) => {
		return encodeURIComponent(key) + '=' + encodeURIComponent(tracking[key])
	}).join('&');

	var ajax = new XMLHttpRequest();

	ajax.open('POST', '/api/tracking', true);
	ajax.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	ajax.send(trackingString);
};