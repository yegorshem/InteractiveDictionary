/**
 * Created by Joel on 12/7/2016.
 */
$(document).ready(function () {

    $("#forgot-btn").on('click', function () {
            $("#loginModal").modal('hide');
    })

    $("#admin-forgot-form").hide();

    $('input[type="radio"]').click(function () {
        if ($(this).attr('id') == 'adminForgot') {
            $('#admin-forgot-form').show();
            $('#student-forgot-form').hide();
        }
        else {
            $('#admin-forgot-form').hide();
            $('#student-forgot-form').show();
        }
    });

    $("#student-reset-btn").on('click', function() {
        var email= $("#student-forgot-email").val();
        //Server call to delete post
        $.ajax({
            url: 'api/studentEndpoints.php',
            type: 'DELETE',
            data: "email="+email,
            contentType: 'application/json',
            dataType: 'text',
            success: function (result) {
                if (result == 1) {
                    $("#student-forgot-email").val('');
                    $("#forgotModal").modal('hide');
                } else {
                    $("#forgot-error").text("There has been an errror while trying to process your request.")
                }


            }
        });
    });

    $("#admin-reset-btn").on('click', function() {
        var email= $("#admin-forgot-email").val();
        //Server call to delete post
        $.ajax({
            url: 'api/teacherEndpoints.php',
            type: 'DELETE',
            data: "email="+email,
            contentType: 'application/json',
            dataType: 'text',
            success: function (result) {
                if (result == 1) {
                    $("#admin-forgot-email").val('');
                    $("#forgotModal").modal('hide');
                    $("#forgot-error").text("");
                } else {
                    $("#admin-forgot-email").val('');
                    $("#forgot-error").text("There has been an error while trying to process your request.")
                }


            }
        });
    });

});