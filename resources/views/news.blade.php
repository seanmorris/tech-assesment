<h2>News</h2>

@if(count($articles) > 0)

	{!! $articles->render() !!}

	<ul class = "news">
		@foreach ($articles as $article)
		    <li>
		    	<a href = "news/{{ $article->id }}">{{ $article->title }}</a>
		    	&nbsp;&nbsp;&nbsp;&nbsp;
		    	{{ date('m/d/Y', strtotime($article->happened_on)) }}
		    </li>
		@endforeach
	</ul>

	{!! $articles->render() !!}

@else
	<div class = "blank">
		<div>
			No records yet.
		</div>
	</div>
@endif
