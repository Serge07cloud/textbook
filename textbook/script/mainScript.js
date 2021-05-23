// Selectionner tous les checkbox
$('#all').click(function (){
    $('input[type=checkbox]').prop('checked', $(this).prop('checked'));
});