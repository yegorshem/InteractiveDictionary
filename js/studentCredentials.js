/**
 * Created by Joel on 11/22/2016.
 */
$(document).ready(function () {
    var pass;
    $("#credentials-btn").click(function() {
        $.ajax({
            url: '../api/studentEndpoints.php',
            type: 'GET',
            data: "string=string", //this allows to distinguish the select query to use
            dataType: 'json',
            success: function(result) {
                $('#credentialsModal').modal('show');
                pass = result[0].password;
                $("#new_first_name").val(result[0].first_name);
                $("#new_last_name").val(result[0].last_name);
            }
        })
    })

    $("#credentials-form").submit(function(e){
        e.preventDefault();
        e.stopPropagation();
        var newPass = $("#new_pass_code").val();
        var verifyPass = $("#verify_pass_code").val();
        if (newPass != verifyPass) {
            $("#credentials-error").text("Your new passwords don't match.");
        } else {
            $.ajax({
                url: '../api/studentEndpoints.php',
                type: 'PUT',
                data: $('#credentials-form').serialize()+"&old_pass="+pass,
                dataType: 'json',
                success: function(result) {
                    if (result == true){
                        $('#credentialsModal').modal('hide');
                        $("#credentials-form").trigger('reset');

                    } else {
                        $("#credentials-error").text("Incorrect old password was given.");
                    }
                }

            })
        }



    })
});