module.exports = function(app,passport) {
  var testeList = require('../controllers/testeController');
var Consorcio = require('../models/consorcio');
// var Teste = require('../models/teste');
var request = require('request');



  /*  app.get('/teste',isLoggedIn, function(req,res){

 Teste.fetchAll().then(function(testes) {
        res.json({ testes });
});
    }); */

    app.route('/teste/:testeId')
    .get(testeList.find_teste)
    .put(testeList.update_teste)
    .delete(testeList.delete_teste);
    app.get('/consorcios',isLoggedIn, function(req,res){

 Consorcio.fetchAll({withRelated: ['tipoConsorcio'], require: true}).then(function(consorcios) {
      res.render('consorcios',{user : req.user , consorcios : consorcios.toJSON()});
      //  res.json({ consorcios  });
});
    });

    app.get('/consorcios/:consorcioId', function(req,res){

 Consorcio.where( {id:req.params.consorcioId }).fetch({withRelated: ['tipoConsorcio'], require: true}).then(function(consorcio) {
    //  res.render('consorcios',{user : req.user , consorcio : consorcios.toJSON()});
       res.json({ consorcio  });
});
    });


    // =====================================
        // HOME PAGE (with login links) ========
        // =====================================
        app.get('/', function(req, res) {
          if(req.user){
          res.render('index',{user : req.user }  ); // load the index.ejs file
          }else{
            res.render('login');
          }
        });


        app.get('/blank',isLoggedIn,function(req,res){
  res.render('blank',{user : req.user});

});

        // =====================================
        // LOGIN ===============================
        // =====================================
        // show the login form
        app.get('/login', function(req, res) {

            // render the page and pass in any flash data if it exists
            res.render('login', { message: req.flash('loginMessage') });
        });

        // process the login form
        app.post('/login', passport.authenticate('local-login', {
        successRedirect : '/home', // redirect to the secure profile section
        failureRedirect : '/login', // redirect back to the signup page if there is an error
        failureFlash : true // allow flash messages
    }));
        // =====================================
        // SIGNUP ==============================
        // =====================================
        // show the signup form
        app.get('/signup', function(req, res) {

            // render the page and pass in any flash data if it exists
            res.render('signup', { message: req.flash('signupMessage') });
        });

        app.post('/signup', passport.authenticate('local-signup', {
        successRedirect : '/home', // redirect to the secure profile section
        failureRedirect : '/signup', // redirect back to the signup page if there is an error
        failureFlash : true // allow flash messages
    }));

        // process the signup form
        // app.post('/signup', do all our passport stuff here);

        // =====================================
        // PROFILE SECTION =====================
        // =====================================
        // we will want this protected so you have to be logged in to visit
        // we will use route middleware to verify this (the isLoggedIn function)
        app.get('/home', isLoggedIn, function(req, res) {

res.render('index',{user : req.user });
        });

        // =====================================
        // LOGOUT ==============================
        // =====================================
        app.get('/logout', function(req, res) {
            req.logout();
            res.redirect('/');
        });

        app.use(function(req, res) {
          res.status(404).send({url: req.originalUrl + ' not found'})
        });
};


function isLoggedIn(req, res, next) {

    // if user is authenticated in the session, carry on
    if (req.isAuthenticated())
        return next();

    // if they aren't redirect them to the home page
    res.redirect('/');
}
