<?php
/**
 * User: Yegor Shemereko
 * Date: 11/6/2016
 * Time: 11:07 PM
 */
?>

<!-- modal-->
<div id="newTeacher" class="modal fade">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h3 class="modal-title">New Teacher</h3>
            </div>

            <form id="new-teacher-form">
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-12">
                            <h4>Teacher</h4>

                            <p id="create-teacher-error"></p>
                            <div class="row">

                                <div class="col-md-5">
                                    <div class="input-group">
                                        <label class="input-group-addon" for="teacher_first_name">First Name</label>
                                        <input required="required" type="text" class="form-control"
                                               id="teacher_first_name" name="first_name"/>
                                    </div>
                                </div>

                                <div class="col-md-5">
                                    <div class="input-group">
                                        <label class="input-group-addon" for="teacher_last_name">Last Name</label>
                                        <input required="required" type="text" class="form-control"
                                               id="teacher_last_name" name="last_name"/>
                                    </div>
                                </div>

                            </div>

                            <br>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <label class="input-group-addon" for="teacher_email">Email</label>
                                        <input required="required" type="email" class="form-control"
                                               id="teacher_email" name="email"/>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="input-group">
                                        <label class="input-group-addon" for="teacher_password">Password</label>
                                        <input required="required" type="password" class="form-control"
                                               id="teacher_password" name="password"/>
                                    </div>
                                </div>
                            </div>

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
