/**
 * Created by Joel on 11/6/2016.
 */
$(document).ready(function() {

    $.ajax({
        url: '../api/classEndpoints.php',
        type: 'GET',
        dataType: 'json',
        success: function (result) {
            var options = $("#classPicker");

            var i=0;
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

    $("#classPicker").on('change', function () {
        var classPicker = $("#classPicker").val();
        $.ajax({
            url: '../api/dictionaryEndpoints.php',
            type: 'GET',
            data: 'classPicker='+classPicker,
            success: function(result) {
                console.log(result);
                $('#adminTable').bootstrapTable("load", result);
            }
        })
    })
});

