$(document).ready(function () {

    $("#frm-cadastrar-produto").validate({
        errorClass: "invalid",
        ignore: [],
        rules: {
            nome: {
                required: true,
            },
            preco: {
                required: true,
                number:true
            },
            id_categoria: {
                required: true
            }
        },
        messages: {
            nome: {
                required: "Obrigatório",
            },
            preco: {
                required: "Obrigatório",
                number:"Número"
            },
            id_categoria: {
                required: "Obrigatório"
            }
        },
        invalidHandler: function (event, validator) {
            // 'this' refers to the form
            // var errors = validator.numberOfInvalids();
            // if (errors) {
            //     alert("Existem campos obrigatÃ³rios nÃ£o preenchidos!");
            // }
        },
    });

    $("#preco").focusout(function () {

        var preco = $(this).val();

        preco = preco.replace(".", "");

        preco = preco.replace(",", ".");

        var preco = parseFloat(preco);

        $("#preco").val(preco.toLocaleString('pt-br',{ minimumFractionDigits: 2 }));
    });

    $(".vincular-ingrediente").click(function (e) {

        e.preventDefault();

        $('#idIngrediente').val($(this).data('id-ingrediente'));
        $('#nomeIngrediente').val($(this).data('nome-ingrediente'));
        $('#nomeIngredienteModal').html('<b>' + $(this).data('nome-ingrediente') + '</b>');
        $('#modalIngrediente').modal();

    });

    $(".salvar-ingrediente-produto").click(function () {

        var link = $('#link').val();
        var id_ingred = $('#idIngrediente').val();
        var quanti = $('#qtdIngrediente').val();
        var und = $('#unidadeIngrediente').val();
        var nome_ingred = $('#nomeIngrediente').val();


        if ($('#qtdIngrediente').val() == '') {
            alert('Informe a quantidade');
        }


        $.ajax({
                type: "GET",
                url: link + '/produtos/ingredientes-temporario?id_ingrediente='+id_ingred+'&nome='+nome_ingred+'&quantidade='+quanti+'&unidade='+und,
                dataType:"json",
                success: function (data) {

                    if (data.status) {

                        alert(data.status);
                    }
                    else {

                        $("#ingredientesProduto").text("");
                        $.each(data, function (index, ingrediente) {

                            tabela = "<tr><td>"+ingrediente.nome+"</td><td>"+ingrediente.quantidade+"</td><td>"+ingrediente.unidade+"</td><td><a href='#' class='btn btn-warning btn-sm remover-ingrediente' data-remover-ingrediente='"+index+"'>Excluir</td></tr>";

                            $("#ingredientesProduto").append(tabela);
                        });
                    }

                    console.log(data);


                },
                beforeSend: function () {
                    // $(".icon-load-cep").show();
                },
                error: function (jq, status, message) {
                    console.log("Status: " + status + " - Message: " + message);
                },
            });

    });

    $(document).on('click', '.remover-ingrediente', function () {

        var link = $('#link').val();
        var posicao_ingrediente = $(this).data('remover-ingrediente');

        $.ajax({
                type: "GET",
                url: link + '/produtos/remover-ingrediente-temporario/'+posicao_ingrediente,
                dataType:"json",
                success: function (data) {

                    $("#ingredientesProduto").text("");
                    $.each(data, function (index, ingrediente) {

                        tabela = "<tr><td>"+ingrediente.nome+"</td><td>"+ingrediente.quantidade+"</td><td>"+ingrediente.unidade+"</td><td><a href='#' class='btn btn-warning btn-sm remover-ingrediente' data-remover-ingrediente='"+index+"'>Excluir</td></tr>";

                        $("#ingredientesProduto").append(tabela);
                    });


                },
                beforeSend: function () {
                    // $(".icon-load-cep").show();
                },
                error: function (jq, status, message) {
                    console.log("Status: " + status + " - Message: " + message);
                },
            });


    });

});
