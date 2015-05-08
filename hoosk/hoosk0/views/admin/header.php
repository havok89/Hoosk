<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Hoosk Dash - <?php echo SITE_NAME; ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="apple-mobile-web-app-capable" content="yes">
<link href="<?php echo ADMIN_THEME; ?>/css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo ADMIN_THEME; ?>/css/bootstrap-responsive.min.css" rel="stylesheet">
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600"
        rel="stylesheet">
<link href="<?php echo ADMIN_THEME; ?>/css/font-awesome.css" rel="stylesheet">
<link href="<?php echo ADMIN_THEME; ?>/css/style.css" rel="stylesheet">
<link href="<?php echo ADMIN_THEME; ?>/css/pages/dashboard.css" rel="stylesheet">
<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
<script src="<?php echo ADMIN_THEME; ?>/js/jquery-1.10.2.min.js"></script> 
<script src="<?php echo ADMIN_THEME; ?>/js/jquery-ui-1.9.2.js"></script> 
<script src="<?php echo ADMIN_THEME; ?>/js/jquery.nestable.js"></script> 

<script src="<?php echo ADMIN_THEME; ?>/js/excanvas.min.js"></script> 
<script src="<?php echo ADMIN_THEME; ?>/js/bootstrap.js"></script>
<script src="<?php echo ADMIN_THEME; ?>/js/base.js"></script> 
</head>
<body>
<div class="wrapper">
<div class="navbar navbar-fixed-top">
  <div class="navbar-inner">
    <div class="container">     <div class="navbar-header"><a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"><span
                    class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span> </a><a class="brand"><img src="<?php echo ADMIN_THEME; ?>/images/logo.png"></a>
      </div>
      <div class="nav-collapse">
        <ul class="nav pull-right">
        <li><a href="<?php echo BASE_URL ; ?>" target="_blank"><i class="icon-home"></i> <?php echo $this->lang->line('nav_view_site'); ?></a>
          <li class="dropdown"><a class="dropdown-toggle"  href="#" data-toggle="dropdown"><i
                            class="icon-cog"></i> <?php echo $this->session->userdata('userName'); ?> <b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a href="/admin/users/edit/<?php echo $this->session->userdata('userID'); ?>"><?php echo $this->lang->line('nav_profile'); ?></a></li>
              <!--<li><a href="javascript:;">Help</a></li>-->
            </ul>
          </li>
          <li><a href="<?php echo BASE_URL ; ?>/admin/logout"><i class="icon-remove-sign "></i> <?php echo $this->lang->line('nav_logout'); ?></a>
          </li>
         </ul>
      
      </div>
      <!--/.nav-collapse --> 
    </div>
    <!-- /container --> 
  </div>
  <!-- /navbar-inner --> 
</div>
<!-- /navbar -->
<div class="subnavbar">
  <div class="subnavbar-inner">
    <div class="container">
      <ul class="mainnav">
        <li class="<?php if ($current == "") { echo "active"; } ?>"><a href="/admin"><i class="icon-dashboard"></i><span><?php echo $this->lang->line('nav_dash'); ?></span> </a> </li>
        <li class="dropdown <?php if ($current == "pages") { echo "active"; } ?>"><a href="#" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-file"></i><span><?php echo $this->lang->line('nav_pages'); ?></span> <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="/admin/pages"><?php echo $this->lang->line('nav_pages_all'); ?></a></li>
            <li><a href="/admin/pages/new"><?php echo $this->lang->line('nav_pages_new'); ?></a></li>
          </ul>
        </li>
        <li class="dropdown <?php if ($current == "posts") { echo "active"; } ?>"><a href="#" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-edit"></i><span><?php echo $this->lang->line('nav_posts'); ?></span> <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="/admin/posts"><?php echo $this->lang->line('nav_posts_all'); ?></a></li>
            <li><a href="/admin/posts/new"><?php echo $this->lang->line('nav_posts_new'); ?></a></li>
            <li><a href="/admin/posts/categories"><?php echo $this->lang->line('nav_categories_all'); ?></a></li>
            <li><a href="/admin/posts/categories/new"><?php echo $this->lang->line('nav_categories_new'); ?></a></li>
          </ul>
        </li>
        <li class="dropdown <?php if ($current == "users") { echo "active"; } ?>"><a href="#" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-user"></i><span><?php echo $this->lang->line('nav_users'); ?></span> <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="/admin/users"><?php echo $this->lang->line('nav_users_all'); ?></a></li>
            <li><a href="/admin/users/new"><?php echo $this->lang->line('nav_users_new'); ?></a></li>
          </ul>
        </li>
        <li class="dropdown <?php if ($current == "navigation") { echo "active"; } ?>"><a href="#" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-list"></i><span><?php echo $this->lang->line('nav_navigation'); ?></span> <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="/admin/navigation"><?php echo $this->lang->line('nav_navigation_all'); ?></a></li>
            <li><a href="/admin/navigation/new"><?php echo $this->lang->line('nav_navigation_new'); ?></a></li>
          </ul>
        </li>
        <li class="<?php if ($current == "settings") { echo "active"; } ?>"><a href="/admin/settings"><i class="icon-cog"></i><span><?php echo $this->lang->line('nav_settings'); ?></span> </a> </li>
       </ul>
    </div>
    <!-- /container --> 
  </div>
  <!-- /subnavbar-inner --> 
</div>