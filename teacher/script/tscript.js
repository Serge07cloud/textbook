function showSpeciality(laboratory) {
    $('#speciality').load('./ajax/get_speciality.php', { laboratory : laboratory });
}

function showDepartment(institution) {
    $('#department').load('./ajax/get_department.php', { institution : institution });
}

function showLaboratory(department){
    $("#laboratory").load("./ajax/get_laboratory.php", { department : department });
}