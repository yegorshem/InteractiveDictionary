/**
 * Created by Joel on 11/6/2016.
 */
$(document).ready(function() {

    $.ajax({
        url: '../api/classValidate.php',
        type: 'GET',
        dataType: 'json',
        success: function (result) {
            var options = $("#classPicker");
            console.log(result);
            var i=0
            if (result.length > 0) {
                $.each(result, function(i){
                    options.append($("<option />").val(result[i].class_id).text(result[i].class_name));
                    i++;
                });
            } else {
                options.append($("<option />").val(null).text("No Classes"));
            }
        }

    })
});

