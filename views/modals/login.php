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
                <h3 class="modal-title">Please Sign In</h3>
            </div>
            <form id="login-form" method="post">
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-12">
                            <p id="add_err"></p>
                            <div class="row">

                                <div class="col-md-10 col-md-offset-1">
                                    <div class="input-group">
                                        <label class="input-group-addon" for="username">Username</label>
                                        <input required="required" type="text" class="form-control"
                                               id="username" name="username"/>
                                    </div>
                                </div>

                                <div class="col-md-10 col-md-offset-1">
                                    <div class="input-group">
                                        <label class="input-group-addon" for="password">Password</label>
                                        <input required="required" type="password" class="form-control"
                                               id="password" name="password"/>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-secondary">Cancel</button>
                    <input type="submit" value="Login" class="btn btn-success" name='login' id="login" />
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
