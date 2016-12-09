var express = require('express');
var app = express();

var port = process.env.PORT || 7000;
var mongoose = require('mongoose');
var passport = require('passport');
var flash = require('connect-flash');
var morgan = require('morgan');
var cookieParser = require('cookie-parser');
var bodyParser = require('body-parser');
var session = require('express-session');
var configDB = require('./config/database.js');
var pug = require('pug');

// configuration =======================================
mongoose.connect(configDB.url);

require('./config/passport')(passport);

// set up the express app
app.use(morgan('dev')); // log all requests to console
app.use(cookieParser()); // read cookies (needed for auth)
app.use(bodyParser()); // get info from html forms

app.set('view engine', 'pug'); // pug for templating

// passport setup
app.use(session({secret: 'iSecretlyLove50CentKLUSS'})); //session secret
app.use(passport.initialize());
app.use(passport.session());
app.use(flash());

//routes
require('./app/routes.js')(app, passport); // load routes and pass passport

// launch
app.listen(port);
console.log('Hey nico, wanna go bowling at: ' + port);

process.on('uncaughtException', function (err) {
    console.log(err);
}); 

/*app.get('/', function (req, res) {
  res.send('KLUSS Node.js intro');
});

app.set('port', (process.env.PORT || 7000));

app.listen(app.get('port'), function () {
  console.log('Example app listening on port 7000!');
});
*/
