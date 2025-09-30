$(document).ready(function () {

    var main_content = $("#main_content");
    var center_content = main_content.find(".center_content");
    var shopping_cart = center_content.find("shopping_cart");
    var produts_cart = center_content.find("#products_cart");
    var price_cart = shopping_cart.find("price");
    var btn_add_carrinho = center_content.find(".add-carrinho");

    btn_add_carrinho.on('click', function(){
        console.log('add no carrinho');
    });
})