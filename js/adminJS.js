/**
 * Created by Yegor Shemereko on 10/7/2016.
 */

var $table = $('#adminTable');

window.operateEvents = {
    'click .edit': function (e, value, row, index) {

        $("#updateModal").modal("show");
        //Populate from inputs with row data
        $("#realms_id").val(row.realms_id);
        $("#template_name").val(row.name);
        $("#template_id").val(row.template_id);
        $("#template_subject").val(row.subject);
        $("#template_content").val(row.content);
    }
};
/**
 * The edit button in the Bootsrap table
 */
function operateFormatter(value, row, index) {
    return [
        '<a class="edit" href="javascript:void(0)" title="Edit">',
        '<i class="glyphicon glyphicon-edit edit-icon"></i>',
        '</a>  '
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