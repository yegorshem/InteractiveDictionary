<?php
/**
 * User: Yegor Shemereko
 * Date: 11/6/2016
 * Time: 11:10 PM
 */
?>

<!-- modal-->
<div id="newClass" class="modal fade">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h3 class="modal-title">New Class</h3>
            </div>

            <form id="new-class-form">
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-12">
                            <h4>Class</h4>

                            <div class="row">

                                <div class="col-md-5">
                                    <div class="input-group">
                                        <label class="input-group-addon" for="class_name">Class Name</label>
                                        <input required="required" type="text" class="form-control"
                                               id="class_name" name="class_name"/>
                                    </div>
                                </div>


                            </div>

                            <br>

                            <div class="row">
                                <div class="col-md-7">
                                    <div class="input-group">
                                        <label class="input-group-addon" for="teacherPicker">Teacher</label>
                                        <select id="teacherPicker" class="selectpicker form-control" name="teacherPicker">
                                            <option value="0" disabled="disabled" selected="selected">Select a teacher</option>
                                        </select>

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
