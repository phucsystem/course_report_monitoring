
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Edit course form</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Course information
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
								<?php echo form_open('course/edit/'. $course['id'], ['class' => 'validate-form'])?>                                        
								<div class="form-group">
                                            <label>Code</label>
                                            <input class="form-control validate[required]" name="code" value="<?php echo $course['code']?>" >
                                        </div>
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input class="form-control validate[required]" name="name" value="<?php echo $course['name']?>" >
                                        </div>
                                         <div class="form-group">
                                            <label>Faculty</label>
                                            <select class="form-control validate[required]" name="learning_director">
                                            <?php foreach ($faculties as $key => $faculty){?>
                                                <option value='<?php echo $faculty['id']?>' <?php echo ($course['faculties_id'] == $key)? 'selected' : '';?>><?php echo $faculty['name']?></option>
                                            <?php } ?>
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-success">Submit </button>
                                        <button type="button" class="btn btn-default" onclick="location.href = '<?php echo site_url('course/list_all')?>';">Cancel </button>
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