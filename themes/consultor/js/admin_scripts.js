$("[data-tipopessoa]").change(function (e) {
    e.preventDefault();

    clicked = $(this);
    value = clicked.val();

    if (value == "pj") {
        $(".label-pessoa").html("CNPJ <span style=\"font-variant: small-caps;color:#ccc; \"> * </span>")
        $(".numero-pessoa").mask("99.999.999/9999-99");
    }

    if (value == "pf") {
        $(".label-pessoa").html("CPF <span style=\"font-variant: small-caps;color:#ccc; \"> * </span>")
        $(".numero-pessoa").mask("999.999.999-99");
    }

    $(".numero-pessoa").val("");
})

$(".empresas").hide();

$(".btn-change-page").click(function (e) {
    e.preventDefault();
    clicked = $(this);
    page = clicked.data('page')

    $(".page").hide();

    $("."+page).fadeIn(500);

    console.log(page);
})