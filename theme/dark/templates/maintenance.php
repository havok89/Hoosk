<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<title><?php echo $settings['siteMaintenanceHeading']; ?> | <?php echo $settings['siteTitle']; ?> </title>
		<meta name="description" content="<?php echo $settings['siteMaintenanceMeta']; ?>" />
		<meta name="keywords" content="" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<?php if ($settings['siteFavicon']!=""){ ?>
		<link rel="icon" href="<?php echo BASE_URL; ?>/images/<?php echo $settings['siteFavicon']; ?>" />
		<?php } ?>
		<link href="<?php echo THEME_FOLDER; ?>/css/bootstrap.min.css" rel="stylesheet">
		<!--[if lt IE 9]>
			<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<link href="<?php echo THEME_FOLDER; ?>/css/socicon.css" rel="stylesheet">
		<link href="<?php echo THEME_FOLDER; ?>/css/styles.css" rel="stylesheet">
	</head>
	<body>
		<div class="maintenance text-center">
			<div class="container">
			  <div class="row">
				<div class="col col-lg-12 col-sm-12">
				<img src="<?php echo BASE_URL; ?>/images/<?php echo $settings['siteLogo']; ?>" alt="<?php echo $settings['siteTitle']; ?>" class="maintenance-logo">
				<h1><?php echo $settings['siteMaintenanceHeading']; ?></h1>
				<p><?php echo $settings['siteMaintenanceContent']; ?></p>
				<p><?php echo $settings['siteFooter']; ?></p>
				<?php getSocial(); ?>
				</div>
			  </div>
			</div>
		</div>
	</body>
</html>
