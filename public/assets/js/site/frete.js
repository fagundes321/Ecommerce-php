$(document).ready(function () {
    var center_content = $(".center_content");
    var btn_calcular_frete = center_content.find('#btn-calcular-frete');
    var input_frete = center_content.find('#input-frete');
    var mensagem_frete = center_content.find('#mensagem-frete');

    btn_calcular_frete.on('click', function (event) {
        event.preventDefault();

        var frete = input_frete.val().trim();

        if (frete === '') {
            mensagem_frete.html('Por favor, informe o CEP.').css('color', 'red');
            return;
        }

        mensagem_frete.html('Calculando o frete...').css('color', 'black');

        $.ajax({
            url: '/frete/calcular',
            type: 'POST',
            data: { frete: frete },
            dataType: 'json',
            success: function (retorno) {
                console.log('Resposta do servidor:', retorno);

                // ⚠️ Erros personalizados do backend
                if (retorno.erro === 'produto') {
                    mensagem_frete.html('Você precisa ter produtos no carrinho.').css('color', 'red');
                    return;
                }

                if (retorno.erro === 'cep_invalido') {
                    mensagem_frete.html('CEP inválido.').css('color', 'red');
                    return;
                }

                // ⚠️ Erros do Melhor Envio
                if (retorno.errors) {
                    const primeiroCampo = Object.keys(retorno.errors)[0];
                    let msgErro = retorno.errors[primeiroCampo][0]; // muda para let

                    // 🔹 Remove o trecho “to.postal_code” (ou qualquer campo similar)
                    msgErro = msgErro.replace(/\b[a-z_\.]*postal_code\b/gi, 'CEP').trim();

                    mensagem_frete.html(msgErro).css('color', 'red');
                    return;
                }


                // ✅ Resposta de sucesso (array de serviços)
                if (Array.isArray(retorno) && retorno.length > 0) {
                    const servico = retorno[0];
                    const imagem = Object.keys(servico.company)[2]
                    let imagemCorreios = servico.company[imagem]
                    mensagem_frete.html(
                        '<img src=' + imagemCorreios + '> ' +
                        '<br>Serviço: ' + (servico.name || 'Desconhecido') +
                        '<br>Preço: R$ ' + (servico.price || '0,00')
                    ).css('color', 'green');
                    return;
                }

                // ✅ Caso o retorno seja objeto com "message"
                if (typeof retorno === 'object' && retorno.message) {
                    mensagem_frete.html(retorno.message).css('color', 'red');
                    return;
                }

                // 🚨 Caso inesperado
                mensagem_frete.html('Não foi possível interpretar a resposta.').css('color', 'red');
            },
            error: function (xhr, status, error) {
                console.error('Erro:', error);
                mensagem_frete.html('Erro ao conectar com o servidor.').css('color', 'red');
            }
        });
    });
});
