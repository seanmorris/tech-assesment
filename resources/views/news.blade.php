<h2>News</h2>

@if(count($articles) > 0)

	{!! $articles->render() !!}

	<ul class = "news">
		@foreach ($articles as $article)
		    <li>
		    	<a href = "news/{{ $article->id }}">
		    	@if(count($article->images))
		    		<img class = "preview" src = "{{$article->images[0]->crop(100,100) }}" />
		    	@endif
		    	{{ $article->title }}
		    	</a>
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
