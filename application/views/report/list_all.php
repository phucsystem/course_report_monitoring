  <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Report Management</h1>
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
                                            <th>Name</th>
                                            <th>Status</th>
                                            <th>Create By</th>
                                            <th>Create Datetime</th>
                                            <th>Approve By</th>
                                            <th>Approve Datetime</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($reports as $report){ ?>
                                        <tr class="odd gradeX">
                                            <td><?php echo $report['id'];?></td>
                                            <td><?php echo $report['name'];?></td>
                                            <td><?php echo $statuses[$report['status']]?></td>
                                            <td><?php echo (!empty($users[$report['create_by']]))? $users[$report['create_by']]['name'] :''?></td>
                                            <td><?php echo $report['create_datetime']?></td>
                                            <td><?php echo (!empty($users[$report['approve_by']]))? $users[$report['approve_by']]['name'] :''?></td>
                                            <td><?php echo $report['approve_datetime']?> <?php if($report['late'] == true){?><span style='color:red'>Late Reponse</span><?php } ?></td>
                                            <td class="left">
                                            <?php if($session['role_id'] == USER_ROLE_CHANCELLOR || $session['role_id'] == USER_ROLE_LEARNING_DIRECTOR){?>
                                            <button type="button" data-toggle="tooltip" data-placement="top" title="Comment" class="btn btn-primary btn-circle" onclick="location.href = '<?php echo site_url('report/comment') .'/'. $report['id']?>';"><i class="fa fa-pencil"></i>
                          					 </button>
                          					 <?php } ?>
                          					 <?php if($session['role_id'] == USER_ROLE_LEARNING_COURSE_LEADER){?>
					                         <button type="button" data-toggle="tooltip" data-placement="top" title="Delete" class="btn btn-warning btn-circle" onclick='deleteItem(<?php echo $report['id'] ?>)'><i class="fa fa-trash-o"></i>
                          					 </button>
                          					 <?php }?>
                          					 <?php if($session['role_id'] == USER_ROLE_LEARNING_COURSE_MODERATOR){?>
                                            <button type="button" data-toggle="tooltip" data-placement="top" title="Approve" class="btn btn-info btn-circle" 
                                             onclick="javascript:location.href = '<?php echo site_url('report/view/').'/'. $report['id'];?>';"><i class="fa fa-check"></i>
                          					 </button>
                                            <?php } ?>
                          					  <?php if (!empty($report['file_url'])){?>
                                            <button type="button" data-toggle="tooltip" data-placement="top" title="Download Report" class="btn btn-default btn-circle" 
                                            onclick="javascript:location.href = '<?php echo site_url('report/download/').'/'. $report['id'];?>';"><i class="fa fa-download"></i></button>
                                            <?php }?>
                                            
                          					 
<!--                           					  <button type="button" data-toggle="tooltip" data-placement="top" title="Reject" class="btn btn-danger btn-circle"><i class="fa fa-times"></i> -->
<!--                           					 </button> -->
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
        	bootbox.confirm("Are you sure to delete this report?", function(result) {
        		  $('#hide-form').attr('action', '<?php echo site_url('report/delete')?>/' + id);
        		  $('#hide-form').submit();
        		}); 
        }
        </script>