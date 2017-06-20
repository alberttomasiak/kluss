<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title></title>
    </head>
    <body>
        <button type="button" name="button" onclick="shunno_push_api()">
            Push that shit
        </button>
        <script type="text/javascript">
        function shunno_push_api() {
if (!Notification) {
alert('Hello World!');
return;
}

if (Notification.permission !== "granted")
Notification.requestPermission();

var notification = new Notification('', {
icon: 'https://i.imgur.com/Eesst9S.png',
body: "Sad affleck!",
});

notification.onclick = function () {
window.open("https://twitter.com/mehedih_");
};
}

        </script>
    </body>
</html>
