$(document).ready(function () {

    /* HOME */
    const HOME = $("link[rel='base']").attr("href");

    const ajax_function = (url, dataset) => {

        let clicked = $("#btn_clicked");
        let text = clicked.val();

        $.ajax({
            url: url,
            data: dataset,
            type: 'POST',
            dataType: 'json',
            beforeSend: function () {
                /* exibir classe loading */
                clicked.val('AGUARDE...')
            },
            success: function (response) {

                $(".loading").fadeOut(400).css("display", "none");

                if (response.error) {
                    $(".loadResult").html(response.error);
                    // jqueryAlert("fa fa-times-circle", "Erro", response.error, "dark", "Fechar");
                }

                if (response.warning) {
                    // $(".loadResult").html(response.error);
                    jqueryAlert("fa fa-warning", "Atenção", response.warning, "orange", "Ok");
                }

                if (response.info) {
                    // $(".loadResult").html(response.error);
                    jqueryAlert("fa fa-info-circle", "Informação", response.info, "blue", "Ok");
                }

                if (response.assincronus) {
                    $(".loadResponse").html(response.assincronus);
                }

                if (response.assincronus_options) {
                    $(".loadResponseOptions").html(response.assincronus_options);
                }

                if (response.success) {

                    $(".loadResult").html(response.success);
                    // jqueryAlert("fa fa-check", "Sucesso", response.success, "green", "Ok");

                    if ($("#" + form).hasClass("reset")) {
                        $("#" + form).each(function () {
                            this.reset();
                        });
                    }
                }

                if (response.redirect) {
                    setTimeout(function () {
                        window.location.href = response.redirect;
                    }, 1000);
                }

                if (response.successRedirect) {
                    // setTimeout(function () {
                    //     window.location.href = response.redirect;
                    // }, 1000);
                    jqueryAlert("fa fa-check", "Sucesso", response.successRedirect, "green", "Continuar...", true, response.after_redirect);

                }

                if (response.reload) {
                    window.location.reload();
                }

            },
            complete: function (response) {

                clicked.val(text);

                if (response.redirect) {
                    window.location.href = response.redirect;
                }

                console.clear();

            }
        });

    }

    const SwalFire = (text, icon, confirmButtonText = "Ok", cancelButtonText = "Cancelar", customClassConfirmButton = 'primary', customClassCancelButton ='danger') => {
        Swal.fire({
            text: text,
            icon: icon, // success, error, warning, info, question
            buttonsStyling: false,
            confirmButtonText: confirmButtonText,
            cancelButtonText: cancelButtonText,
            showCancelButton: true,
            customClass: {
                confirmButton: "btn btn-"+customClassConfirmButton,
                cancelButton: "btn btn-"+customClassCancelButton
            }
        }).then(function (result) {
            console.log(result)
            if (result.isConfirmed) {
                console.log('Confirmado')
                return
            }
            if (result.isDenied) {
                console.log('Negado')
                return
            }
            if (result.isDismissed) {
                console.log('Cancelado')
            }
        });
    }

    $("form.upload").on("submit", function (e) {
        e.preventDefault();
        var url = $(this).attr("action");
        var_texto = $("#txtEditor").val()

        $.ajax({
            url: url,
            xhr: function () {
                var xhr = new window.XMLHttpRequest();
                //Upload progress
                xhr.upload.addEventListener("progress", function (evt) {
                    if (evt.lengthComputable) {
                        var percentComplete = evt.loaded / evt.total;
                        //Do something with upload progress
                        var loaded = percentComplete;
                        var load_title = $(".percent");
                        load_title.text((loaded * 100).toFixed(1) + "%");

                        form.find("input[type='file']").val(null);
                        if (percentComplete >= 100) {
                            load_title.text("Aguarde, carregando...");
                        }
                    }
                }, false);
                //Download progress
                xhr.addEventListener("progress", function (evt) {
                    if (evt.lengthComputable) {
                        var percentComplete = evt.loaded / evt.total;
                        //Do something with download progress
                        var loaded = completed;
                        var load_title = $(".percent");
                        load_title.text(loaded + "%)");

                        form.find("input[type='file']").val(null);
                        if (completed >= 100) {
                            load_title.text("Aguarde, carregando...");
                        }
                    }
                }, false);
                return xhr;
            },
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            dataType: 'json',
            beforeSend: function () {
                /* exibir classe loading */
                $(".loading").fadeIn(400).css("display", "flex");
            },
            error: function (erro) {
                console.log(erro)
            },
            success: function (response) {
                $(".loading").fadeOut(400).css("display", "none");

                if (response.error) {
                    $(".loadResult").html(response.error);
                    // jqueryAlert("fa fa-times-circle", "Erro", response.error, "dark", "Fechar");
                }

                if (response.warning) {
                    // $(".loadResult").html(response.error);
                    jqueryAlert("fa fa-warning", "Atenção", response.warning, "orange", "Ok");
                }

                if (response.info) {
                    // $(".loadResult").html(response.error);
                    jqueryAlert("fa fa-info-circle", "Informação", response.info, "blue", "Ok");
                }

                if (response.assincronus) {
                    $(".loadResponse").html(response.assincronus);
                }

                if (response.assincronus_options) {
                    $(".loadResponseOptions").html(response.assincronus_options);
                }


                if (response.success) {

                    $(".loadResult").html(response.success);
                    // jqueryAlert("fa fa-check", "Sucesso", response.success, "green", "Ok");

                    if ($("#" + form).hasClass("reset")) {
                        $("#" + form).each(function () {
                            this.reset();
                        });
                    }
                }

                if (response.redirect) {
                    setTimeout(function () {
                        window.location.href = response.redirect;
                    }, 1000);
                }

                if (response.successRedirect) {
                    // setTimeout(function () {
                    //     window.location.href = response.redirect;
                    // }, 1000);
                    jqueryAlert("fa fa-check", "Sucesso", response.successRedirect, "green", "Continuar...", true, response.after_redirect);

                }

                if (response.reload) {
                    window.location.reload();
                }
            },
            complete: function () {
                clicked.val(text);
                $(".loading").fadeOut(400).css("display", "none");

                if (response.redirect) {
                    window.location.href = response.redirect;
                }

                console.clear();
            }
        });

        return false;
    });

    $("form:not('.upload')").on("submit", function (e) {
        /**
         * Formas de retorno:
         * redirect => Redirecionando para página de sucesso
         * assincronus => Carregando em parte do documento
         * success => Sweetalert de sucesso e reset no form
         * error => Sweet alert
         */
        e.preventDefault();

        var url = $(this).attr("action");

        var dataset = $(this).serialize();

        var form = $(this).attr("id");

        ajax_function(url, dataset)

    });


    /***********************
     *** SOMENTE NÚMEROS ***
     ***********************/
    $("input.numero").on('keydown', function (e) {

        var size = $(this).val().length;
        var limit = $(this).attr("limit");
        var value = $(this).val();

        if (size > limit) {
            $(this).val(value.substring(0, limit));
        }

        var keyCode = e.keyCode || e.which,
            pattern = /\d/,
            // Permite somente Backspace, Delete e as setas direita e esquerda, números do teclado numérico - 96 a 105 - (além dos números)
            keys = [46, 8, 9, 37, 39, 96, 97, 98, 99, 100, 101, 102, 103, 104, 105];

        if (!pattern.test(String.fromCharCode(keyCode)) && $.inArray(keyCode, keys) === -1) {
            return false;
        }

    });

    /********************
     *** MASK ELEMENTS ***
     *********************/

    $('.mask_cnpj').mask("99.999.999/9999-99");
    $('.mask_cpf').mask("999.999.999-99");
    $('.mask_whatsapp_atendimento').mask("99999999999");
    $('.mask_telefone').mask("(99) 9999-99999");
    $('.mask_celular').mask("(99) 99999-9999");
    $('.mask_cep').mask("99999-999");
    $('.mask_uf').mask("AA");
    $('.mask_horario').mask("99h99");
    $('.mask_data').mask("99/99/9999");

    $(".maskMoney").maskMoney({showSymbol: false, symbol: "R$", decimal: ".", thousands: ""});


    /**************************
     *** BUSCANDO CEP NA WEB ***
     ***************************/
    function clean_zip_form() {
        // Limpa valores do formulário de cep.
        $("#rua").val("");
        $("#logradouro").val("");
        $("#municipio").val("");
        $("#bairro").val("");
        $("#uf").val("");
    }


    //Quando o campo cep perde o foco.
    $("#cep").blur(function () {

        //Nova variável "cep" somente com dígitos.
        const cep = $(this).val().replace(/\D/g, '');

        //Verifica se campo cep possui valor informado.
        if ( cep !== "" ) {

            //Expressão regular para validar o CEP.
            let validacep = /^[0-9]{8}$/;

            //Valida o formato do CEP.
            if (validacep.test(cep)) {

                //Preenche os campos com "..." enquanto consulta webservice.
                $("#logradouro").css("background-color", "#eee").val("...");
                $("#bairro").css("background-color", "#eee").val("...");
                $("#municipio").css("background-color", "#eee").val("...");
                $("#uf").css("background-color", "#eee").val("...");

                //Consulta o webservice viacep.com.br/
                $.getJSON("https://viacep.com.br/ws/" + cep + "/json/?callback=?", function (dados) {

                    if (!("erro" in dados)) {
                        //Atualiza os campos com os valores da consulta.
                        $("#logradouro").css("background-color", "#fff").val(dados.logradouro);
                        $("#bairro").css("background-color", "#fff").val(dados.bairro);
                        $("#municipio").css("background-color", "#fff").val(dados.localidade);
                        $("#uf").css("background-color", "#fff").val(dados.uf);


                    } //end if.
                    else {
                        //CEP pesquisado não foi encontrado.
                        clean_zip_form();
                    }
                });
            } //end if.
            else {
                //cep é inválido.
                clean_zip_form();
            }
        } //end if.
        else {
            //cep sem valor, limpa formulário.
            clean_zip_form();
        }
    });


})
