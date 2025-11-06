$(document).ready(function () {

    var center_content = $(".center_content");
    // var shopping_cart = center_content.find(".main-detalhes");
    var btn_calcular_frete = center_content.find('#btn-calcular-frete');
    var input_frete = center_content.find('#input-frete');
    var mensagem_frete = center_content.find('#mensagem-frete');

    // var btn_calcular_frete = $('#btn-calcular-frete');
    // var mensagem_frete = $('#mensagem-frete');

    btn_calcular_frete.on('click', function (event) {
        event.preventDefault();

        var frete = input_frete.val();
        $.ajax({
            url: '/frete/calcular',
            type: 'post',
            data: 'frete='+frete,
            dataType: 'json',
            beforeSend: function () {
                if (frete === '') {
                    mensagem_frete.html('Por favor, informe o CEP.').css('color', 'red');
                    return false; //
                }

                mensagem_frete.html('Calculando o frete...').css('color', 'black');

            },
            success: function (retorno) {
                console.log(retorno)
                if (retorno == 'produto') {
                    mensagem_frete.html('Você precisa ter produtos no carrinho.').css('color', 'red');
                    return;
                }

            }
        });




        // var cep = $('#input-frete').val().trim();

        // if (cep === '') {
        //     mensagem_frete.text('Por favor, informe o CEP.').css('color', 'red');
        //     return;
        // }

        // mensagem_frete.text('Calculando frete...').css('color', 'black');

        // $.ajax({
        //     url: '/frete/calcular',
        //     type: 'POST',
        //     data: { frete: cep },  // <--- AGORA ENVIA O CEP CORRETAMENTE
        //     dataType: 'json',
        //     beforeSend: function () {
        //         mensagem_frete.text('Calculando frete...');
        //     },
        //     success: function (retorno) {
        //         console.log('Resposta do backend:', retorno);

        //         if (retorno.sucesso) {
        //             mensagem_frete.text('Frete: R$ ' + retorno.valor).css('color', 'green');
        //         } else {
        //             mensagem_frete.text('Não foi possível calcular o frete.').css('color', 'red');
        //         }
        //     },
        //     error: function () {
        //         mensagem_frete.text('Erro ao conectar com o servidor.').css('color', 'red');
        //     }
        // });
    });
});
