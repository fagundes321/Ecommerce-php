$(document).ready(function (){
    var main_content = $("#main_content");
    var center_content = main_content.find(".center_content");
    var btn_calcular_frete = center_content.find('#btn-calcular-frete');

    btn_calcular_frete.on('click', function(event){
        event.preventDefault();
        console.log('calcular frete');
    })
});