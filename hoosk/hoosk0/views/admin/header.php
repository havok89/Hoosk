<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Hoosk Dash - <?php echo SITE_NAME; ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link href="<?php echo ADMIN_THEME; ?>/css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo ADMIN_THEME; ?>/css/sb-admin.css" rel="stylesheet">
<link href="<?php echo ADMIN_THEME; ?>/css/jquery.fancybox-1.3.4.css" rel="stylesheet">
<link href="<?php echo ADMIN_THEME; ?>/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">


<script src="<?php echo ADMIN_THEME; ?>/js/jquery-1.10.2.min.js"></script>
<script src="<?php echo ADMIN_THEME; ?>/js/jquery.fancybox-1.3.4.pack.js"></script>
<script src="<?php echo ADMIN_THEME; ?>/js/jquery-ui-1.9.2.js"></script>
<script src="<?php echo ADMIN_THEME; ?>/js/jquery.nestable.js"></script>
<script src="<?php echo ADMIN_THEME; ?>/js/excanvas.min.js"></script>
<script src="<?php echo ADMIN_THEME; ?>/js/bootstrap.js"></script>
<script src="<?php echo ADMIN_THEME; ?>/js/base.js"></script>
</head>
<body>
<div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo BASE_URL;?>/admin"><img src="<?php echo ADMIN_THEME; ?>/images/large_logo.png" class="logo-icon" alt="Hoosk CMS"></a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
             	<li>
                    <a href="<?php echo BASE_URL; ?>" target="_blank"><i class="fa fa-home"></i></a>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $this->session->userdata('userName'); ?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="<?php echo BASE_URL ; ?>/admin/logout"><i class="fa fa-fw fa-power-off"></i> <?php echo $this->lang->line('nav_logout'); ?></a>                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li class="<?php if ($current == "") { echo "active"; } ?>">
                    	<a href="/admin"><i class="fa fa-dashboard"></i> <span><?php echo $this->lang->line('nav_dash'); ?></span> </a>
                    </li>
					<li class="dropdown <?php if ($current == "pages") { echo "active"; } ?>">
                    	<a href="javascript:;" data-toggle="collapse" data-target="#pagesmenu"> <i class="fa fa-file"> </i> <span><?php echo $this->lang->line('nav_pages'); ?></span> <i class="fa fa-fw fa-caret-down"></i></a>
                      <ul id="pagesmenu" class="collapse<?php if ($current == "pages") { echo " in"; } ?>">
                        <li<?php if (($current == "pages")&&($this->uri->segment(3)=="")) { echo ' class="active"'; } ?>><a href="/admin/pages"><?php echo $this->lang->line('nav_pages_all'); ?></a></li>
                        <li<?php if (($current == "pages")&&($this->uri->segment(3)=="new")) { echo ' class="active"'; } ?>><a href="/admin/pages/new"><?php echo $this->lang->line('nav_pages_new'); ?></a></li>
                      </ul>
       				</li>
                    <li class="dropdown <?php if ($current == "posts") { echo "active"; } ?>">
        <a href="javascript:;" data-toggle="collapse" data-target="#postsmenu"> <i class="fa fa-newspaper-o"></i> <span><?php echo $this->lang->line('nav_posts'); ?></span> <b class="caret"></b></a>
          <ul id="postsmenu" class="collapse<?php if ($current == "posts") { echo " in"; } ?>">
            <li<?php if (($current == "posts")&&($this->uri->segment(3)=="")) { echo ' class="active"'; } ?>><a href="/admin/posts"><?php echo $this->lang->line('nav_posts_all'); ?></a></li>
            <li<?php if (($current == "posts")&&($this->uri->segment(3)=="new")) { echo ' class="active"'; } ?>><a href="/admin/posts/new"><?php echo $this->lang->line('nav_posts_new'); ?></a></li>
            <li<?php if (($current == "posts")&&($this->uri->segment(3)=="categories")&&($this->uri->segment(4)=="")) { echo ' class="active"'; } ?>><a href="/admin/posts/categories"><?php echo $this->lang->line('nav_categories_all'); ?></a></li>
            <li<?php if (($current == "posts")&&($this->uri->segment(3)=="categories")&&($this->uri->segment(4)=="new")) { echo ' class="active"'; } ?>><a href="/admin/posts/categories/new"><?php echo $this->lang->line('nav_categories_new'); ?></a></li>
          </ul>
        </li>
        <li class="dropdown <?php if ($current == "users") { echo "active"; } ?>">
        <a href="javascript:;" data-toggle="collapse" data-target="#usersmenu"> <i class="fa fa-user"></i> <span><?php echo $this->lang->line('nav_users'); ?></span> <b class="caret"></b></a>
          <ul id="usersmenu" class="collapse<?php if ($current == "users") { echo " in"; } ?>">
            <li<?php if (($current == "users")&&($this->uri->segment(3)=="")) { echo ' class="active"'; } ?>><a href="/admin/users"><?php echo $this->lang->line('nav_users_all'); ?></a></li>
            <li<?php if (($current == "users")&&($this->uri->segment(3)=="new")) { echo ' class="active"'; } ?>><a href="/admin/users/new"><?php echo $this->lang->line('nav_users_new'); ?></a></li>
          </ul>
        </li>
        <li class="dropdown <?php if ($current == "navigation") { echo "active"; } ?>">
        <a href="javascript:;" data-toggle="collapse" data-target="#navigationmenu"> <i class="fa fa-list-alt"></i> <span><?php echo $this->lang->line('nav_navigation'); ?></span> <b class="caret"></b></a>
          <ul id="navigationmenu" class="collapse<?php if ($current == "navigation") { echo " in"; } ?>">
            <li <?php if (($current == "navigation")&&($this->uri->segment(3)=="")) { echo ' class="active"'; } ?>><a href="/admin/navigation"><?php echo $this->lang->line('nav_navigation_all'); ?></a></li>
            <li<?php if (($current == "navigation")&&($this->uri->segment(3)=="new")) { echo ' class="active"'; } ?>><a href="/admin/navigation/new"><?php echo $this->lang->line('nav_navigation_new'); ?></a></li>
          </ul>
        </li>
         <li class="<?php if ($current == "social") { echo "active"; } ?>"><a href="/admin/social"><i class="fa fa-share-alt"></i> <span><?php echo $this->lang->line('nav_social'); ?></span> </a> </li>
         <li class="<?php if ($current == "settings") { echo "active"; } ?>"><a href="/admin/settings"><i class="fa fa-cogs"></i> <span><?php echo $this->lang->line('nav_settings'); ?></span> </a> </li>

                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">
