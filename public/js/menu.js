let menuInit = () => {
	let menuToggle = document.querySelector('[data-toggle="menu"]');
	let menuOpen   = false;

	let parent = menuToggle.parentNode;

	while(parent)
	{
		console.log(parent);
		if(parent.matches('[data-togglable="menu"]') || parent == window)
		{
			break;
		}
		parent = parent.parentNode;
	}

	if(!parent)
	{
		return;
	}

	let menuNode = parent;

	menuNode.addEventListener('transitionend', (event) => {
		if(!menuOpen)
		{
			// menuNode.classList.remove('closed');
		}
	});

	menuToggle.addEventListener('click', (event)=>{
		console.log(menuToggle.classList);
		
		menuNode.classList.add('closed');

		if(menuOpen)
		{
			menuNode.classList.remove('open');
			menuToggle.classList.remove('open');
			menuOpen = false;
			return;
		}

		menuOpen = true;
		
		menuNode.classList.add('open');
		menuToggle.classList.add('open');
	});
};
