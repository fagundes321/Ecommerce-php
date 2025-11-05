$(document).ready(function () {

    var btn_calcular_frete = $('#btn-calcular-frete');
    var mensagem_frete = $('#mensagem-frete');

    btn_calcular_frete.on('click', function (event) {
        event.preventDefault();

        var cep = $('#input-frete').val().trim();

        if (cep === '') {
            mensagem_frete.text('Por favor, informe o CEP.').css('color', 'red');
            return;
        }

        mensagem_frete.text('Calculando frete...').css('color', 'black');

        $.ajax({
            url: '/frete/calcular',
            type: 'POST',
            data: { frete: cep },  // <--- AGORA ENVIA O CEP CORRETAMENTE
            dataType: 'json',
            beforeSend: function () {
                mensagem_frete.text('Calculando frete...');
            },
            success: function (retorno) {
                console.log('Resposta do backend:', retorno);

                if (retorno.sucesso) {
                    mensagem_frete.text('Frete: R$ ' + retorno.valor).css('color', 'green');
                } else {
                    mensagem_frete.text('Não foi possível calcular o frete.').css('color', 'red');
                }
            },
            error: function () {
                mensagem_frete.text('Erro ao conectar com o servidor.').css('color', 'red');
            }
        });
    });
});
