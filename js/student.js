/**
 * Created by Josh on 10/11/2016.
 */

var $table = $('#studentTable');

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

    //Add Word---
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

            this.on("success", function (result) {
                console.log(result);
                //Clear form
                $('#add-word-form').trigger("reset");

                $('#addModal').modal('hide');
                this.removeAllFiles();
                $table.bootstrapTable('refresh', {
                    silent: true
                });

            });
        }
    };
});


