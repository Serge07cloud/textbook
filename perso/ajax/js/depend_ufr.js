$(document).ready(function(){

    let tag ="ufrList";
    let select_menu=$('#ufr_list')[0]; // this expression is same as document.getElementById('dynamic_menu')
    $.ajax({
        url:"perso/ajax/php/depend_ajax_ufr.php",
        dataType:"json",
        method:"post",
        data:{tag:tag},
        success:function(response){
            //alert(response.length);
            console.log(this.data)
            response.forEach((item,index)=>{
                var option = document.createElement("option");
                option.value = item['id_etablissement'];
                option.text = item['nom_etablissement'];
                select_menu.appendChild(option);
            })
        }
    })
});


function getItemUfList(ufr_id)
{
    let tag = "uflist";
    let itemMenu =$('#uf_list')[0];
    //Removing all the old options from item list and model list and adding only one option in one go
    $('#uf_list').empty().append('<option>Selectionner unite formation</option>');
    $.ajax({
        url:"perso/ajax/php/depend_ajax_ufr.php",
        dataType:"json",
        method:"post",
        data:{tag:tag,ufr_id:ufr_id},
        success:function(response){
            console.log(this.data)
            response.forEach((item,index)=>{
                var option = document.createElement("option");
                option.value = item['id_departement'];
                option.text = item['nom_departement'];
                itemMenu.appendChild(option);
            })
        }
    })
}

