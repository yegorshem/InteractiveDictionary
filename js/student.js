/**
 * Created by Josh on 10/11/2016.
 */

var $table = $('#studentTable');

window.operateEvents = {
    'click .voice': function (e, value, row, index) {
        responsiveVoice.speak(row.word, "US English Female");
    }
};

/**
 * The image in the boostrap table
 */
function imageFormatter(value, row, index) {
    return [
        '<a class="image" href="../uploads/' + value + '" title="Image">',
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