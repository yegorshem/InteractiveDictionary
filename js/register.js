/**
 * Created by Joel on 10/30/2016.
 */

$(document).ready(function(){
    $("#register_err").css('display', 'none', 'important');
    $("#register_account_form").submit(function(e) {
        e.preventDefault();
        var first_name=$("#first_name").val();
        var last_name=$("#last_name").val();
        var email=$("#email").val();
        var pass_code=$("#pass_code").val();
        var class_code=$("#class_code").val();
        var dataString = 'first_name='+first_name+'&last_name='+last_name+'&email='+email+'&pass_code='+pass_code+'&class_code='+class_code;

        $.ajax({
            type: "POST",
            url: "../api/studentRegisterEndpoint.php",
            data: dataString,
            success: function(data) {
                if (data[0]==true) {
                    window.location.replace('about.php');
                }
                else    {
                    $("#register_err").css('display', 'inline', 'important');
                    $("#register_err").text(data);
                    $("#pass_code").val('');
                }
            },
            beforeSend:function() {
                $("#register_err").css('display', 'inline', 'important');
                $("#register_err").text("Loading...");
            }
        });
        return false;
    });
});