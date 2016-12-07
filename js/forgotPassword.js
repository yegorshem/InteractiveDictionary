/**
 * Created by Joel on 12/7/2016.
 */
$(document).ready(function () {

    $("#forgot-btn").on('click', function () {
            $("#loginModal").modal('hide');
    })

    $("#reset-btn").on('click', function() {
        var email= $("#forgot-email").val();
        console.log(email);
        //Server call to delete post
        $.ajax({
            url: 'api/studentEndpoints.php',
            type: 'DELETE',
            data: "email="+email,
            contentType: 'application/json',
            dataType: 'text',
            success: function (result) {
                console.log(result);
                if (result == 1) {
                    $("#forgot-email").val('');
                    $("#forgotModal").modal('hide');
                } else {
                    $("#forgot-error").text("There has been an errror while trying to process your request.")
                }


            }
        });
    })


});