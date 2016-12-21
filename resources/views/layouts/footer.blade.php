@if(str_contains(Request::fullUrl(), 'kluss_toevoegen') || str_contains(Request::fullUrl(), 'login') || str_contains(Request::fullUrl(), 'register'))
    <!-- Ginne zak doen -->
@else
    <footer class="landing_footer-app">
        <div class="footer_list">
            <a href="www.google.com" class="landing_footer_link">Wat is KLUSS</a>
            &#124;
            <a href="www.facebook.com" class="landing_footer_link">Team</a>
            &#124;
            <a href="www.twitter.com" class="landing_footer_link">Partners</a>
            &#124;
            <a href="www.instagram.com" class="landing_footer_link">Privacy</a>
            &#124;
            <a href="www.weareimd.be" class="landing_footer_link">Contact</a>
        </div>
    </footer>
@endif