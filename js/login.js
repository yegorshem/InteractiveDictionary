/**
 * Created by Joel on 10/10/2016.
 */

$(document).ready(function(){
    $("#add_err").css('display', 'none', 'important');
    $("#login-form").submit(function(e) {
        e.preventDefault();
        var username=$("#username").val();
        var password=$("#password").val();
        var dataString = 'username='+username+'&password='+password;

        $.ajax({
            type: "POST",
            url: 'studentController.php',
            data: dataString,
            success: function(data) {
                if (data[0]==1) {
                    window.location.replace('adminController.php');
                }
                else if(data[0]==3) {
                    window.location.replace('studentController.php');
                }
                else    {
                    $("#add_err").css('display', 'inline', 'important');
                    $("#add_err").text('Incorrect username or password.');
                    $("#password").val('');
                }
            },
            beforeSend:function() {
                $("#add_err").css('display', 'inline', 'important');
                $("#add_err").text("Loading...");
            }
        });
        return false;
    });
});