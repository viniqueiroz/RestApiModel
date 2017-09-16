var connection = require('../../dbConnection.js');

var Consorcio = new connection.Consorcio();

exports.findAll = function(req, res) {
  Consorcio.find  ('all', function(err, consorcios) {
    if (err)
      res.send(err);
    //res.send(consorcios);
    res.render('consorcios',{user : req.user , consorcios : consorcios});
  });
};
