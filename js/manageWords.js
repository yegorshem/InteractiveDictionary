/**
 * Created by Josh on 12/7/2016.
 */

var $table = $('#manageWordsTable');


window.operateEvents = {

    'click .voice': function (e, value, row, index) {
        responsiveVoice.speak(row.word, "US English Female");
    },

    'click .image': function (e, value, row, index) {
        console.log("image clicked")
        $("#showImage").modal("show");
        $("#imageDisplay").attr("src", "uploads/" + row.image);
        $("#imageName").text(row.word);
    }
};

/**
 * The image in the bootstrap table
 */
function imageFormatter(value, row, index) {
    return [
        '<a class="image" href="javascript:void(0)" title="Image">',
        '<img height="100" src="uploads/' + value + '">',
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
    url: "api/manageEndpoints.php",
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

// Delete word --------------------------------------------------
$('#delete-btn').click(function () {
    $('#manageModal').modal('show');
});

$('#delete-forever-confirm-btn').click(function () {

    var ids = $.map($table.bootstrapTable('getSelections'), function (row) {

        var id = row.id;


        //Server call to delete post
        $.ajax({
            url: 'api/manageEndpoints.php',
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

    $('#manageModal').modal('hide');
});