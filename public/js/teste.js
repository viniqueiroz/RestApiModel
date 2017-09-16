$(function() {
    $.ajax({
      type: 'GET',
      url: '/teste',
      success: function(result) {
        var teste;
        for (var i = 0; i< result.length; i++) {
            teste += '<h2>' + result[i].id + '</h2>';

        }
        $('#teste').html(teste);
      }
    });
});
