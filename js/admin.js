/**
 * Created by Yegor Shemereko on 10/7/2016.
 */

var $table = $('#adminTable');


window.operateEvents = {

    'click .voice': function (e, value, row, index) {
        responsiveVoice.speak(row.word, "US English Female");
    },

    'click .image': function (e, value, row, index) {
        console.log("image clicked")
        $("#showImage").modal("show");
        $("#imageDisplay").attr("src", "../uploads/" + row.image);
        $("#imageName").text(row.word);
    }
};

/**
 * This function takes the resized image and converts it from a dataURL to a dropzone
 */
function base64ToFile(dataURI, origFile) {
    var byteString, mimestring;

    if (dataURI.split(',')[0].indexOf('base64') !== -1) {
        byteString = atob(dataURI.split(',')[1]);
    } else {
        byteString = decodeURI(dataURI.split(',')[1]);
    }

    mimestring = dataURI.split(',')[0].split(':')[1].split(';')[0];

    var content = new Array();
    for (var i = 0; i < byteString.length; i++) {
        content[i] = byteString.charCodeAt(i);
    }

    var newFile = new File(
        [new Uint8Array(content)], origFile.name, {type: mimestring}
    );


    // Copy props set by the dropzone in the original file

    var origProps = [
        "upload", "status", "previewElement", "previewTemplate", "accepted"
    ];

    $.each(origProps, function (i, p) {
        newFile[p] = origFile[p];
    });

    return newFile;
}




/**
 * The image in the boostrap table
 */
function imageFormatter(value, row, index) {
    return [
        '<a class="image" href="javascript:void(0)" title="Image">',
        '<img height="100" src="../uploads/' + value + '">',
        '</a>'
    ].join('');
}


function voiceFormatter(value, row, index) {
    return [
        '<a class="voice" href="javascript:void(0)" title="Voice">',
        '<i class="glyphicon glyphicon-volume-up"></i>',
        '</a>'
    ].join('');
}

/**
 * Bootstrap table configurations
 */
$table.bootstrapTable({
    url: "../api/dictionaryEndpoints.php",
    pagination: true,
    toolbar: "#toolbar",
    search: true,
    clickToSelect: true,
    columns: [{
        field: "state",
        radio: true
    }, {
        field: 'id',
        title: 'ID',
        visible: false

    }, {
        field: 'word',
        title: 'Word',
        sortable: true
    }, {
        field: 'say',
        title: 'Say',
        align: 'center',
        events: operateEvents,
        formatter: voiceFormatter
    }, {
        field: 'definition',
        title: 'Definition',
        sortable: true
    }, {
        field: 'category',
        title: 'Category',
        sortable: true
    }, {
        field: 'image',
        title: 'Image',
        events: operateEvents,
        formatter: imageFormatter
    }, {
        field: 'created_by',
        title: 'Author',
        sortable: true
    }, {
        field: 'class_name',
        title: 'Class',
        sortable: true
    }],
    onClickRow: function (row, elm) {
        //...
    }
});


/**
 * Ajax/dropzone calls
 */
