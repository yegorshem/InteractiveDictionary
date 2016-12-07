<?php
/**
 * Created by PhpStorm.
 * User: Joel Watson
 * Date: 10/7/2016
 * Time: 10:39 AM
 */
?>

<!-- modal-->
<div id="loginModal" class="modal fade">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <img src="imgs/toolbox.jpg">
            </div>

            <form id="form-select">
                <div class="row">
                    <div class="col-md-10 col-md-offset-2">
                        <div class="input-group">
                            <div id="selectUserType">
                                <p id="forgot-btn"><a href="#" data-toggle="modal"
                                                                      data-target="#forgotModal">Forgot Password</a></p>
                                <label for="adminForm">Admin &nbsp</label>
                                <input type="radio" id="adminForm" name="selectForm" checked="checked">
                                <label for="studentForm">&nbsp Student &nbsp</label>
                                <input type="radio" id="studentForm" name="selectForm">
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <div class="modal-body">
                <p id="add_err"></p>
                <form id="admin-login-form" method="post">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-10 col-md-offset-1">
                                    <div class="input-group">
                                        <label class="input-group-addon" for="adminUsername">Username</label>
                                        <input required="required" type="text" class="form-control"
                                               id="adminUsername" name="adminUsername"/>
                                    </div>
                                </div>
                                <br>
                                <br>
                                <div class="col-md-10 col-md-offset-1">
                                    <div class="input-group">
                                        <label class="input-group-addon" for="adminPassword">Password</label>
                                        <input required="required" type="password" class="form-control"
                                               id="adminPassword" name="adminPassword"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="modal-footer">
                        <button type="button" data-dismiss="modal" class="btn btn-secondary">Cancel</button>
                        <input type="submit" value="Login" class="btn btn-success" name='login' id="login"/>
                    </div>
                </form>
                <form id="student-login-form" method="post">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-10 col-md-offset-1">
                                    <div class="input-group">
                                        <label class="input-group-addon" for="studentUsername">Username</label>
                                        <input required="required" type="text" class="form-control"
                                               id="studentUsername" name="studentUsername"/>
                                    </div>
                                </div>

                                <div class="col-md-10 col-md-offset-1">
                                    <div class="input-group">
                                        <label class="input-group-addon" for="studentPassword">Password</label>
                                        <input required="required" type="password" class="form-control"
                                               id="studentPassword" name="studentPassword"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="modal-footer">
                        <button type="button" data-dismiss="modal" class="btn btn-secondary">Cancel</button>
                        <input type="submit" value="Login" class="btn btn-success" name='login' id="login"/>
                    </div>
                    <p>Don't have an account yet? click <a data-toggle='modal' data-target='#registerModal'
                                                           data-dismiss='modal'>Sign Up!</a></p>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
