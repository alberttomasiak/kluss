var express = require('express');
var app = express();

app.get('/', function (req, res) {
  res.send('KLUSS Node.js intro');
});

app.set('port', (process.env.PORT || 7000));

app.listen(app.get('port'), function () {
  console.log('Example app listening on port 7000!');
});
