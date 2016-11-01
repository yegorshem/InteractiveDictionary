<?php
/**
 * Created by PhpStorm.
 * User: Joel
 * Date: 10/30/2016
 * Time: 7:30 PM
 */
?>

<!-- modal-->
<div id="registerModal" class="modal fade">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h3 class="modal-title">Create Account</h3>
            </div>
            <form id="register_account_form" method="post">
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-12">
                            <h4>Please enter your information</h4>
                            <div id="register_err"></div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <label class="input-group-addon" for="first_name">First Name</label>
                                        <input required="required" type="text" class="form-control"
                                               id="first_name" name="first_name"/>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="input-group">
                                        <label class="input-group-addon" for="last_name">Last Name</label>
                                        <input required="required" type="text" class="form-control"
                                               id="last_name" name="last_name"/>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <label class="input-group-addon" for="email">Email</label>
                                        <input required="required" type="email" class="form-control"
                                               id="email" name="email"/>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="input-group">
                                        <label class="input-group-addon" for="pass_code">Password</label>
                                        <input required="required" type="password" class="form-control"
                                               id="pass_code" name="pass_code"/>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-6 col-md-offset-3">
                                    <div class="input-group">
                                        <label class="input-group-addon" for="class_code">Class Code</label>
                                        <input required="required" type="text" class="form-control"
                                               id="class_code" name="class_code"/>
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