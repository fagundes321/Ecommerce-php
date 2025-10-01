$(document).ready(function () {
    var center_content = $(".center_content");
    var shopping_cart = center_content.find(".main-detalhes");
    var produts_cart = $("#products_cart"); // se existir em outro lugar
    var price_cart = shopping_cart.find(".price"); // precisa ter classe/ID "price" no HTML
    var btn_add_carrinho = center_content.find(".add-carrinho");

    btn_add_carrinho.on('click', function () {

        var idProduto = $(this).attr('data-id');
        console.log(idProduto);

        $.ajax({
            url:'/carrinho/add/'+idProduto,
            type:'POST',
            success:function(retorno){
                // console.log(retorno)
            }
        })
    });
});
