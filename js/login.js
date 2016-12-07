/**
 * Created by Joel on 10/10/2016.
 */

$(document).ready(function () {
    $("#add_err").css('display', 'none', 'important');

    $("#student-login-form").hide();

    $('input[type="radio"]').click(function () {
        if ($(this).attr('id') == 'adminForm') {
            $('#admin-login-form').show();
            $('#student-login-form').hide();
        }

        else {
            $('#admin-login-form').hide();
            $('#student-login-form').show();
        }
    });

    $("#admin-login-form").submit(function (e) {
        e.preventDefault();
        var adminUsername = $("#adminUsername").val();
        var adminPassword = $("#adminPassword").val();
        var dataString = 'adminUsername=' + adminUsername + '&adminPassword=' + adminPassword;

        $.ajax({
            type: "POST",
            url: 'api/teacherEndpoints.php',
            data: dataString,
            success: function (data) {
                if (data[0] == 1) {
                    window.location.replace('admin.php');
                }
                else if (data[0] == 0) {
                    window.location.replace('teacher.php')
                }
                else {
                    $("#add_err").css('display', 'inline', 'important');
                    $("#add_err").text("Incorrect username or password");
                    $("#password").val('');
                }
            },
            beforeSend: function () {
                $("#add_err").css('display', 'inline', 'important');
                $("#add_err").text("Loading...");
            }
        });
        return false;
    });


    $("#student-login-form").submit(function (e) {
        e.preventDefault();
        var studentUsername = $("#studentUsername").val();
        var studentPassword = $("#studentPassword").val();
        var dataString = 'studentUsername=' + studentUsername + '&studentPassword=' + studentPassword;

        $.ajax({
            type: "POST",
            url: 'api/studentEndpoints.php',
            data: dataString,
            success: function (data) {
                if (data[0] != null) {
                    window.location.replace('student.php');
                }
                else {
                    $("#add_err").css('display', 'inline', 'important');
                    $("#add_err").text("Incorrect username or password");
                    $("#password").val('');
                }
            },
            beforeSend: function () {
                $("#add_err").css('display', 'inline', 'important');
                $("#add_err").text("Loading...");
            }
        });
        return false;
    });
});