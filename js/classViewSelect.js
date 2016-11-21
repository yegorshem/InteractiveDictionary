/**
 * Created by Joel on 11/19/2016.
 */
$(document).ready(function() {
    $.ajax({
        url: '../api/classEndpoints.php',
        type: 'GET',
        dataType: 'json',
        success: function (result) {
            var options = $("#classPicker");

            var i = 0;
            if (result.length > 0) {
                $.each(result, function (i) {
                    options.append($("<option />").val(result[i].class_id).text(result[i].class_name));
                    i++;
                });
            } else {
                options.append($("<option />").val(null).text("No Classes"));
            }
        }
    });

    $("#classPicker").on('change', function () {
        var classPicker = $("#classPicker").val();
        var graded = $("#studentGraded").val();
        //remove old list of students
        $("#studentPicker").remove();
        //add new empty list of students
        $("#selection").append("<select id='studentPicker' class='selectpicker form-control'>" +
            "<option value='0' disabled='disabled' selected='selected'>Select a student</option>"+
        "</select>")
        $.ajax({
            url: '../api/dictionaryEndpoints.php',
            type: 'GET',
            data: 'classPicker='+classPicker+"&graded="+graded,
            success: function(result) {
                $("#classTable").bootstrapTable("load", result);
                var classPicker = $("#classPicker").val();
                var students = $("#studentPicker");
                $.ajax({
                    url: '../api/studentEndpoints.php',
                    type: 'GET',
                    data: 'classPicker='+classPicker,
                    success: function(result) {
                        var i = 0;
                        if (result.length > 0) {
                            $.each(result, function (i) {
                                students.append($("<option />").val(result[i].user_id).text(result[i].first_name+" "+result[i].last_name+" | "+result[i].username));
                                i++;
                            });
                        } else {
                            students.append($("<option />").val(null).text("No Students"));
                        }
                    }
                })
            }
        });

        //on change of student
        $("#studentPicker").on('change', function () {
            var creator_id = $("#studentPicker").val();
            var classPicker = $("#classPicker").val();
            var graded = $("#studentGraded").val();
            console.log(creator_id | classPicker | graded);

            $.ajax({
                url: '../api/dictionaryEndpoints.php',
                type: 'GET',
                data: 'creator_id='+creator_id+"&graded="+graded+"&classPicker="+classPicker,
                success: function(result) {
                    $("#classTable").bootstrapTable("load", result);
                }
            })
        })


    });
    
    //on change of studentGraded
    $("#studentGraded").on('change', function () {
        var creator_id = $("#studentPicker").val();
        var classPicker = $("#classPicker").val();
        var graded = $("#studentGraded").val();
        var dataString;
        if (creator_id != null)
        {
            dataString = 'creator_id='+creator_id+"&graded="+graded+"&classPicker="+classPicker;
        } else
        {
            dataString = "graded="+graded+"&classPicker="+classPicker;
        }
        $.ajax({
            url: '../api/dictionaryEndpoints.php',
            type: 'GET',
            data: dataString,
            success: function(result) {
                $("#classTable").bootstrapTable("load", result);
            }
        })
    })

});

