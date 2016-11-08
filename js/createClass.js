/**
 * Created by Joel on 11/7/2016.
 */
$(document).ready(function() {

    $.ajax({
        url: '../api/teacherEndpoints.php',
        type: 'GET',
        dataType: 'json',
        success: function (result) {
            var options = $("#teacherPicker");

            var i=0;
            if (result.length > 0) {
                $.each(result, function(i){
                    options.append($("<option />").val(result[i].user_id).text(result[i].first_name + " " + result[i].last_name));
                    i++;
                });
            } else {
                options.append($("<option />").val(null).text("No Teachers"));
            }
        }
    })

    $("#new-class-form").submit(function(e){
        e.preventDefault();
        var class_name = $("#class_name").val();
        var admin_id = $("#teacherPicker").val();
        var datastring = "class_name="+class_name+"&admin_id="+admin_id;


        $.ajax({
            url: '../api/classEndpoints.php',
            type: 'POST',
            data: datastring,
            success: function (result) {
                if(result[0]==1) {
                    $('#new-class-form').trigger("reset");
                    $('#newClass').modal('hide');
                }
                else {
                    $("#create-class-error").text("There has been an error while trying to create this class.");
                }
            }
        });
    })


})