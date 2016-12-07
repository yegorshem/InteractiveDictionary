<?php
/**
 * Created by PhpStorm.
 * User: Joel
 * Date: 12/7/2016
 * Time: 9:40 AM
 */
?>
<!-- modal-->
<div id="forgotModal" class="modal fade">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h2 id="title" class="modal-title">Forgot Password</h2>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-12">
                        <p id="forgot-error"></p>
                        <div class="input-group">
                            <label class="input-group-addon" for="forgot-email">Email</label>
                            <input required="required" type="email" class="form-control"
                                   id="forgot-email" name="forgot-email"/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-secondary">Cancel</button>
                <button type="button" id="reset-btn" class="btn btn-primary">Submit</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
