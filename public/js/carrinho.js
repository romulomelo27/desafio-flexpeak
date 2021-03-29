$(document).ready(function () {

    $('.add-item').click(function (e) {

        e.preventDefault();
        var id_produto = $(this).data('id-produto');
        var link = $('#url').attr('href');
        if ($(this).data('key-produto-atualizar') != undefined) {

            key_produto_atualizar = $(this).data('key-produto-atualizar');
        }
        else {
            key_produto_atualizar = null;
        }

        $.ajax({
                type: "GET",
                url: link + '/carrinho/adicionar-item-pedido/'+id_produto,
                dataType:"json",
                success: function (data) {

                    var preco = parseFloat(data.valor_pedido);

                    $("#valorCarrinho").text('R$' + preco.toLocaleString('pt-br', { minimumFractionDigits: 2 }));

                    //atualizacoes da pagina do carrinho
                    if ((key_produto_atualizar != undefined) && (key_produto_atualizar != null)) {

                        atualizarDadoPaginaDoCarrinho(key_produto_atualizar, data.valor_pedido);
                    }

                    M.toast({html: 'Adicionado no carrinho'})

                    // console.log(data);

                },
                beforeSend: function () {
                    $(".icon-load-cep").show();
                },
                error: function (jq, status, message) {
                    console.log("Status: " + status + " - Message: " + message);
                },
            });
    });

    $('.remove-item').click(function () {

        var id_produto_remover = $(this).data('id-produto-remover');
        var nome_produto_remover = $(this).data('nome-produto-remover');
        var link = $('#url').attr('href') + '/carrinho/remover-item-pedido/' + id_produto_remover;

        $('#link-remover-produto').attr('href', link);
        $('#nome-produto-remover').text('Remover '+nome_produto_remover+' ?');

    });

    function atualizarDadoPaginaDoCarrinho(key_produto_atualizar, sub_total){

        var link = $('#url').attr('href');

        $.ajax({
                type: "GET",
                url: link + '/carrinho/itens-pedido/',
                dataType:"json",
            success: function (data) {

                $('#quantidade-produto-' + key_produto_atualizar).text(data[key_produto_atualizar].quantidade);

                var preco_total = parseFloat(data[key_produto_atualizar].preco_total);
                $('#preco-total-produto-' + key_produto_atualizar).text(preco_total.toLocaleString('pt-br', { minimumFractionDigits: 2 }));

                sub_total = parseFloat(sub_total);
                $('#sub-total-carrinho').text('R$' + sub_total.toLocaleString('pt-br', { minimumFractionDigits: 2 }));
                $('#total-carrinho').text('R$' + sub_total.toLocaleString('pt-br', { minimumFractionDigits: 2 }));
                    // console.log(data[key_produto_atualizar].quantidade);

                },
                beforeSend: function () {
                    $(".icon-load-cep").show();
                },
                error: function (jq, status, message) {
                    console.log("Status: " + status + " - Message: " + message);
                },
            });
    }

    $('.mininuir-item').click(function (e) {

        e.preventDefault();
        var link = $('#url').attr('href');
        var key_produto_atualizar = $(this).data('key-produto-atualizar');

        $.ajax({
                type: "GET",
                url: link + '/carrinho/diminuir-quantidade-item/'+key_produto_atualizar,
                dataType:"json",
                success: function (data) {

                    var preco = parseFloat(data.valor_pedido);

                    $("#valorCarrinho").text('R$' + preco.toLocaleString('pt-br', { minimumFractionDigits: 2 }));

                    //atualizacoes da pagina do carrinho
                    atualizarDadoPaginaDoCarrinho(key_produto_atualizar, data.valor_pedido);

                    M.toast({html: 'Quantidade atualizada'})

                    // console.log(data);

                },
                beforeSend: function () {
                    $(".icon-load-cep").show();
                },
                error: function (jq, status, message) {
                    console.log("Status: " + status + " - Message: " + message);
                },
            });

    });

});
