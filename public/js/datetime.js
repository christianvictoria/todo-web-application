$(function(){
    $("#date_link").on('click', function(e){
        e.preventDefault();
        $("#date:hidden").trigger('click');
    });
    console.log('click');
});