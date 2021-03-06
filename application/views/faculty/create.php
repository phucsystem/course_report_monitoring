
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Create faculty form</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Faculty information
                        </div>
                        <div class="panel-body">
                        <?php if(!empty($error)){?>
                       <div class="alert alert-danger alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
                                <?php echo $error;?>
                            </div>
                            <?php }?>
                            <div class="row">
                                <div class="col-lg-12">
								<?php echo form_open('faculty/create', ['class' => 'validate-form'])?>                                        
								<div class="form-group">
                                            <label>Faculty name</label>
                                            <input class="form-control validate[required]" name="name" >
                                        </div>
                                        <div class="form-group">
                                            <label>Vice chancellor</label>
                                            <select class="form-control validate[required]" name="vice_chancellor">
                                            <?php foreach ($vice_chancellors as $key => $vice_chancellor){?>
                                                <option value='<?php echo $vice_chancellor['id']?>'><?php echo $vice_chancellor['name']?></option>
                                            <?php } ?>
                                            </select>
                                        </div>
                                         <div class="form-group">
                                            <label>Learning director</label>
                                            <select class="form-control validate[required]" name="learning_director">
                                            <?php foreach ($learning_directors as $key => $learning_director){?>
                                                <option value='<?php echo $learning_director['id']?>'><?php echo $learning_director['name']?></option>
                                            <?php } ?>
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-success">Submit </button>
                                        <button type="reset" class="btn btn-default">Reset </button>
                                    </form>
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->