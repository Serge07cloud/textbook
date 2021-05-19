var loadData;
$(document).ready(function () {


    /* charger les données du tableau */
    loadData = function loadData(page) {
        var formdata = $("#form-data").serializeArray();
        console.log(formdata)
        $.ajax({
            url: "ajax/pv_annuel.php",
            type: "POST",
            cache: false,
            data: {page_no: page, form: formdata},
            beforeSend: function () {
                $("#table-data").hide();
                $('#spinner').removeClass("d-none").show();
                $('#spinner-text').removeClass("d-none").show();

                $('#consulter').attr('disabled', true);
                $('#imprimer').attr('disabled', true);
            },
            success: function (response) {
                $("#table-data").html(response);
            },
            complete: function (response) {
                $("#table-data").show();
                $('#spinner').addClass("d-none");
                $('#spinner-text').addClass("d-none");
                $('#consulter').attr('disabled', false);
                $('#imprimer').attr('disabled', false);
            }
        });
    }


    /* Pagination code */
    $(document).on("click", "#consulter", function (e) {
        e.preventDefault();
        /* par défault on charge la page 1 quand on clique sur consulter */
        loadData(1);
    });

    /* taille de la police d'écriture */
    $(document).on("change", "#taille_police", function (e) {
        var taille = parseInt($(this).val());
        $("#table").css('font-size', taille);
        e.preventDefault();
    });
});


