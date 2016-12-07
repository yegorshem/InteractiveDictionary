/**
 * Created by Josh on 12/7/2016.
 */

$(document).ready(function() {

    $.ajax({
        url: 'api/dictionaryEndpoints.php',
        type: 'GET',
        dataType: 'json',
        success: function (result) {
            var options = $("#deletedSelect");

            var i=0;
            if (result.length > 0) {
                $.each(result, function(i){
                    options.append($("<option />").val(result[i].class_id).text(result[i].class_name));
                    i++;
                });
            } else {
                options.append($("<option />").val(null).text("No Words"));
            }
        }
    })

    $("#deletedSelect").on('change', function () {
        var deletedSelect = $("#deletedSelect").val();
        $.ajax({
            url: 'api/manageEndpoints.php',
            type: 'GET',
            data: 'deletedSelect='+deletedSelect,
            success: function(result) {
                $('#manageWordsTable').bootstrapTable("load", result);
            }
        })
    })
});