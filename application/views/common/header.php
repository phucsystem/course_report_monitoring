<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo $title;?></title>

    <!-- Bootstrap Core CSS -->
    <link href="/assets/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="/assets/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="/assets/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="/assets/bower_components/datatables-responsive/css/responsive.dataTables.scss" rel="stylesheet">
    
     <!-- Validation Engine CSS -->
    <link rel="stylesheet" href="/assets/bower_components/validation-engine/css/validationEngine.jquery.css" type="text/css"/>

    <!-- Custom CSS -->
    <link href="/assets/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="/assets/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
    <div id="wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="" data-target=".navbar-">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html"><?php echo $title;?></a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-th-list fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
<!--                         <li><a href="#"><i class="fa fa-th-list fa-fw"></i> User Profile</a> -->
<!--                         </li> -->
                        <li class="divider"></li>
                        <li><a href="<?php echo site_url('user/logout');?>"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-">
                    <ul class="nav" id="side-menu">
<!--                         <li class="sidebar-search"> -->
<!--                             <div class="input-group custom-search-form"> -->
<!--                                 <input type="text" class="form-control" placeholder="Search..."> -->
<!--                                 <span class="input-group-btn"> -->
<!--                                 <button class="btn btn-default" type="button"> -->
<!--                                     <i class="fa fa-search"></i> -->
<!--                                 </button> -->
<!--                             </span> -->
<!--                             </div> -->
                            <!-- /input-group -->
<!--                         </li> -->
                        <li>
                            <a href="/"><i class="fa fa-dashboard fa-fw"></i> Home</a>
                        </li>
                        <?php if($session['role_id'] == USER_ROLE_ADMIN){?>
                        <li>
                            <a href="#"><i class="fa fa-users fa-fw"></i> Users<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level ">
                                <li>
                                    <a href="<?php echo site_url('user/list_all')?>"><i class="fa fa-th-list fa-fw"></i>  User list</a>
                                </li>
                                <li>
                                    <a href="<?php echo site_url('user/create')?>"><i class="fa fa-plus fa-fw"></i>  Add new user</a>
                                </li>
                            </ul>
                        </li>
                         <li>
                            <a href="#"><i class="fa fa-institution fa-fw"></i> Faculties<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level ">
                                <li>
                                    <a href="<?php echo site_url('faculty/list_all')?>"><i class="fa fa-th-list fa-fw"></i>  Faculties list</a>
                                </li>
                                <li>
                                    <a href="<?php echo site_url('faculty/create')?>"><i class="fa fa-plus fa-fw"></i>  Add new faculty</a>
                                </li>
                            </ul>
                        </li>
                          <?php }else if($session['role_id'] == USER_ROLE_CHANCELLOR || $session['role_id'] == USER_ROLE_LEARNING_DIRECTOR ){ ?>
                         <li>
                            <a href="#"><i class="fa fa-mortar-board fa-fw"></i> Courses<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level ">
                                <li>
                                    <a href="<?php echo site_url('course/list_all')?>"><i class="fa fa-th-list fa-fw"></i>  Course list</a>
                                </li>
                                <li>
                                    <a href="<?php echo site_url('course/create')?>"><i class="fa fa-plus fa-fw"></i>  Add new course</a>
                                </li>
                            </ul>
                        </li>
                         <li>
                            <a href="#"><i class="fa  fa-clock-o fa-fw"></i> Academic Years<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level ">
                                <li>
                                    <a href="<?php echo site_url('year/list_all')?>"><i class="fa fa-th-list fa-fw"></i>  Academic year list</a>
                                </li>
                                <li>
                                    <a href="<?php echo site_url('year/create')?>"><i class="fa fa-plus fa-fw"></i>  Add new academic year</a>
                                </li>
                            </ul>
                        </li>
                      <?php }else {?>
                         <li>
                            <a href="#"><i class="fa fa-book fa-fw"></i> Reports<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level ">
                                <li>
                                    <a href="<?php echo site_url('report/list_all')?>"><i class="fa fa-th-list fa-fw"></i>  Reports List</a>
                                </li>
                                <li>
                                    <a href="<?php echo site_url('report/create')?>"><i class="fa fa-plus fa-fw"></i>  Add new report</a>
                                </li>
                            </ul>
                        </li>
                        <?php  } ?>
                    </ul>
                </div>
                <!-- /.sidebar- -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
