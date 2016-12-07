/**
 * Created by Joel on 11/19/2016.
 */

var $table = $('#gradeTable');


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
