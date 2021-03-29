$(document).ready(function () {
    $("#cnpj").mask("99.999.999/9999-99", { reverse: true });
    $("#cep").mask("99.999-999", { reverse: true });
    $("#telefone1").mask("(99)99999-9999", { reverse: true });
    $("#telefone2").mask("(99)99999-9999", { reverse: true });
    $("#whatsapp1").mask("(99)99999-9999", { reverse: true });
    $("#whatsapp2").mask("(99)99999-9999", { reverse: true });

    $("#cep").change(function () {
        if ($(this).val().length == 10) {
            var cep = $(this).val();
            cep = cep.replace(".", "");
            cep = cep.replace("-", "");

            $.ajax({
                type: "GET",
                url: "https://viacep.com.br/ws/" + cep + "/json/",
                success: function (endereco) {
                    $(".icon-load-cep").hide();

                    if (endereco.erro) {
                        alert("Endereço não encontrado");
                        $("#rua").val("");
                        $("#bairro").val("");
                        $("#cidade").val("");
                        $("#estado").val("");
                    } else {
                        $("#rua").val(endereco.logradouro);
                        $("#bairro").val(endereco.bairro);
                        $("#cidade").val(endereco.localidade);
                        $("#estado").val(endereco.uf);
                    }
                },
                beforeSend: function () {
                    $(".icon-load-cep").show();
                },
                error: function (jq, status, message) {
                    console.log("Status: " + status + " - Message: " + message);
                },
            });
        }
    });

    function setEstados() {
        var link = $("#link").val() + "/igrejas/estados";

        $.ajax({
            type: "GET",
            url: link,
            dataType: "json",
            success: function (estados) {
                quantidadeDeEstados = estados.length;

                $("#id_estado").html("<option value=''></option>");

                $("#id_cidade").html("<option value=''></option>");

                for (i = 0; i < quantidadeDeEstados; i++) {
                    $("#id_estado").append(
                        "<option value='" +
                            estados[i].id +
                            "' selected>" +
                            estados[i].nome +
                            "</option>"
                    );
                }
                //chamo a funcao para setar por padrao as cidade do amazonas
            },
            beforeSend: function () {
                $("#id_estado").text("");
                $("#id_estado").append(
                    "<option value=''>Carregando..</option>"
                );
            },
            error: function (jq, status, message) {
                alert("Status: " + status + " - Message: " + message);
            },
        });
    }

    function setCidades(uf) {
        var idEstado = $("#id_estado option:selected").val();
        link = $("#link").val() + "/igrejas/cidades/" + idEstado;

        $.ajax({
            type: "GET",
            url: link,
            dataType: "json",
            success: function (cidades) {
                quantidadeDeCidades = cidades.length;

                $("#id_cidade").text("");

                for (i = 0; i < quantidadeDeCidades; i++) {
                    $("#id_cidade").append(
                        "<option value='" +
                            cidades[i].id +
                            "' >" +
                            cidades[i].nome +
                            "</option>"
                    );
                }
            },
            beforeSend: function () {
                $("#id_cidade").text("");
                $("#id_cidade").append(
                    "<option value=''>Carregando..</option>"
                );
            },
        });
    }

    $("#id_pais").change(function () {
        //se for diferente de Brasil
        if ($(this).val() != "34") {
            //caso o pais nao seja o brasil faz isso para o campo estado
            $("#id_estado").html(
                "<select class='form-control' name='id_estado' readonly><option value='99'>Exterior</option></select>"
            );
            $("#id_cidade").html(
                "<select class='form-control' name='id_cidade' readonly><option value='10867'>Exterior</option></select>"
            );
        } else {
            setEstados();
            setCidades(13);
        }
    });

    $("#id_estado").change(function () {
        var id_estado = $("#id_estado option:selected").val();

        setCidades(id_estado);
    });

    $("#frm-cadastrar-empresa").validate({
        errorClass: "invalid",
        ignore: [],
        rules: {
            nome_fantasia: {
                required: true,
            },
            segunda_hora_inicio:{
                required:"#segunda:checked"
            },
            segunda_hora_fim:{
                required:"#segunda:checked"
            },
            terca_hora_inicio:{
                required:"#terca:checked"
            },
            terca_hora_fim:{
                required:"#terca:checked"
            },
            quarta_hora_inicio:{
                required:"#quarta:checked"
            },
            quarta_hora_fim:{
                required:"#quarta:checked"
            },
            quinta_hora_inicio:{
                required:"#quinta:checked"
            },
            quinta_hora_fim:{
                required:"#quinta:checked"
            },
            sexta_hora_inicio:{
                required:"#sexta:checked"
            },
            sexta_hora_fim:{
                required:"#sexta:checked"
            },
            sabado_hora_inicio:{
                required:"#sabado:checked"
            },
            sabado_hora_fim:{
                required:"#sabado:checked"
            },
            domingo_hora_inicio:{
                required:"#domingo:checked"
            },
            domingo_hora_fim:{
                required:"#domingo:checked"
            }

        },
        messages: {
            nome_fantasia: {
                required: "Obrigatório",
            },
            segunda_hora_inicio:{
                required:"Obrigatório"
            },
            segunda_hora_fim:{
                required:"Obrigatório"
            },
            terca_hora_inicio:{
                required:"Obrigatório"
            },
            terca_hora_fim:{
                required:"Obrigatório"
            },
            quarta_hora_inicio:{
                required:"Obrigatório"
            },
            quarta_hora_fim:{
                required:"Obrigatório"
            },
            quinta_hora_inicio:{
                required:"Obrigatório"
            },
            quinta_hora_fim:{
                required:"Obrigatório"
            },
            sexta_hora_inicio:{
                required:"Obrigatório"
            },
            sexta_hora_fim:{
                required:"Obrigatório"
            },
            sabado_hora_inicio:{
                required:"Obrigatório"
            },
            sabado_hora_fim:{
                required:"Obrigatório"
            },
            domingo_hora_inicio:{
                required:"Obrigatório"
            },
            domingo_hora_fim:{
                required:"Obrigatório"
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

    $("#frm-edicao-igreja").validate({
        errorClass: "invalid",
        ignore: [],
        rules: {
            nome_fantasia: {
                required: true,
            },
            cnpj: {
                remote: {
                    url:
                        $("#link").val() +
                        "/igrejas/buscar-cnpj/" +
                        "?idigreja=" +
                        $("#id_igreja").val(),
                    dataFilter: function (data) {
                        consulta = jQuery.parseJSON(data);
                        console.log(consulta.status);

                        if (consulta.status) {
                            return false;
                        } else {
                            return true;
                        }
                    },
                },
            },
        },
        messages: {
            nome_fantasia: {
                required: "Obrigatório",
            },

            cnpj: {
                remote: "CNPJ informado já existe",
            },
        },
        invalidHandler: function (event, validator) {
            // 'this' refers to the form
            // var errors = validator.numberOfInvalids();
            // if (errors) {
            //     alert("Existem campos obrigatÃ³rios nÃ£o preenchidos!");
            // }
        },
    });

    $("#segunda").click(function () {

        if ($(this).is(':checked')) {

            $("#hora_segunda").show();
        }
        else {
            $("#hora_segunda").hide();
        }
    });
    $("#terca").click(function () {

        if ($(this).is(':checked')) {

            $("#hora_terca").show();
        }
        else {
            $("#hora_terca").hide();
        }
    });
    $("#quarta").click(function () {

        if ($(this).is(':checked')) {

            $("#hora_quarta").show();
        }
        else {
            $("#hora_quarta").hide();
        }
    });
    $("#quinta").click(function () {

        if ($(this).is(':checked')) {

            $("#hora_quinta").show();
        }
        else {
            $("#hora_quinta").hide();
        }
    });
    $("#sexta").click(function () {

        if ($(this).is(':checked')) {

            $("#hora_sexta").show();
        }
        else {
            $("#hora_sexta").hide();
        }
    });
    $("#sabado").click(function () {

        if ($(this).is(':checked')) {

            $("#hora_sabado").show();
        }
        else {
            $("#hora_sabado").hide();
        }
    });
    $("#domingo").click(function () {

        if ($(this).is(':checked')) {

            $("#hora_domingo").show();
        }
        else {
            $("#hora_domingo").hide();
        }
    });
});
