<h2>Events</h2>

@if(count($events) > 0)

	{!! $events->render() !!}

	<ul>
		@foreach ($events as $event)
		    <li>
		    	{{ date('m/d/Y', strtotime($event->happened_on)) }}
		    	<a href = "events/{{ $event->id }}" title = "{{ $event->location }}">
		    		{{ $event->title }}
		    	</a>
		    </li>
		@endforeach
	</ul>

	{!! $events->render() !!}
@else
	<div class = "blank">
		<div>
			No records yet.
		</div>
	</div>
@endif
