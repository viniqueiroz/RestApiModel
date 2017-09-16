var bookshelf = require('../../bookshelf');

var User = bookshelf.Model.extend({
  tableName: 'usuario'
});

module.exports = User;
