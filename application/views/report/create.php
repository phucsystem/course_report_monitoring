
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Create report form</h1>
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
								<?php echo form_open_multipart('report/create', ['class' => 'validate-form'])?>      
										<div class="form-group">
                                            <label>Course</label>
                                            <select class="form-control validate[required]" name="course" onchange="showYear()" id="course">
                                            <?php foreach ($courses as $key => $course){?>
                                                <option value='<?php echo $course['id']?>'><?php echo $course['name']?></option>
                                            <?php } ?>
                                            </select>
                                        </div>    
                                          <div class="form-group " >
                                            <label>Academic Year</label>
                                            <select class="form-control validate[required] " name="year">
                                             <?php foreach ($years_of_course  as $key => $years){?>
	                                            <?php foreach ($years as $key => $year){?>
	                                                <option class="hidden year years_<?php echo $year['courses_id']?>"  value='<?php echo $year['id']?>'><?php echo $year['year'];?>  </option>
	                                            <?php } ?>
	                                          <?php } ?>  
                                            </select>                            
										<div class="form-group">
                                            <label>Name</label>
                                            <input class="form-control validate[required]" name="name" >
                                        </div>
                                        	<div class="form-group">
                                              <label>Description</label>
                                              <textarea class="form-control validate[required]" name="description"  rows="3"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>File input</label>
                                            <input type="file" name="file" class="form-control validate[required]"/>
                                        </div>
                                        <button type="submit" class="btn btn-success">Submit </button>
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