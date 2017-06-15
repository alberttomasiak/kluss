@if(\Auth::user())
	<div class="header">
	<div class="mobile-nav">
		<div class="menu menu-1">
			  <span class="menu-item"></span>
			  <span class="menu-item"></span>
			  <span class="menu-item"></span>
	    </div>
		<a class="hamburger-logo" href="/home"><img src="/assets/img/K-logo.png" alt=""></a>
	</div>
	<div class="header-nav">
		<div class="left-icons">
			 <a href='/home'><img class="animationout" src="/assets/img/home-logo.png"><p>Home</p></a>
			 <a href='/meldingen'><span class="add-notif-here {{$data["notifications"] > 0 ? 'new-notif' : ''}}"></span><img class="animationout notif-img" src="/assets/img/bell-logo.png"><p>Meldingen</p></a>
			 <a href='/chat'><span class="add-msg-here {{$data["messages"] > 0 ? 'new-msg' : ''}}"></span><img class="animationout mail-img" src="/assets/img/berichten-logo.png"><p>Berichten</p></a>
		</div>
		<div class="middle-icons">
			<a href="/home"><img src="/assets/img/K-logo.png" class="kluss--logo" alt="Kluss Logo"></a>
		</div>
		<div class="right-icons">
	       <a href='/klussje_toevoegen'><img class="animationout" src="/assets/img/plaats-logo.png"><p>Plaats een klusje</p></a>
		   <a href='#' class="settings-dropdown"><img class="animationout" src="/assets/img/settings-logo.png"><p>Instellingen</p></a>
		   <ul class="dropdown-toggle">
			<li><a href="/settings"><span>Algemene instellingen</span></a></li>
		   	<li><a href="/profiel/{{\Auth::user()->id}}/{{str_slug(\Auth::user()->name)}}"><span>Profiel</span></a></li>
			<li><a href="/logout"><span>Afmelden</span></a></li>
		   </ul>
		</div>
	</div>
</div>
@else
	<div class="header">
		<div class="header-nav">
			<div class="middle-icons">
				<a href="/home"><img src="/assets/img/K-logo.png" class="kluss--logo" alt="Kluss Logo"></a>
			</div>
		</div>
	</div>
@endif
