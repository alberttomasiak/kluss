<header class="admin--header">
    <a href="/admin/dashboard"><img src="/assets/img/logo-klusswit.png" alt="Kluss logo"></a>
    <div class="user--info">
        <p>Hey, {{Auth::user()->name}}!</p>
        <a href="/logout">Uitloggen</a>
    </div>
</header>
