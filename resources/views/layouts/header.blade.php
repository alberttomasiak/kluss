<div class="header">
	<div class="left-icons">
		@if(\Auth::user())
			<a class="kluss--logo" href="/home"></a>
		@endif
	</div>
	<div class="middle-icons"><h5>{{ $title or 'Home' }}</h5></div>
	<div class="right-icons">
		@if(\Auth::user())
			<a href="/profiel/{{\Auth::user()->id}}/{{str_slug(\Auth::user()->name)}}"><i class="glyphicon glyphicon-user"></i></a>
			<a href="/kluss_toevoegen"><i class="glyphicon glyphicon-plus"></i></a>
			<a href="/logout"><i class="glyphicon glyphicon-log-out"></i></a>
		@endif
	</div>
</div>
