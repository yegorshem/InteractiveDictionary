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
                        <p class="center">Your password will be reset and the new password will be sent to your email.</p>
                        <p id="forgot-error" class="center"></p>
                        <div class="center">
                            <label for="adminForgot">Admin &nbsp</label>
                            <input type="radio" id="adminForgot" name="selectForgotForm">
                            <label for="studentForgot">&nbsp Student &nbsp</label>
                            <input type="radio" id="studentForgot" name="selectForgotForm" checked="checked">
                        </div>
                        <div id="student-forgot-form">
                            <div id="student-forgot-form" class="input-group">
                                <label class="input-group-addon" for="student-forgot-email"> Student Email</label>
                                <input required="required" type="email" class="form-control"
                                       id="student-forgot-email" name="student-forgot-email"/>
                            </div>
                            <div class="modal-footer">
                                <button type="button" data-dismiss="modal" class="btn btn-secondary">Cancel</button>
                                <button type="button" id="student-reset-btn" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                        <div id="admin-forgot-form">
                            <div id="admin-forgot-form" class="input-group">
                                <label class="input-group-addon" for="admin-forgot-email">Teacher Email</label>
                                <input required="required" type="email" class="form-control"
                                       id="admin-forgot-email" name="admin-forgot-email"/>
                            </div>
                            <div class="modal-footer">
                                <button type="button" data-dismiss="modal" class="btn btn-secondary">Cancel</button>
                                <button type="button" id="admin-reset-btn" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
