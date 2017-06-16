<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" id="favicon" type="image/png" href="/assets/img/favicon.ico" sizes="48x48">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Kluss') }}</title>

    <!-- Styles -->
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">
    <link href="/assets/css/app.css" rel="stylesheet">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script type="text/javascript" src="/assets/js/bootstrap.min.js"></script>
    <script src="//js.pusher.com/3.0/pusher.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
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

  var pusher = new Pusher('1a329a7dd69a92834d4d', {
    cluster: 'eu',
    encrypted: true,
    authEndpoint: '/map/auth',
    auth: {
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      }
  });

  function notifyUser(data){
      toastr.options.progressBar = true;
      toastr.info(data);
      checkStatus();
  }

  function checkStatus(){
      var messages = "{{checkMsgs(\Auth::user()->id)}}";
      var notifs = "{{checkNtfs(\Auth::user()->id)}}";
      if(messages > 0){
          $('.add-msg-here').addClass('new-msg');
      }
      if(notifs > 0){
          $('.add-notif-here').addClass('new-notif');
      }

      if(messages > 0 || notifs > 0){
          $('#favicon').attr('href', '/assets/img/favicon-notification.png');
      }
  }

  var globalNotifications = pusher.subscribe("global-notifications");
  var privateNotifications = pusher.subscribe("{{$data["channel"]}}");
  globalNotifications.bind("global-notification", notifyUser);
  privateNotifications.bind("new-notification", notifyUser);

</script>
    <div class="page">
        @include('layouts.header')
        <div class="page-content">
            @yield('content')
        </div>
        @include('layouts.footer')
    </div>

    <!-- Scripts -->
    <script src="/assets/js/app.js"></script>
</body>
</html>
