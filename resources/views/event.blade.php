<div class = "event">
	<img class = "left" src ="{{ $image }}" />

	<div class = "details">
		<h2>{{ $event->title }}</h2>
		<p>{{ date('m/d/Y', strtotime($event->happened_on)) }}</p>
		<p>{{ $event->location }} </p>
		<hr	/>


		<a class = "social mini" target = "_blank" href = "https://m.uber.com/ul/?client_id=BksUgf_mNAhvLKIBF-RcQsatl0j44Mr4&action=setPickup&pickup=%5Bformatted_address%5D=my_location&dropoff%5Bformatted_address%5D={{ $encodedLocation }}">
			<img alt = "uber" src = "/img/uber_icon_white.png" /> 
			<span class = "text">Uber me!</span>
		</a><br/>
		<a class = "social mini" target = "_blank" href = "http://maps.google.com/maps?q={{ $encodedLocation }}">
			<img alt = "navigate" src = "/img/navigation_icon_white.png" />
			<span class = "text">Navigate</span>
		</a>
	</div>
</div>

<script type = "text/json" id = "tracking-data">{!!
	json_encode($tracking, JSON_PRETTY_PRINT)
!!}</script>
