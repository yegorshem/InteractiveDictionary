/**
 * Created by Joel on 11/18/2016.
 */
$(document).ready(function(){
    //character count
    $('#comments').keyup(function () {
        var max = 255;
        var len = $(this).val().length;
        if (len >= max) {
            $('#commentCharCount').text(' you have reached the limit');
        } else {
            var char = max - len;
            $('#commentCharCount').text(char + ' characters left');
        }
    });

    $("#grade-word-form").submit(function(e){
        e.preventDefault();
        e.stopPropagation();
        $.ajax({
            url: 'api/gradeEndpoints.php',
            type: 'POST',
            data: $("#grade-word-form").serialize(),
            success: function (result) {
                if(result[0]==1) {

                    $('#grade-word-form').trigger("reset");
                    $('#gradeModal').modal('hide');
                }
                else {
                    $("#grade_word_error").text("There was an error while trying to grade this submission.");
                }
            }
        });
    })

});