//var connection = require('../../dbConnection.js');

//var Teste = new connection.Teste();

exports.list_all_testes = function(req, res) {
  Teste.find('all', function(err, teste) {
    if (err)
      res.send(err);
    res.json(teste);
  });
};
exports.add_teste = function(req, res) {
  var novoTeste = new connection.Teste({nome: req.body.nome ,
    ano: req.body.ano

  });
  novoTeste.save(function(err, novoTeste) {
    if (err)
      res.send(err);
    res.json(novoTeste);
  });
};

exports.find_teste = function(req, res) {
  var id = req.params.testeId;
  Teste.find("all",{where:'id = '+id}, function(err, teste) {
    if (err)
      res.send(err);
    res.json(teste);
  });
};

exports.update_teste = function(req, res) {
  var id = req.params.testeId;
  var novoTeste = new connection.Teste({nome: req.body.nome ,
    ano: req.body.ano

  });
 novoTeste.set('id',id);

  novoTeste.save(function(err, novoTeste) {
    if (err)
    return  res.send(err);
    res.json(novoTeste);
  });

};

exports.delete_teste = function(req, res) {
  var id = req.params.testeId;
  Teste.remove('id = '+id, function(err, teste) {
    if (err)
      return res.send(err);
    res.json(teste);
  });
};
