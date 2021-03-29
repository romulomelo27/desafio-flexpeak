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



});
