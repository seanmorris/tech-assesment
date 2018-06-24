<h2>Tracking</h2>

<form>
	<label>
		From:<br />
		<input type = "date" name = "from" value="{{ $from }}"/>
	</label>
	<label>
		To:<br />
		<input type = "date" name = "to" value="{{ $to }}" />
	</label>

	<input type = "submit" value="Update" />
</form>

<p>Unique Pageviews: <b>{{ $uniqueHits }}</b></p>
<p>Total Pageviews: <b>{{ $totalHits }}</b></p>

<a href = "tracking/export?from={{ $from }}&to={{ $to }}">Export to CSV</a>
