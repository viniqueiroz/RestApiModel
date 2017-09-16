var bookshelf = require('../../bookshelf');
var tipoConsorcio = require('./tipoConsorcio');

var Consorcio = bookshelf.Model.extend({
  tableName: 'consorcios',
  tipoConsorcio: function() {
    return this.belongsTo(tipoConsorcio);
  }
});

module.exports = Consorcio;
