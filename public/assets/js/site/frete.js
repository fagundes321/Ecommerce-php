$(document).ready(function () {
    var center_content = $(".center_content");
    var btn_calcular_frete = center_content.find('#btn-calcular-frete');
    var input_frete = center_content.find('#input-frete');
    var mensagem_frete = center_content.find('#mensagem-frete');

    // helper pra formatar preço
    function formatBRL(valor) {
        const n = Number(valor);
        if (isNaN(n)) return 'R$ 0,00';
        return n.toLocaleString('pt-BR', {
            style: 'currency',
            currency: 'BRL',
            minimumFractionDigits: 2
        });
    }

    // clique no botão "Calcular frete"
    btn_calcular_frete.on('click', function (event) {
        event.preventDefault();

        var frete = input_frete.val().trim();

        if (frete === '') {
            mensagem_frete.html('Por favor, informe o CEP.').css('color', 'red');
            return;
        }

        mensagem_frete
            .html('Calculando o frete <img src="/public/assets/images/icons/reload.gif" style="width: 15px;">')
            .css('color', 'black');

        $.ajax({
            url: '/frete/calcular',
            type: 'POST',
            data: { frete: frete },
            dataType: 'json',
            success: function (retorno) {
                console.log('Resposta do servidor:', retorno);

                // ⚠️ Erros personalizados do backend
                if (retorno && retorno.erro === 'produto') {
                    mensagem_frete.html('Você precisa ter produtos no carrinho.').css('color', 'red');
                    return;
                }

                if (retorno && retorno.erro === 'cep_invalido') {
                    mensagem_frete.html('CEP inválido.').css('color', 'red');
                    return;
                }

                // ⚠️ Erros do Melhor Envio
                if (retorno && retorno.errors) {
                    const primeiroCampo = Object.keys(retorno.errors)[0];
                    let msgErro = retorno.errors[primeiroCampo][0];

                    // tira o nome do campo técnico e troca por "CEP"
                    msgErro = msgErro.replace(/\b[a-z_\.]*postal_code\b/gi, 'CEP').trim();

                    mensagem_frete.html(msgErro).css('color', 'red');
                    return;
                }

                // ✅ Resposta de sucesso (array de serviços) – até 3 opções
                if (Array.isArray(retorno) && retorno.length > 0) {
                    let html = `
                        <div style="
                            margin-bottom:8px;
                            font-weight:bold;
                            font-size:14px;
                        ">
                            Opções de frete encontradas:
                        </div>
                        <div class="frete-opcoes-container" style="
                            display:flex;
                            flex-direction:column;
                            gap:10px;
                        ">
                    `;

                    retorno.slice(0, 3).forEach(function (servico, index) {
                        const imagem = servico.company?.picture || '';
                        const precoBruto = servico.price || '0';
                        const preco = formatBRL(precoBruto);
                        const nome = servico.name || 'Serviço';
                        const empresa = servico.company?.name || 'Transportadora';

                        const prazo = servico.custom_delivery_range
                            ? `${servico.custom_delivery_range.min}–${servico.custom_delivery_range.max} dias úteis`
                            : (servico.delivery_time ? `${servico.delivery_time} dias úteis` : 'Prazo indisponível');

                        html += `
                            <label class="frete-opcao" style="
                                display:flex;
                                align-items:center;
                                gap:12px;
                                padding:10px 12px;
                                border:1px solid #ddd;
                                border-radius:8px;
                                background:#fafafa;
                                box-shadow:0 1px 3px rgba(0,0,0,0.05);
                                cursor:pointer;
                            ">
                                <input 
                                    type="radio" 
                                    name="frete_opcao" 
                                    value="${servico.id}"
                                    data-nome="${nome}"
                                    data-preco="${precoBruto}"
                                    data-prazo="${prazo}"
                                    style="margin-right:8px;"
                                    ${index === 0 ? 'checked' : ''}
                                >

                                ${imagem
                                    ? `<img src="${imagem}" alt="${empresa}" style="height:28px; flex-shrink:0;">`
                                    : `<div style="
                                          width:28px;
                                          height:28px;
                                          border-radius:50%;
                                          background:#eee;
                                          display:flex;
                                          align-items:center;
                                          justify-content:center;
                                          font-size:14px;
                                      ">
                                          🚚
                                      </div>`
                                }
                                <div style="display:flex; flex-direction:column; gap:2px;">
                                    <span style="font-weight:600; font-size:14px;">
                                        ${empresa} — ${nome}
                                    </span>
                                    <span style="font-size:13px; color:#333;">
                                        <strong>Preço:</strong> ${preco}
                                    </span>
                                    <span style="font-size:12px; color:#666;">
                                        <strong>Prazo:</strong> ${prazo}
                                    </span>
                                </div>
                            </label>
                        `;
                    });

                    html += `</div>`;

                    mensagem_frete.html(html).css('color', 'black');
                    return;
                }

                // ✅ Caso o retorno seja objeto com "message"
                if (typeof retorno === 'object' && retorno !== null && retorno.message) {
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

    // quando o usuário selecionar uma opção de frete
    $(document).on('change', 'input[name="frete_opcao"]', function () {
        const radio = $(this);
        const preco = radio.data('preco');
        const nome = radio.data('nome');
        const prazo = radio.data('prazo');

        console.log('Frete selecionado:', { preco, nome, prazo });

        // opcional: feedback na própria div
        // (limpa mensagens antigas extra e adiciona uma linha de confirmação)
        $('.frete-opcao-selecionada-msg').remove();
        mensagem_frete.append(
            `<div class="frete-opcao-selecionada-msg" style="margin-top:6px; font-size:12px; color:#555;">
                Frete selecionado: ${formatBRL(preco)} — ${prazo}
             </div>`
        );

        // envia para o backend gravar na sessão
        $.ajax({
            url: '/frete/selecionar',
            type: 'POST',
            dataType: 'json',
            data: { preco: preco },
            success: function (resp) {
                console.log('Frete gravado na sessão:', resp);
            },
            error: function () {
                console.error('Erro ao gravar frete');
            }
        });
    });
});
