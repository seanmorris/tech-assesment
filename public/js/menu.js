let menuInit = () => {
	let menuToggle = document.querySelector('[data-toggle="menu"]');
	let menuOpen   = false;
	menuToggle.addEventListener('click', (event)=>{
		console.log(menuToggle.classList);
		
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

		if(menuOpen)
		{
			parent.classList.remove('open');
			menuToggle.classList.remove('open');
			menuOpen = false;
			return;
		}
		menuOpen = true;
		parent.classList.add('open');
		menuToggle.classList.add('open');
	});
};
