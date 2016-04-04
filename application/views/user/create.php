
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Create user form</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            User information
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
								<?php echo form_open('user/create', ['class' => 'validate-form'])?>                                        
								<div class="form-group">
                                            <label>Account name</label>
                                            <input class="form-control validate[required]" name="account" >
                                        </div>
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input class="form-control validate[required,minSize[6]]"  name="password" id="password" type="password">
                                        </div>
                                        <div class="form-group">
                                            <label>Re-enter Password</label>
                                            <input class="form-control validate[required,equals[password]]"  name="re-password" type="password">
                                        </div>
                                         <div class="form-group">
                                            <label>Name</label>
                                            <input class="form-control validate[required]"  name="name">
                                        </div>
                                          <div class="form-group">
                                            <label>Email</label>
                                            <input class="form-control validate[required, custom[email]]"  name="email">
                                        </div>
                                        <div class="form-group">
                                            <label>Role</label>
                                            <select class="form-control validate[required]" name="role">
                                            <?php foreach ($user_roles as $key => $user_role){?>
                                                <option value='<?php echo $key?>'><?php echo $user_role?></option>
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