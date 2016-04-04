  <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">User Management</h1>
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
                                            <th>Account name</th>
                                            <th>Name</th>
                                            <th>Role</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($users as $user){ ?>
                                        <tr class="odd gradeX">
                                            <td><?php echo $user['id'];?></td>
                                            <td><?php echo $user['account_name'];?></td>
                                            <td><?php echo $user['name'];?></td>
                                            <td class="center"><?php echo $user_roles[$user['role_id']]?></td>
                                            <td class="center">
                                            <button type="button" class="btn btn-primary btn-circle" onclick="location.href = '<?php echo site_url('user/edit') .'/'. $user['id']?>';"><i class="fa fa-pencil"></i>
                          					 </button>
					                         <button type="button" class="btn btn-warning btn-circle" onclick='deleteUser(<?php echo $user['id'] ?>)'><i class="fa fa-times"></i>
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
        function deleteUser(id){
        	bootbox.confirm("Are you sure to delete this user?", function(result) {
        		  $('#hide-form').attr('action', '<?php echo site_url('user/delete')?>/' + id);
        		  $('#hide-form').submit();
        		}); 
        }
        </script>