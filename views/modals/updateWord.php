<?php
/**
 * Created by PhpStorm.
 * User: Yegor Shemereko
 * Date: 10/4/2016
 * Time: 2:33 PM
 */
?>

<!-- modal-->
<div id="updateModal" class="modal fade">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h3 class="modal-title">Adding Word</h3>
            </div>
            <form id="update-word-form">
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-12">
                            <h4>Word</h4>

                            <div class="row">

                                <input type="hidden" id="id_update" name="id_update" value="0">

                                <div class="col-md-4">
                                    <div class="input-group">
                                        <label class="input-group-addon" for="word_update">Word</label>
                                        <input required="required" type="text" class="form-control"
                                               id="word_update" name="word_update"/>
                                    </div>
                                </div>
                            </div>

                            <br>
                            <div class="row">
                                <div class="col-md-10">
                                    <div class="input-group">
                                        <label class="input-group-addon" for="definition_update">Definition</label>
                                        <input required="required" type="text" class="form-control"
                                               id="definition_update" name="definition_update"/>
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