document.addEventListener('DOMContentLoaded', (event)=>{
	menuInit();
	if(typeof trackerInit !== 'undefined')
	{
		trackerInit();		
	}
	else
	{
		console.log('Please disable your ad blocker to allow tracking.');
	}
});