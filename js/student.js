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
    }],
    onClickRow: function (row, elm) {
        //...
    }
});