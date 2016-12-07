<?php
/**
 * Created by PhpStorm.
 * User: Joel
 * Date: 11/22/2016
 * Time: 4:42 PM
 */
?>

<!-- modal-->
<div id="credentialsModal" class="modal fade">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h2 id="title" class="modal-title">Credentials</h2>
            </div>
            <form id="credentials-form">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h4>Edit your information</h4>
                            <div id="credentials-error"></div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <label class="input-group-addon" for="new_first_name">First Name</label>
                                        <input required="required" type="text" class="form-control"
                                               id="new_first_name" name="first_name"/>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="input-group">
                                        <label class="input-group-addon" for="new_last_name">Last Name</label>
                                        <input required="required" type="text" class="form-control"
                                               id="new_last_name" name="last_name"/>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <label class="input-group-addon" for="new_pass_code">New Password</label>
                                        <input required="required" type="password" class="form-control"
                                               id="new_pass_code" name="new_pass_code"/>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="input-group">
                                        <label class="input-group-addon" for="verify_pass_code">New Password</label>
                                        <input required="required" type="password" class="form-control"
                                               id="verify_pass_code"/>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <label class="input-group-addon" for="old_pass_code">Old Password</label>
                                        <input required="required" type="password" class="form-control"
                                               id="old_pass_code" name="old_pass_code"/>
                                    </div>
                                </div>
                            </div>
                            <br>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-secondary">Cancel</button>
                    <button type="submit" value="SUBMIT" class="btn btn-success">Submit</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->