$(function () {
    // New Teacher --------------------------------------------------
    $("#new-teacher-form").submit(function(e) {
        e.preventDefault();
        var first_name = $('#teacher_first_name').val();
        var last_name = $('#teacher_last_name').val();
        var email = $('#teacher_email').val();
        var pass_code = $('#teacher_password').val();
        var datastring = "teacher_first_name="+first_name+"&teacher_last_name="+last_name+"&teacher_email="+email+"&teacher_password="+pass_code;

        $.ajax({
            url: '../api/teacherRegisterEndpoint.php',
            type: 'POST',
            data: datastring,
            success: function (result) {

                if (result == 1) {
                    $("#new-teacher-form").trigger('reset');
                    $('#newTeacher').modal('hide');
                } else {
                    $("#create-teacher-error").text("There was an error while creating this teacher.")
                }
            }
        });
    })


    // Add Word --------------------------------------------------
    Dropzone.options.myDropzone = {
        url: '../api/dictionaryEndpoints.php',
        autoProcessQueue: false,
        uploadMultiple: true,
        parallelUploads: 5,
        maxFiles: 1,
        maxFilesize: 10,
        acceptedFiles: 'image/*',
        addRemoveLinks: true,
        init: function () {
            var submitButton = document.querySelector("#submit-all");
            dzClosure = this; // Makes sure that 'this' is understood inside the functions below.

            // for Dropzone to process the queue (instead of default form behavior):
            submitButton.addEventListener("click", function (e) {
                // Make sure that the form isn't actually being sent.
                e.preventDefault();
                e.stopPropagation();
                if (jQuery("#word").val() == "" || jQuery("#category").val() == "" || jQuery("#definition").val() == "") {
                    jQuery("#add_word_error").text("Please make sure all fields are filled.")
                } else {
                    jQuery("#add_word_error").text("");
                    dzClosure.processQueue();
                }
            });

            this.on("addedfile", function (origFile) {
                var MAX_WIDTH = 800;
                var MAX_HEIGHT = 600;
                var reader = new FileReader();

                // Convert file to img
                reader.addEventListener("load", function (event) {
                    var origImg = new Image();
                    origImg.src = event.target.result;

                    origImg.addEventListener("load", function (event) {
                        var width = event.target.width;
                        var height = event.target.height;

                        // Calc new dims otherwise
                        if (width > height) {
                            if (width > MAX_WIDTH) {
                                height *= MAX_WIDTH / width;
                                width = MAX_WIDTH;
                            }
                        } else {
                            if (height > MAX_HEIGHT) {
                                width *= MAX_HEIGHT / height;
                                height = MAX_HEIGHT;
                            }
                        }

                        // Resize
                        var canvas = document.createElement('canvas');
                        canvas.width = width;
                        canvas.height = height;

                        var ctx = canvas.getContext("2d");
                        ctx.drawImage(origImg, 0, 0, width, height);

                        var resizedFile = base64ToFile(canvas.toDataURL(), origFile);

                        // Replace original with resized
                        var origFileIndex = dzClosure.files.indexOf(origFile);
                        dzClosure.files[origFileIndex] = resizedFile;

                    });
                });
                reader.readAsDataURL(origFile);
            });

            //send all the form data along with the files:
            this.on("sendingmultiple", function (data, xhr, formData) {
                formData.append("word", jQuery("#word").val());
                formData.append("definition", jQuery("#definition").val());
                formData.append("category", jQuery("#category").val());
            });

            this.on("success", function () {
                //Clear form
                $('#add-word-form').trigger("reset");

                $('#addModal').modal('hide');
                this.removeAllFiles();

                var classPicker = $("#classPicker").val();
                $.ajax({
                    url: '../api/dictionaryEndpoints.php',
                    type: 'GET',
                    data: 'classPicker=' + classPicker,
                    success: function (result) {
                        console.log(result);
                        $('#adminTable').bootstrapTable("load", result);
                    }
                })
            });
        }
    };

    // Update word --------------------------------------------------
    $('#update-btn').click(function () {
        $('#updateModal').modal('show');
        var row = $table.bootstrapTable('getSelections');
        //Populate from inputs with row data
        $("#id_update").val(row[0].id);
        $("#word_update").val(row[0].word);
        $("#definition_update").val(row[0].definition);
        $("#category_update").val(row[0].category);
    });


    $("#update-word-form").on('submit', function (e) {
        e.preventDefault();
        //Server call to delete post
        $.ajax({
            url: '../api/dictionaryEndpoints.php',
            type: 'PUT',
            data: $('#update-word-form').serialize(),
            contentType: 'application/json',
            dataType: 'text',
            success: function (result) {

                console.log(result);
                // Refresh table to display updated contact
                $table.bootstrapTable('refresh', {
                    silent: true
                });
            }
        });

        $('#updateModal').modal('hide');
    });

    // Delete word --------------------------------------------------
    $('#delete-btn').click(function () {

        $('#deleteModal').modal('show');

    });

    $('#delete-confirm-btn').click(function () {

        var ids = $.map($table.bootstrapTable('getSelections'), function (row) {

            var id = row.id;


            //Server call to delete post
            $.ajax({
                url: '../api/dictionaryEndpoints.php',
                type: 'DELETE',
                data: {
                    id: id
                },
                contentType: 'application/json',
                dataType: 'text',
                success: function (result) {
                    // Do something with the result
                    console.log(result);
                }
            });

            return id;
        });

        $table.bootstrapTable('remove', {
            field: 'id',
            values: ids
        });

        $('#deleteModal').modal('hide');
    });

}); // end-ajax calls