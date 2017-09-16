var bookshelf = require('../../bookshelf');
var consorcios = require('./consorcio');

var tipoConsorcio = bookshelf.Model.extend({
  tableName: 'tipoconsorcio',
  consorcio: function() {
    return this.hasMany(consorcios);
  }
});

module.exports = tipoConsorcio;
