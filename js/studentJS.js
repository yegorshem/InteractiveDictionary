/**
 * Created by Josh on 10/11/2016.
 */

var $table = $('#studentTable');

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
    }],
    onClickRow: function (row, elm) {
        //...
    }
});