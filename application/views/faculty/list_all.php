  <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Faculty Management</h1>
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
                                            <th>Faculty name</th>
                                            <th>Vice chancellor</th>
                                            <th>Learning director</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($faculties as $faculty){ ?>
                                        <tr class="odd gradeX">
                                            <td><?php echo $faculty['id'];?></td>
                                            <td><?php echo $faculty['name'];?></td>
                                            <td ><?php echo $users[$faculty['vice_chancellor_users_id']]['name']?></td>
                                            <td ><?php echo $users[$faculty['learning_director_users_id']]['name']?></td>
                                            <td class="center">
                                            <button type="button" class="btn btn-primary btn-circle" onclick="location.href = '<?php echo site_url('faculty/edit') .'/'. $faculty['id']?>';"><i class="fa fa-pencil"></i>
                          					 </button>
					                         <button type="button" class="btn btn-warning btn-circle" onclick='deleteFaculty(<?php echo $faculty['id'] ?>)'><i class="fa fa-times"></i>
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
        function deleteFaculty(id){
        	bootbox.confirm("Are you sure to delete this faculty?", function(result) {
        		  $('#hide-form').attr('action', '<?php echo site_url('faculty/delete')?>/' + id);
        		  $('#hide-form').submit();
        		}); 
        }
        </script>