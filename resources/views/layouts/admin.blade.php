<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="/assets/img/favicon.ico" sizes="48x48">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Kluss') }}</title>

    <!-- Styles -->
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/reset.css">
    <link href="/assets/css/admin.css" rel="stylesheet">
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-89370521-1', 'auto');
  ga('send', 'pageview');

</script>
    <div class="page">
        @include('layouts.admin.header')
        <div class="page-content" style="position:relative; min-height: calc(100vh - 40px);">
            @include('admin.dashboard.partials.header')
            @include('admin.dashboard.partials.sidebar')
            <div class="admin--content">
                @yield('content')
            </div>
        </div>
        @include('layouts.admin.footer')
    </div>

    <!-- Scripts -->
    <script src="/assets/js/app.js"></script>
</body>
</html>
