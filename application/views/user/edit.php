
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Edit user form</h1>
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
								<?php echo form_open('user/edit/'.$user['id'], ['class' => 'validate-form'])?>                                        
								<div class="form-group">
                                            <label>Account name</label>
                                            <input class="form-control validate[required]" name="account" value="<?php echo $user['account_name']?>" >
                                        </div>
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input class="form-control "  name="password" id="password" type="password" value="">
                                        </div>
                                        <div class="form-group">
                                            <label>Re-enter Password</label>
                                            <input class="form-control validate[equals[password]]"  name="re-password" type="password" value="">
                                        </div>
                                         <div class="form-group">
                                            <label>Name</label>
                                            <input class="form-control validate[required]"  name="name" value="<?php echo $user['name']?>">
                                        </div>
                                          <div class="form-group">
                                            <label>Email</label>
                                            <input class="form-control validate[required, custom[email]]"  name="email" value="<?php echo $user['email']?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Role</label>
                                            <select class="form-control validate[required]" name="role">
                                            <?php foreach ($user_roles as $key => $user_role){?>
                                                <option value='<?php echo $key?>' <?php echo ($user['role_id'] == $key)? 'selected' : '';?>><?php echo $user_role?></option>
                                            <?php } ?>
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-success">Submit </button>
                                        <button type="button" class="btn btn-default" onclick="location.href = '<?php echo site_url('user/list_all')?>';">Cancel </button>
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