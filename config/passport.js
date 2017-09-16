// config/passport.js

// load all the things we need
var LocalStrategy   = require('passport-local').Strategy;
var mysql = require('mysql');
var bcrypt   = require('bcrypt-nodejs');

// load up the user model
var dbConfig = require('../db.js');
var connection = mysql.createConnection(dbConfig.connection);

connection.query('USE ' + dbConfig.database);
// expose this function to our app using module.exports
module.exports = function(passport) {

    // =========================================================================
    // passport session setup ==================================================
    

    // =========================================================================
    // required for persistent login sessions
    // passport needs ability to serialize and unserialize users out of session

    // used to serialize the user for the session
    passport.serializeUser(function(usuario, done) {
        done(null, usuario.id);
    });

    // used to deserialize the user
    passport.deserializeUser(function(id, done) {

        connection.query("SELECT * FROM usuario WHERE id = ? ",[id], function(err, rows){
            done(err, rows[0]);
        });
    });

    // =========================================================================
    // LOCAL SIGNUP ============================================================
    // =========================================================================
    // we are using named strategies since we have one for login and one for signup
    // by default, if there was no name, it would just be called 'local'

    passport.use('local-signup', new LocalStrategy({
        // by default, local strategy uses username and password, we will override with email
        usernameField : 'email',
        passwordField : 'senha',
       passReqToCallback : true // allows us to pass back the entire request to the callback
    },
    function(req,email,senha, done) {

        // asynchronous
        // User.findOne wont fire unless data is sent back
   process.nextTick(function() {



        // find a user whose email is the same as the forms email
        // we are checking to see if the user trying to login already exists
        connection.query("SELECT * FROM usuario WHERE email = ?",[email], function(err, rows) {


            // if there are any errors, return the error
            if (err)
                return done(err);

            // check to see if theres already a user with that email
            if (rows.length) {
                return done(null, false, req.flash('signupMessage', 'That email is already taken.'));

            } else {
                // if there is no user with that email
                // create the user
                  // set the user's local credentials
                  var senhaHash = generateHash(senha);

                var newUser = {email: email ,
                  senha: senhaHash

                };

 var insertQuery = "INSERT INTO usuario ( email, senha ) values (?,?)";


                // save the user
                connection.query(insertQuery,[newUser.email, newUser.senha],function(err, rows) {
newUser.id = rows.insertId;
              return done(null, newUser);
                });

            }

        });

       });

    }));



// =========================================================================
   // LOCAL LOGIN =============================================================
   // =========================================================================
   // we are using named strategies since we have one for login and one for signup
   // by default, if there was no name, it would just be called 'local'

   passport.use(
       'local-login',
       new LocalStrategy({
           // by default, local strategy uses username and password, we will override with email
           usernameField : 'email',
           passwordField : 'senha',
           passReqToCallback : true // allows us to pass back the entire request to the callback
       },
       function(req, email, senha, done) { // callback with email and password from our form
           connection.query("SELECT * FROM usuario WHERE email = ?",[email], function(err, rows){
               if (err)
                   return done(err);
               if (!rows.length) {
                   return done(null, false, req.flash('loginMessage', 'No user found.')); // req.flash is the way to set flashdata using connect-flash
               }

               // if the user is found but the password is wrong
               if (!bcrypt.compareSync(senha, rows[0].senha))
                   return done(null, false, req.flash('loginMessage', 'Oops! Wrong password.')); // create the loginMessage and save it to session as flashdata

               // all is well, return successful user
               var user = rows[0];

               return done(null, user);
           });
       })
   );
};

function generateHash(password) {
    return bcrypt.hashSync(password, bcrypt.genSaltSync(8), null);
};
