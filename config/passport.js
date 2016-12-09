// load all things needed
var LocalStrategy   = require('passport-local').Strategy;
// load user model
var User            = require('../app/models/user');
//expose function to app with module.exports
module.exports = function(passport){
    //serialize user for session
    passport.serializeUser(function(user, done){
        done(null, user.id);
    });

    // deserialize user
    passport.deserializeUser(function(id, done){
        User.findById(id, function(err, user){
            done(err,user);
        });
    });

    passport.use('local-signup', new LocalStrategy({
        nameField           : 'name',
        surnameField        : 'surname',
        usernameField       : 'email',
        passwordField       : 'password',
        passReqToCallback   : true
    },
    function(req, email, password, done){
        process.nextTick(function(){
            User.findOne({ 'local.email' :  email }, function(err, user) {
                if(err)
                    return done(err);

                if(user){
                    return done(null, false, req.flash('signupMessage', 'That email is already taken.'));
                }else{
                    var newUser             = new User();
                    newUser.local.name      = req.body.name;
                    newUser.local.surname   = req.body.surname;
                    newUser.local.email     = email;
                    newUser.local.password  = newUser.generateHash(password);

                    //save user
                    newUser.save(function(err){
                        if(err)
                            throw err;
                        return done(null, newUser);
                    });
                }
            });
            });
        }));
};