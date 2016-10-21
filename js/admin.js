/**
 * Created by Yegor Shemereko on 10/7/2016.
 */

var $table = $('#adminTable');

window.operateEvents = {
    'click .edit': function (e, value, row, index) {

        $("#updateModal").modal("show");
        //Populate from inputs with row data
        $("#id_update").val(row.id);
        $("#word_update").val(row.word);
        $("#definition_update").val(row.definition);

    }
};

/**
 * This function takes the resized image and converts it from a dataURL to a dropzone
 */
function base64ToFile(dataURI, origFile) {
    var byteString, mimestring;

    if(dataURI.split(',')[0].indexOf('base64') !== -1 ) {
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

    $.each(origProps, function(i, p) {
        newFile[p] = origFile[p];
    });

    return newFile;
}


/**
 * The edit button in the Bootsrap table
 */
function operateFormatter(value, row, index) {
    return [
        '<a class="edit" href="javascript:void(0)" title="Edit">',
        '<i class="glyphicon glyphicon-edit edit-icon"></i>',
        '</a>'
    ].join('');
}

/**
 * The image in the boostrap table
 */
function imageFormatter(value, row, index) {
    return [
        '<a class="image" href="../uploads/'+value+'" title="Image">',
        '<img height="100" src="../uploads/'+value+'">',
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
        field: 'definition',
        title: 'Definition',
        sortable: true
    }, {
        field: 'image',
        title: 'Image',
        formatter: imageFormatter

    }, {
        field: 'operate',
        title: 'Edit',
        align: 'center',
        events: operateEvents,
        formatter: operateFormatter
    }],
    onClickRow: function (row, elm) {
        //...
    }
});


/**
 * Ajax/dropzone calls
 */
$(function () {

    // Add Word --------------------------------------------------
    Dropzone.options.myDropzone= {
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
                dzClosure.processQueue();
            });

            this.on("addedfile", function(origFile) {
                var MAX_WIDTH  = 800;
                var MAX_HEIGHT = 600;
                var reader = new FileReader();

                // Convert file to img
                reader.addEventListener("load", function(event) {
                    var origImg = new Image();
                    origImg.src = event.target.result;

                    origImg.addEventListener("load", function(event) {
                        var width  = event.target.width;
                        var height = event.target.height;

                        // Don't resize if it's small enough
                        if (width <= MAX_WIDTH && height <= MAX_HEIGHT) {
                            dropzone.enqueueFile(origFile);
                            return;
                        }

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
            });

            this.on("success", function() {
                //Clear form
                $('#add-word-form').trigger("reset");

                $('#addModal').modal('hide');

                $table.bootstrapTable('refresh', {
                    silent: true
                });
            });
        }
    }

    // Update contact --------------------------------------------------
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

    // Delete contact --------------------------------------------------
    $('#delete-btn').click(function () {
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

        //$('#deleteModal').modal('hide');
    });

}); // end-ajax calls