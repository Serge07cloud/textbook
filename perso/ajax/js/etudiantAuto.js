$(document).ready(function(){
    $("#numCarte").keyup(function(){
        $.ajax({
            type: "POST",
            url: "perso/ajax/php/AjaxEtudiantAuto.php",
            data:'keyword='+$(this).val(),
            beforeSend: function(){
                $("#numCarte").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");
            },
            success: function(data){
                $("#suggesstion-box").show();
                $("#suggesstion-box").html(data);
                $("#numCarte").css("background","#FFF");
            }
        });
    });
});
//To select country name
function selectEtudiant(val) {
    $("#numCarte").val(val);
    $("#suggesstion-box").hide();
}
