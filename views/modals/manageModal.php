<?php
/**
 * Created by PhpStorm.
 * User: Josh
 * Date: 12/7/2016
 * Time: 1:09 PM
 */
?>

<!-- modal-->
<div id="manageModal" class="modal fade">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h2 id="title" class="modal-title">Delete Confirmation</h2>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-12">
                        <h4 class="text-center">Remove this word forever?</h4>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-secondary">Cancel</button>
                <button type="button" id="delete-forever-confirm-btn" class="btn btn-danger">Delete</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->