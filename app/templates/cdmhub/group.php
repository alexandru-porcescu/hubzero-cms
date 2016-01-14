<?php
// no direct access
defined('_HZEXEC_') or die();

$browser = new \Hubzero\Browser\Detector();
$b = $browser->name();
$v = $browser->major();

$template = 'cdmhub';
?>
<!DOCTYPE html>
<!--[if lt IE 7 ]> <html dir="<?php echo  $this->direction; ?>" lang="<?php echo  $this->language; ?>" class="ie6"> <![endif]-->
<!--[if IE 7 ]>    <html dir="<?php echo  $this->direction; ?>" lang="<?php echo  $this->language; ?>" class="ie7"> <![endif]-->
<!--[if IE 8 ]>    <html dir="<?php echo  $this->direction; ?>" lang="<?php echo  $this->language; ?>" class="ie8"> <![endif]-->
<!--[if IE 9 ]>    <html dir="<?php echo  $this->direction; ?>" lang="<?php echo  $this->language; ?>" class="ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html dir="<?php echo $this->direction; ?>" lang="<?php echo  $this->language; ?>" class="<?php echo $b . ' ' . $b . $v; ?>"> <!--<![endif]-->
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />

		<link rel="stylesheet" type="text/css" media="screen" href="<?php echo \Hubzero\Document\Assets::getSystemStylesheet(array('fontcons', 'reset', 'columns', 'notifications', 'pagination', 'tabs', 'tags', 'comments', 'voting', 'layout')); /* reset MUST come before all others except fontcons */ ?>" />
		<link rel="stylesheet" href="<?php echo $this->baseurl; ?>/templates/<?php echo $template; ?>/css/main.css" type="text/css" />
		<link rel="stylesheet" href="<?php echo $this->baseurl; ?>/templates/<?php echo $template; ?>/css/group.css" type="text/css" />

		<jdoc:include type="head" />

		<!--[if IE 8]>
			<link rel="stylesheet" type="text/css" media="screen" href="<?php echo $this->baseurl; ?>/templates/<?php echo $template; ?>/css/ie8win.css" />
		<![endif]-->
		<!--[if IE 7]>
			<link rel="stylesheet" type="text/css" media="screen" href="<?php echo $this->baseurl; ?>/templates/<?php echo $template; ?>/css/ie7win.css" />
		<![endif]-->
	</head>
	<body class="contentpane" id="group-body">
		<jdoc:include type="modules" name="notices" />
		<jdoc:include type="modules" name="helppane" />
		<?php if ($this->countModules('helppane')) : ?>
			<p id="tab">
				<a href="/support" title="<?php echo Lang::txt('Need help? Send a trouble report to our support team.'); ?>">
					<span><?php echo Lang::txt('Need Help?'); ?></span>
				</a>
			</p>
		<?php endif; ?>

		<div id="special-bar">
			<a href="/" id="powered">powered by <span><?php echo Config::get('sitename'); ?></span></a>
			<p><a href="/about">Learn more about <?php echo Config::get('sitename'); ?></a></p>
		</div>

		<jdoc:include type="message" />
		<jdoc:include type="component" />
		<jdoc:include type="modules" name="endpage" />
	</body>
</html>
