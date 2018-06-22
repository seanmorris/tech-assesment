<h2>{{ $article->title }}</h2>
<i>{{ $article->happened_on }}</i>
<hr />
<img src ="{{ $image }}" />
<script type = "text/json" id = "tracking-data">{!!
	json_encode($tracking, JSON_PRETTY_PRINT);
!!}</script>