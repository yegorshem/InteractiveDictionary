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
 * Ajax calls
 */
$(function () {

    // Add contact --------------------------------------------------
    $("#add-word-form").on('submit', function (e) {
        e.preventDefault();

        $.ajax({
            url: "..api/dictionaryEndpoints.php",
            type: 'POST',
            data: $('#add-word-form').serialize(),
            success: function (data) {

                console.log(data);

                //Clear form
                $('#add-word-form').trigger("reset");

                $('#addModal').modal('hide');

                $table.bootstrapTable('refresh', {
                    silent: true
                });
            }
        });
    });

    // Update contact --------------------------------------------------
    $("#update-word-form").on('submit', function (e) {
        e.preventDefault();

        //Server call to delete post
        $.ajax({
            url: '..api/dictionaryEndpoints.php',
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
                url: '..api/dictionaryEndpoints.php',
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