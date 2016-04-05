
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Feedback form</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Report information
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
								<?php echo form_open_multipart('report/comment/' . $report['id'], ['class' => 'validate-form'])?>    
									<div class="form-group">
                                            <label>Course</label>
                                            <select class="form-control validate[required]" name="course" onchange="showYear()" id="course" readonly>
                                            <?php foreach ($courses as $key => $course){?>
                                                <option value='<?php echo $course['id']?>'><?php echo $course['name']?></option>
                                            <?php } ?>
                                            </select>
                                        </div>    
                                       
                                        <div class="form-group " >
                                            <label>Academic Year</label>
                                            <select class="form-control validate[required] " name="year" readonly>
                                             <?php foreach ($years_of_course  as $key => $years){?>
	                                            <?php foreach ($years as $key => $year){?>
	                                                <option class="hidden year years_<?php echo $key?>"  value='<?php echo $year['id']?>'  <?php echo ($report['academic_years_id'] == $year['id'])? 'selected' : '';?>><?php echo $year['year']?></option>
	                                            <?php } ?>
	                                          <?php } ?>  
                                            </select>
                                        </div> 
                                                                            
										<div class="form-group">
                                            <label>Name</label>
                                            <input class="form-control validate[required]" name="name" value="<?php echo $report['name'];?>" readonly>
                                        </div>
                                        	<div class="form-group">
                                              <label>Description</label>
                                          	 <textarea class="form-control validate[required]" name="description"  readonly rows="3"><?php echo $report['description']?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>File input</label>
                                            <?php if (!empty($report['file_url'])){?>
                                            <a style="margin-left: 20px;" onclick="javascript:location.href = '<?php echo site_url('report/download/').'/'. $report['id'];?>';"><i class="fa fa-download"></i> Download Report File</a><br/>
                                            <?php }?>
                                        </div>
                                         	<div class="form-group">
                                              <label>Comment</label>
                                          	 <textarea class="form-control validate[required]" name="comment"   rows="3"><?php echo $report['comment']?></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary" onclick="">Comment </button>
                                        <button type="button" class="btn btn-default" onclick="location.href = '<?php echo site_url('report/list_all')?>';">Cancel </button>
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
        
           <script>

        setTimeout(function(){ showYear(); }, 500);
        
        function showYear(){
            $(".year").addClass('hidden');
            var course_id = $( "#course option:selected" ).val();
            $(".years_" + course_id).removeClass('hidden');
        }

        </script>