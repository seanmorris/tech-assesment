<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Tech Assesment</title>

        <style>
        	* {
        		margin: 0px;
        		padding: 0px;
        	}
        	body {
        		display: flex;
        		min-height: 100vh;
        		flex-direction: column;
        	}

        	.normal {
        		padding: 10px;
        	}

        	.content {
        		flex: 1;
        	}

        	.header {
        		border-bottom: 1px #ccc solid;
        	}
        	
        	.footer {
        		display: flex;
        		flex-direction: row;
        		background: black;
        		color: white;
        	}

        	.footer div {
        		width: 100%;
        	}

        	.footer div:last-child {
        		text-align: right;
        	}

        	.navigation {
        		display: flex;
        	}

        	.navigation li {
        		list-style-type: none;
        		margin-right: 10px;
        	}

        	@media(max-width: 800px) {
        		.navigation {
	        		flex-direction: column;
	        	}
	        	.navigation li {
	        		list-style-type: none;
	        		margin-right: 10px;
	        	}        		
        	}
        </style>
    </head>
    <body>
    	<div class = "header normal">
    		<h1>Tech Assesment</h1>
    		<ul class = "navigation">
    			<li><a href = "home">Home</a></li>
    			<li><a href = "news">News</a></li>
    			<li><a href = "events">Events</a></li>
    		</ul>
    	</div>
    	<div class = "content normal">
    		{!! $content !!}
    	</div>
    	<div class = "footer normal">
    		<div>Parse Test</div>
    		<div>Sean Morris</div>
    	</div>
    </body>
</html>