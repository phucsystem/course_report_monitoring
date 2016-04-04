  <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Academic Year Management</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                             List
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Year</th>
                                            <th>Course</th>
                                            <th>Course Leader</th>
                                            <th>Course Moderator</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($years as $year){ ?>
                                        <tr class="odd gradeX">
                                            <td><?php echo $year['id'];?></td>
                                            <td><?php echo $year['year'];?></td>
                                            <td><?php echo $courses[$year['courses_id']]['name'];?></td>
											<td><?php echo (!empty($year['course_leader_users_id']))? $users[$year['course_leader_users_id']]['name'] : '';?></td>
                                            <td><?php echo (!empty($year['course_moderator_users_id']))?  $users[$year['course_moderator_users_id']]['name'] : '';?></td>
                                            <td class="center">
                                            <button type="button" class="btn btn-primary btn-circle" onclick="location.href = '<?php echo site_url('year/edit') .'/'. $year['id']?>';"><i class="fa fa-pencil"></i>
                          					 </button>
					                         <button type="button" class="btn btn-warning btn-circle" onclick='deleteItem(<?php echo $year['id'] ?>)'><i class="fa fa-times"></i>
                          					 </button>
                           					</td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
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
        <form action='' method='POST' id='hide-form'>
        </form>
        
        <script>
        function deleteItem(id){
        	bootbox.confirm("Are you sure to delete this academic year?", function(result) {
        		  $('#hide-form').attr('action', '<?php echo site_url('year/delete')?>/' + id);
        		  $('#hide-form').submit();
        		}); 
        }
        </script>