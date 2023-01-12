<?php if(!defined('IN_GS')){ die('you cannot load this page directly.'); }?>
	
<!DOCTYPE html>
<html lang="en">
<head>

	<!-- Site Title -->
	<title><?php get_page_clean_title(); ?> &lt; <?php get_site_name(); ?></title>
	<meta name="rentals" content="index, movies,tvshows" />
	<meta charset="utf-8">
	<meta name="theme-color" content="#4285f4" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="<?php get_theme_url(); ?>/css/reset.css" rel="stylesheet" type="text/css"  media="all" />
	<link href="<?php get_theme_url(); ?>/css/style.css" rel="stylesheet" type="text/css" media="all" />
	<link href="<?php get_theme_url(); ?>/css/smallDevicesStyle.css" media="screen and (max-width: 1000px)" rel="stylesheet" />
	<link href="<?php get_theme_url(); ?>/css/mediumDevicesIndexStyle.css" media="screen and (max-width: 1200px)" rel="stylesheet" />
	<link rel="apple-touch-icon" href="../../data/uploadsBackground.webp">
</head>
<body onload="checkCookie()">
	<?php include('header.inc.php');?>
	<div>
		<?php get_page_content(); ?>
	</div>
	<p id="last-visit-text">&nbsp;</p>
	<?php include('footer.inc.php'); ?>
</body>
</html>
