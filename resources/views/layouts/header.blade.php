@if($AuthUser != null)
	<div class="header">
	<div class="mobile-nav">
		<div class="menu menu-1">
			  <span class="menu-item"></span>
			  <span class="menu-item"></span>
			  <span class="menu-item"></span>
	    </div>
		<a class="hamburger-logo" href="/home"><img src="/assets/img/K-logo.png" alt=""></a>
		<a class="post-btn-mobile" href='/kluss_toevoegen'><p>Post</p></a>
	</div>
	<div class="header-nav">
		<div class="left-icons">
			 <a href='/home' class="{!! classActivePath('home') !!}"><img class="" src="/assets/img/home-logo.png" alt="home img"><p>Home</p></a>
			 <a href='/meldingen' class="{!! classActivePath('meldingen') !!}"><span class="add-notif-here {{$data["notifications"] > 0 ? 'new-notif' : ''}}"></span><img class="notif-img" src="/assets/img/bell-logo.png" alt="meldingen img"><p>Meldingen</p></a>
			 <a href='/chat' class="{!! classActivePath('chat') !!}"><span class="add-msg-here {{$data["messages"] > 0 ? 'new-msg' : ''}}"></span><img class="mail-img" src="/assets/img/berichten-logo.png" alt="berichten img"><p>Berichten</p></a>
		</div>
		<div class="middle-icons">
			<a href="/home"><img src="/assets/img/K-logo.png" class="kluss--logo" alt="Kluss Logo"></a>
		</div>
		<div class="right-icons">
			<a href="/profiel/{{\Auth::user()->id}}/{{str_slug(\Auth::user()->name)}}" class="{!! classActivePath('profiel') !!}"><img src="/assets/img/profiel.png" alt="Profiel pagina image"><p>Profiel</p></a>
		   <a href='#' class="settings-dropdown {!! classActivePath('settings') !!}"><img class="" src="/assets/img/settings-logo.png" alt="instellingen alt"><p>Instellingen</p></a>
		   <ul class="dropdown-toggle">
		    <li><a href="/settings"><span>Algemene instellingen</span></a></li>
		    <li><a href="/logout"><span>Afmelden</span></a></li>
		   </ul>
		   <a class="post-btn" href='/kluss_toevoegen'>Plaats klussje</a>
		</div>
	</div>
</div>
@else
	<div class="header">
		<div class="mobile-nav">
			<a class="hamburger-logo" href="/"><img src="/assets/img/K-logo.png" alt=""></a>
			<a class="post-btn-mobile-anon" href='/aanmelden'><p>Aanmelden</p></a>
		</div>
		<div class="header-nav">
			<div class="header-nav-wrap">
				<div class="middle-icons">
					<a class="hamburger-logo" href="/home"><img src="/assets/img/K-logo.png" alt=""></a>
				</div>
				<div class="right-icons right-icons-anon">
					<a class="post-btn-anon" href='/aanmelden'>Aanmelden</a>
				</div>
			</div>
		</div>
	</div>
@endif
