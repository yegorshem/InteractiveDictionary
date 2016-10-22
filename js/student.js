/**
 * Created by Josh on 10/11/2016.
 */

var $table = $('#studentTable');

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
    }],
    onClickRow: function (row, elm) {
        //...
    }
});