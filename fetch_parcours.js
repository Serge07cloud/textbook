function fetch_select(val1,val2)
{
    $.ajax({
        type: 'post',
        url: 'fetch_data.php',
        data: {
            get_option1:val1,
            get_option2:val2
        },
        success: function (response) {
            document.getElementById("new_select").innerHTML=response;
        }
    });
}