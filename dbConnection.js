var mysqlModel = require('mysql-model');

var connection = mysqlModel.createConnection({
  host     : 'localhost',
  user     : 'root',
  password : '',
  database : 'ibpc'
});


module.exports = {
   Teste: connection.extend({
      tableName: "teste"

  }),
  Usuario: connection.extend({
tableName: "usuario"

  })

};
