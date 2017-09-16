$(document).ready(function(){
   $.getJSON( "/consorcios", function( consorcios ) {

       var obj = jQuery.parseJSON(consorcios);

       alert(consorcios);
       // como você tem uma lista, provavelmente irá usar um index para
       // obj.value[0] ou obj.value[1]
    })
});
