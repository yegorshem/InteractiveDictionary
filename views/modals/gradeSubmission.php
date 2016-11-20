<?php
/**
 * Created by PhpStorm.
 * User: Joel
 * Date: 11/18/2016
 * Time: 12:27 AM
 */
?>
<!-- modal-->
<div id="gradeModal" class="modal fade">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h3 class="modal-title">Grade Submission</h3>
            </div>
            <form id="grade-word-form">
                <div class="modal-body">
                    <input type="hidden" id="word_id" name="word_id" value="0">
                    <div class="row">
                        <div class="col-md-12">
                            <div id="grade_word_error"></div>
                            <div class="row">
                                <div class="col-md-10 col-md-offset-1">
                                    <b>Word:</b><span id="grading_word"></span></br>
                                    <b>Definition:</b><span id="grading_definition"></span><br>
                                    <b>Category:</b><span id="grading_category"></span><br>
                                    <img id="grading_image">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <label class="input-group-addon" for="word_grade">Word</label>
                                        <input required="required" type="number" min=0 max=1 class="form-control"
                                               id="word_grade" name="word_grade"/>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <label class="input-group-addon" for="category_grade">Category</label>
                                        <input type="number" min=0 max=1 class="form-control" id="category_grade"
                                               name="category_grade" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <label class="input-group-addon" for="definition">Definition</label>
                                        <input required="required" type="number" min=0 max=1 class="form-control"
                                               id="definition_grade" name="definition_grade"/>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="input-group">
                                    <label class="input-group-addon" for="image_grade">Image</label>
                                    <input required="required" type="number" min=0 max=1 class="form-control"
                                           id="image_grade" name="image_grade"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-12">
                            <label class="input-group-addon" for="comments">Comments</label>
                            <textarea id="comments" name="comments" class="form-control" rows=3 maxlength=255></textarea>
                            <p id="commentCharCount"></p>
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

