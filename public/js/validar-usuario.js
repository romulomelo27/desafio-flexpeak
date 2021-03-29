$(document).ready(function () {
    $("#btn-novo-usuario").click(function () {
        $("#frm-cadastrar-usuario").validate({
            errorClass: "invalid",
            ignore: [], //valida campos ocultos
            rules: {
                name: {
                    required: true
                },
                email: {
                    required: true
                },
                password: {
                    required: true
                },
                confirme_password: {
                    required: true,
                    equalTo:"#password"
                },
            },
            messages: {

                name: {
                    required: "Obrigatório"
                },
                email: {
                    required: "Obrigatório"
                },
                password: {
                    required: "Obrigatório"
                },
                confirme_password: {
                    required: "Obrigatório",
                    equalTo:"A senha não confere"
                },

            },
        });
    });
});
