/**
 * Created by Joel on 11/29/2016.
 */

var $table = $('#teacherGradeTable');

$(document).ready(function() {
    $.ajax({
        url: 'api/classEndpoints.php',
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
        var graded = 1;
        //remove old list of students
        $("#studentPicker").remove();
        //add new empty list of students
        $("#selection").append("<select id='studentPicker' class='selectpicker form-control'>" +
            "<option value='0' disabled='disabled' selected='selected'>Select a student</option>"+
            "</select>")
        $.ajax({
            url: 'api/gradeEndpoints.php',
            type: 'GET',
            data: 'classPicker='+classPicker,
            dataType: 'json',
            success: function(result) {
                console.log(result);
                $table.bootstrapTable("load", result);
                var classPicker = $("#classPicker").val();
                var students = $("#studentPicker");
                $.ajax({
                    url: 'api/studentEndpoints.php',
                    type: 'GET',
                    data: 'classPicker='+classPicker,
                    dataType: 'json',
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
            //set to graded work
            var graded = 1;
            console.log(creator_id | classPicker | graded);

            $.ajax({
                url: 'api/gradeEndpoints.php',
                type: 'GET',
                data: 'creator_id='+creator_id+"&graded="+graded+"&classPicker="+classPicker,
                dataType: 'json',
                success: function(result) {
                    $table.bootstrapTable("load", result);
                }
            })
        })


    });

})


/**
 * The score formatter in the boostrap table
 */
function scoreFormatter(value, row, index) {
    return [
        '<p class="score">'+value+' of 4</p>',
    ].join('');
}


/**
 * Bootstrap table configurations
 */
$table.bootstrapTable({
    url: "api/gradeEndpoints.php",
    pagination: true,
    toolbar: "#toolbar",
    search: true,
    clickToSelect: true,
    columns: [{
        field: 'grade_id',
        title: 'Grade ID',
        visible: false
    }, {
        field: 'word_id',
        title: 'Word ID',
        visible: false
    }, {
        field: 'wordTxt',
        title: 'Word',
        sortable: true
    }, {
        field: 'word',
        title: 'Word Score',
        sortable: true
    }, {
        field: 'definition',
        title: 'Definition Score'
    }, {
        field: 'category',
        title: 'Category Score'
    }, {
        field: 'image',
        title: 'Image Score'
    }, {
        field: 'score',
        title: 'Total Score',
        formatter: scoreFormatter
    }, {
        field: 'comment',
        title: 'Comment'
    }],
    onClickRow: function (row, elm) {
        //...
    },
    success: function(result) {
        console.log(result);
    }
});
