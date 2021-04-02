$(document).ready(function () {

    $('.btn-disponibilidade').click(function (e) {

        e.preventDefault();
        var link = $('#link').val();
        var id_produto = $('#idProduto').val();
        var nome_produto = $('#nomeProduto').val();
        var ml_fabricar = $('#mlFabricar').val();

        $.ajax({
                type: "GET",
                url: link + '/produtos/disponibilidade-ingredientes/'+id_produto+'/'+ml_fabricar+'/'+nome_produto,
                dataType:"json",
                success: function (data) {

                    $("#load").hide();
                    if (data.status) {

                        alert(data.status);
                    }
                    else {

                        var finalizar_fabricacao = true;
                        $("#ingredienteDisponibilidade").html("");
                        $.each(data, function (index, ingrediente) {

                            if (ingrediente.pode_fabricar) {
                                pode_fabricar = "Sim";
                            }
                            else {
                                pode_fabricar = "Não";
                                finalizar_fabricacao = false;
                            }

                            tabela = "<tr><td>"+ingrediente.nome+"</td><td>"+ingrediente.necessario+"</td><td>"+ingrediente.estoque_ml+"</td><td>"+pode_fabricar+"</td></tr>";

                            $("#ingredienteDisponibilidade").append(tabela);
                        });
                    }

                    if (finalizar_fabricacao) {
                        $("#btnFinalizarFabricacao").show();
                    }
                    else {
                        $("#btnFinalizarFabricacao").hide();
                    }
                    console.log(data);


                },
                beforeSend: function () {
                    $("#load").show();
                },
                error: function (jq, status, message) {
                    console.log("Status: " + status + " - Message: " + message);
                },
            });
    });
});
