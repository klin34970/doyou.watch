<?php 

use Helpers\Hooks;

//initialise hooks
$hooks = Hooks::get(); 

?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->

    <!-- START @HEAD -->
    <head>
        <!-- START @META SECTION -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <title><?php echo $title; ?></title>
		
		<?php $hooks->run('meta'); ?>
		
		<meta name="xhamster-site-verification" content="1418139803:42257"/>
		<meta name="hubtraffic-domain-validation"  content="04796d852353ad5c" />
        <!--/ END META SECTION -->

        <!-- START @FAVICONS -->
        <link href="<?=Url::templatePath();?>images/logo-144x144.png" rel="apple-touch-icon-precomposed" sizes="144x144">
        <link href="<?=Url::templatePath();?>images/logo-114x114.png" rel="apple-touch-icon-precomposed" sizes="114x114">
        <link href="<?=Url::templatePath();?>images/logo-72x72.png" rel="apple-touch-icon-precomposed" sizes="72x72">
        <link href="<?=Url::templatePath();?>images/logo-57x57.png" rel="apple-touch-icon-precomposed">
        <link href="<?=Url::templatePath();?>images/logo-144x144.png" rel="shortcut icon">
        <!--/ END FAVICONS -->

        <!-- START @FONT STYLES -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700" rel="stylesheet">
        <!--/ END FONT STYLES -->

        <!-- START @GLOBAL MANDATORY STYLES -->
        <link href="<?=Url::templatePath();?>global/plugins/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <!--/ END GLOBAL MANDATORY STYLES -->

        <!-- START @PAGE LEVEL STYLES -->
        <link href="<?=Url::templatePath();?>global/plugins/bower_components/fontawesome/css/font-awesome.min.css" rel="stylesheet">
        <link href="<?=Url::templatePath();?>global/plugins/bower_components/animate.css/animate.min.css" rel="stylesheet">
        <!--/ END PAGE LEVEL STYLES -->

        <!-- START @THEME STYLES -->
        <link href="<?=Url::templatePath();?>admin/css/reset.css" rel="stylesheet">
        <link href="<?=Url::templatePath();?>admin/css/layout.css" rel="stylesheet">
        <link href="<?=Url::templatePath();?>admin/css/components.css" rel="stylesheet">
        <link href="<?=Url::templatePath();?>admin/css/plugins.css" rel="stylesheet">
        <link href="<?=Url::templatePath();?>admin/css/themes/default.theme.css" rel="stylesheet" id="theme">
        <link href="<?=Url::templatePath();?>admin/css/custom.css" rel="stylesheet">
        <!--/ END THEME STYLES -->

        <!-- START @IE SUPPORT -->
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="<?=Url::templatePath();?>global/plugins/bower_components/html5shiv/dist/html5shiv.min.js"></script>
        <script src="<?=Url::templatePath();?>global/plugins/bower_components/respond-minmax/dest/respond.min.js"></script>
        <![endif]-->
        <!--/ END IE SUPPORT -->
		
		<?php $hooks->run('css'); ?>
		
    </head>

    <body class="page-sound page-sidebar-fixed page-header-fixed">
	
		
		
		<!-- START @WRAPPER -->
        <section id="wrapper">
			
			<?php $hooks->run('afterBody'); ?>