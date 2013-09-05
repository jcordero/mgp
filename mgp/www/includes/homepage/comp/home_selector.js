$(document).ready(function(){
   $('#appmenu').width( $('#appmenu').width() - 40);
   $('#home_selector').click(function(){
       var pos = $(this).position();
       var w = $('#home_selector_panel').width();
       pos.left = pos.left - w + 32;
       $('#home_selector_panel').css('left',pos.left).toggleClass("hide");
   }); 
});

function cambio_home(s) {
    document.location.href = "./index.php?h=" + $(s).val();
}