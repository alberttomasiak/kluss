@if(str_contains(Request::fullUrl(), 'kluss_toevoegen') || str_contains(Request::fullUrl(), 'login') || str_contains(Request::fullUrl(), 'register'))
    <!-- Ginne zak doen -->
@else
    <footer class="landing_footer-app">
        <div class="footer_list">
            <a href="www.google.com" class="landing_footer_link">KLUSS</a>
            &#124;
            <a href="www.facebook.com" class="landing_footer_link">Team</a>
            &#124;
            <a href="www.twitter.com" class="landing_footer_link">Algemene Voorwaarden</a>
            &#124;
            <a href="www.instagram.com" class="landing_footer_link">FAQ</a>
            &#124;
            <a href="www.weareimd.be" class="landing_footer_link">Contact</a>
            &#124;
            <a href="www.weareimd.be" class="landing_footer_link">Kluss Gold</a>
            &#124;
            <a href="www.weareimd.be" class="landing_footer_link"><img style="height: 35px;padding-left: 5px; padding-right: 5px;" src="../assets/img/facebook-logo.png">Facebook</a>
            &#124;
            <a href="www.weareimd.be" class="landing_footer_link"><img style="height: 35px;padding-left: 5px; padding-right: 5px;" src="../assets/img/twitter-logo.png">Twitter</a>

        </div>

        <div style="padding-bottom: 20px; background-color: #2E9C4E;">
            &copy; KLUSS 2017 - Made with &#10084; by our team
        </div>
    </footer>
@endif