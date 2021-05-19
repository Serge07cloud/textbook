$(document).ready(function () {
    $("#id_etablissement").on("change", function () {
        var id_etablissement = $(this).val();
        $.ajax({
            url: "fetch/fetch_departement.php",
            method: 'GET',
            data: {id_etablissement: id_etablissement},
            success: function (data) {
                $("#id_departement").html(data);
                var id_departement = $("#id_departement").val();
                $.ajax({
                    url: "fetch/fetch_niveau.php",
                    method: 'GET',
                    data: {id_departement: id_departement},
                    success: function (data) {
                        $("#id_diplome").html(data);
                        var id_diplome = $("#id_diplome").val();
                        $.ajax({
                            url: "fetch/fetch_parcours.php",
                            method: 'GET',
                            data: {id_departement: id_departement,id_diplome:id_diplome},
                            success: function (data) {
                                $("#id_parcours").html(data);
                                /* parcours */
                                var id_parcours = $("#id_parcours").val();
                                $.ajax({
                                    url: "fetch/fetch_mention.php",
                                    method: 'GET',
                                    data: {id_parcours: id_parcours},
                                    success: function (data) {
                                        $("#id_mention").html(data);
                                    }
                                });
                            }
                        });
                    }
                });
            }
        });
    }).trigger("change");
    $("#id_departement").on("change", function () {
        var id_departement = $(this).val();
        var id_diplome = $("#id_diplome").val();
        $.ajax({
            url: "fetch/fetch_parcours.php",
            method: 'GET',
            data: {id_departement: id_departement,id_diplome:id_diplome},
            success: function (data) {
                $("#id_parcours").html(data);
                /* parcours */
                var id_parcours = $("#id_parcours").val();
                $.ajax({
                    url: "fetch/fetch_mention.php",
                    method: 'GET',
                    data: {id_parcours: id_parcours},
                    success: function (data) {
                        $("#id_mention").html(data);
                    }
                });

            }
        });
    }).trigger("change");


    $("#id_diplome").on("change", function () {
        var id_diplome = $(this).val();
        var id_departement = $("#id_departement").val();
        $.ajax({
            url: "fetch/fetch_parcours.php",
            method: 'GET',
            data: {id_departement: id_departement,id_diplome:id_diplome},
            success: function (data) {
                $("#id_parcours").html(data);
                /* parcours */
                var id_parcours = $("#id_parcours").val();
                $.ajax({
                    url: "fetch/fetch_mention.php",
                    method: 'GET',
                    data: {id_parcours: id_parcours},
                    success: function (data) {
                        $("#id_mention").html(data);
                    }
                });

            }
        });
    }).trigger("change");


    $("#id_parcours").on("change", function () {
        var id_parcours = $(this).val();
        $.ajax({
            url: "fetch/fetch_mention.php",
            method: 'GET',
            data: {id_parcours: id_parcours},
            success: function (data) {
                $("#id_mention").html(data);
            }
        });
    });



    $(document).ready(function () {
        $('.userinfo').click(function () {
            var userid = $(this).data('id');
            $('#empModal').modal('show');
        });
    });

});
