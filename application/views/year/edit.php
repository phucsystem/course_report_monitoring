
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Edit academic year form</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Academic year information
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
								<?php echo form_open('year/edit/' . $year['id'], ['class' => 'validate-form'])?>                                        
										<div class="form-group">
                                            <label>Year</label>
                                            <input class="form-control validate[required, custom[number]]" name="year" value="<?php echo $year['year']?>">
                                        </div>
                                        	<div class="form-group">
                                              <label>Course</label>
                                            <select class="form-control validate[required]" name="courses_id">
                                            <?php foreach ($courses as $key => $course){?>
                                                <option value='<?php echo $course['id']?>' <?php echo ($year['courses_id'] == $key)? 'selected' : '';?>><?php echo $course['name']?></option>
                                            <?php } ?>
                                            </select>
                                        </div>
                                         <div class="form-group">
                                            <label>Course Leader</label>
                                            <select class="form-control validate[required]" name="course_leader_users_id">
                                            <?php foreach ($course_leaders as $key => $user){?>
                                                <option value='<?php echo $user['id']?>' <?php echo ($year['course_leader_users_id'] == $key)? 'selected' : '';?>><?php echo $user['name']?></option>
                                            <?php } ?>
                                            </select>
                                        </div>
                                         <div class="form-group">
                                            <label>Course Moderator</label>
                                            <select class="form-control validate[required]" name="course_moderator_users_id">
                                            <?php foreach ($course_moderators as $key => $user){?>
                                                <option value='<?php echo $user['id']?>' <?php echo ($year['course_moderator_users_id'] == $key)? 'selected' : '';?>><?php echo $user['name']?></option>
                                            <?php } ?>
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-success">Submit </button>
                                        <button type="button" class="btn btn-default" onclick="location.href = '<?php echo site_url('year/list_all')?>';">Cancel </button>
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