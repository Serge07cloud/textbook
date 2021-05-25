function onFormSubmit(form){
    const data = {
        "teacher"       : $("#teacher").val(),
        "ue"            : form.ue.value,
        "ecue"          : form.ecue.value,
        "niveau"        : form.grade.value,
        "specialite"    : form.career.value,
        "department"    : form.department.value,
        "institution"   : form.institution.value,
        "cm_checked"    : $('#cm_value').is(':checked'),
        "td_checked"    : $('#td_value').is(':checked'),
        "tp_checked"    : $('#tp_value').is(':checked'),
    };

    var jsonData = JSON.stringify(data);
    document.cookie = "information=" + jsonData;
    window.location.href = form.getAttribute("action");

    return false;
}

function displayDepartments(institution){
    resetValues();
    // $("#institution, #department, #ue,#ecue, #grade, #career").empty();
    $('#department').load('textbook/fetchData/get_department.php',
        { institution : institution });
}

function displayTeachers(department){
    resetValues();
    $("#teacher , #ue,#ecue, #grade, #career").empty();
    $('#teacher').load('textbook/fetchData/get_teacher.php',
        {
            department : department,
            institution: $('#institution').val()
        });
}

function displayUe(teacher){
    resetValues();
    $("#ue, #ecue, #grade, #career").empty();
    $('#ue').load('textbook/fetchData/get_ue.php',
        {
            teacher : teacher,
            department : $('#department').val(),
            institution: $('#institution').val()
        });
}

function displayEcue(ue){
    resetValues();
    $("#ecue, #grade, #career").empty();
    $('#ecue').load('textbook/fetchData/get_ecue.php',
        {
            ue          : ue,
            teacher     : $("#teacher").val(),
            department  : $('#department').val(),
            institution : $('#institution').val()
        });
}

function displayGrades(ecue){
    resetValues();
    $("#grade, #career").empty();
    $('#grade').load('textbook/fetchData/get_grade.php',
        {
            ecue          : ecue,
            teacher     : $("#teacher").val(),
            department  : $('#department').val(),
            institution : $('#institution').val()
        });
}

function displayCareers(grade){
    resetValues();
    $('#career').load('textbook/fetchData/get_career.php',
        {
            grade       : grade,
            ecue        : $("#ecue").val(),
            teacher     : $("#teacher").val(),
            department  : $('#department').val(),
            institution : $('#institution').val()
        });
}

function displayGroups(career){
    resetValues();
    loadCM(career);
    loadTD(career);
    loadTP(career);
}

function loadCM(career){
    $('#cm label span').load('textbook/fetchData/get_groups.php',
        {
            career      : career,
            grade       : $('#grade').val(),
            ecue        : $('#ecue').val(),
            teacher     : $("#teacher").val(),
            department  : $("#department").val(),
            institution : $("#institution").val(),
            type        : "CM"
        }
    );
}

function loadTD(career){
    $('#td label span').load('textbook/fetchData/get_groups.php',
        {
            career      : career,
            grade       : $('#grade').val(),
            ecue        : $('#ecue').val(),
            teacher     : $("#teacher").val(),
            department  : $("#department").val(),
            institution : $("#institution").val(),
            type        : "TD"
        }
    );
}

function loadTP(career){
    $('#tp label span').load('textbook/fetchData/get_groups.php',
        {
            career      : career,
            grade       : $('#grade').val(),
            ecue        : $('#ecue').val(),
            teacher     : $("#teacher").val(),
            department  : $("#department").val(),
            institution : $("#institution").val(),
            type        : "TP"
        }
    );
}

$('#all').click(function (){
    $('input[type=checkbox]').prop('checked', $(this).prop('checked'));
});

function resetValues(){
    $("#cm label span, #td label span, #tp label span").empty().append('0');
    if ($('input[type=checkbox]').is(":checked")) $("input[type=checkbox]").prop("checked", false);
    $("input[type=checkbox], #summary").prop("disabled", true);
}