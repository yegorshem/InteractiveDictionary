var $table = $('#classTable');

window.operateEvents = {
    'click .grade': function (e, value, row, index) {
        console.log("grade clicked")
        $("#gradeModal").modal("show");
        //Populate from inputs with row data
        $("#word_id").val(row.id);
        $("#grading_word").text(row.word);
        $("#grading_definition").text(row.definition);
        $("#grading_category").text(row.category);
        $("#grading_image").attr("src", "../uploads/"+row.image)
    },

    'click .image': function (e, value, row, index) {
        console.log("image clicked")
        $("#showImage").modal("show");
        $("#imageDisplay").attr("src", "../uploads/" + row.image);
        $("#imageName").text(row.word);
    }
};

/**
 * The edit button in the Bootsrap table
 */
function operateFormatter(value, row, index) {
    return [
        '<a class="grade" href="javascript:void(0)" title="Grade">',
        '<i class="glyphicon glyphicon-check"></i>',
        '</a>'
    ].join('');
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
        field: 'id',
        title: 'ID',
        visible: false

    }, {
        field: 'word',
        title: 'Word',
        sortable: true
    }, {
        field: 'created_by',
        title: 'Author',
        sortable: true
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
        field: 'class_name',
        title: 'Class',
        sortable: true
    }, {
        field: 'grade',
        title: 'Grade',
        align: 'center',
        events: operateEvents,
        formatter: operateFormatter
    }],
    onClickRow: function (row, elm) {
        //...
    }
});