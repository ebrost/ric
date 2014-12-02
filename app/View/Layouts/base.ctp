<!DOCTYPE html>
<html lang="fr">
<head>
<title><?php echo $title_for_layout?></title>
<link rel="shortcut icon" href="ico/favicon.ico" type="image/x-icon">
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="ico/apple-touch-icon-144-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="ico/apple-touch-icon-114-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="ico/apple-touch-icon-72-precomposed.png">
<link rel="apple-touch-icon-precomposed" href="ico/apple-touch-icon-57-precomposed.png">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<?php echo $this->fetch('meta'); ?>

    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
            <script>window.jQuery || document.write('<script src="<?php echo $this->Html->url('/js/jquery.js',true); ?>"><\/script>')</script>

<?php
echo $this->Html->css('bootstrap.min');
echo $this->Html->css('font-awesome.min');
echo $this->Html->css('custom-theme/jquery-ui-1.10.0.custom');
echo $this->Html->css('global');
echo $this->fetch('css');

?>
<script type="text/javascript">
jsRoot= "<?php echo $this->Html->url('/',true); ?>";
jsBase= jsRoot + '<?php echo strtolower($this->plugin); ?>';
</script>
</head>
<body>
 <!--[if lt IE 7]>
            <p class="chromeframe">Votre navigateur est hors d'âge ! <a href="http://browsehappy.com/">Mettez le à jour </a> ou <a href="http://www.google.com/chromeframe/?redirect=true">installez Google Chrome Frame</a> pour profiter de ce site.</p>
        <![endif]-->
<div id="wrap">
 <header>
        <div class="navbar navbar-inverse navbar-fixed-top">

        <div class="container-liquid">
            <div class="navbar-header">

            <?php echo $this->Html->link($title_for_layout,array('plugin' => strtolower($this->plugin),'action' => 'index'),array('class'=>'navbar-brand')); ?>
            </div>
        </div>

        </div>
</header>	
    <div class="container-liquid">
	<noscript>
		
		Javascript est désactivé ! De nombreuses fonctionnalités ne fonctionneront pas !
		
	</noscript>
    <!-- Here's where I want my views to be displayed -->
    <div id="flash"><?php echo $this->Session->flash(); ?></div>
    <?php echo $this->Session->flash('auth'); ?>
    <?php echo $this->fetch('content'); ?>
    </div>
<!-- Add a footer to each displayed page -->
<footer id="footer">...</footer>



</div>

  
<?php echo $this->Html->script('bootstrap.min');?>
<?php echo $this->Html->script('jquery-ui-1.10.0.custom.min'); ?>
<?php echo $this->fetch('script'); ?>
<?php echo $this->Html->script('ricUtils');?>

</body>
</html>