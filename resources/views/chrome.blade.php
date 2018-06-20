<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Tech Assessment</title>

        <style type = "text/css">
            @import url(/css/app.css);
        </style>
    </head>
    <body>
    	<div class = "header normal">
    		<h1>Tech Assessment</h1>
    		<ul class = "navigation">
    			<li><a href = "/home">Home</a></li>
    			<li><a href = "/news">News</a></li>
                <li><a href = "/events">Events</a></li>
                <li><a href = "/about">About</a></li>
    			<li><a href = "/blank">Blank</a></li>
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