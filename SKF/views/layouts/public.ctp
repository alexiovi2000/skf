<!DOCTYPE html>
<html lang="it">

  <head>
    <?php echo $this->Html->charset(); ?>
    <title><?php __('skf actuator selector'); ?> <?php echo $title_for_layout; ?></title>

<?php /* ?>
<!-- TODO: verificare -->
	<meta name="google-site-verification" content="xxxxxx" />
<!-- TODO: verificare -->
<?php */ ?>

	<meta name="owner" content="<?php __('skf actuator selector'); ?>" />
	<meta name="copyright" content="&copy;2013 - <?php __('skf actuator selector'); ?>" />
	<meta name="language" content="it" />
	<meta name="robots" content="index,follow" />
	<meta name="revisit-after" content="10 days" />

	<meta name="description" content="<?php echo strip_tags ( html_entity_decode($description_for_layout, ENT_QUOTES, 'UTF-8') ); ?>" />
	<meta name="keywords" content="<?php echo strip_tags ( html_entity_decode($keywords_for_layout, ENT_QUOTES, 'UTF-8') ); ?>" />

<?php /* ?>
<link rel="image_src" href="<?php
$img_tmp_url = '/img/layout/col-center/provera_avatar.jpg';
$initiative_image = SITE_WEBROOT_URL . 'image.php' . '?width=150&height=80&quality=' . IMAGE_RESIZE_QUALITY . '&image=' . $img_tmp_url;
echo $initiative_image;
?>" />
<?php */ ?>

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

<?php
//jquery
    echo $this->Html->script('jquery-1.8.2.min') . "\n";
//jquery ui
    echo $this->Html->script('jquery.jquery-ui/jquery-ui-1.10.3.custom.min') . "\n";

//bootstrap
/*
    echo $this->Html->script('bootstrap') . "\n";

	echo $this->Html->css('bootstrap') . "\n";
	echo $this->Html->css('bootstrap.add') . "\n";
	echo $this->Html->css('bootstrap.my-responsive') . "\n";
*/
//jalert
	echo $this->Html->css('/js/jalert/jalert.css') . "\n";
	echo $this->Html->script('jalert/jquery.jalert.js') . "\n";

//polyglot.language.switcher
	echo $this->Html->css('polyglot-language-switcher') . "\n";
	echo $this->Html->script('jquery.polyglot.language.switcher') . "\n";


//css
	echo $this->Html->css('public') . "\n";
//css jquery ui
	echo $this->Html->css('/js/jquery.jquery-ui/jquery-ui-1.10.3.custom.min') . "\n";

//script slimbox
    echo $this->Html->script('/js/slimbox/js/slimbox2.js') . "\n";
//css slimbox
    echo $this->Html->css('/js/slimbox/css/slimbox2.css') . "\n";

?>

    <!--  HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- fav and touch icons -->
<!--
    <link rel="shortcut icon" href="ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="ico/apple-touch-icon-57-precomposed.png">
-->

<?php /* ?>
<link rel="stylesheet" href="http://www.google.com/cse/style/look/default.css" type="text/css" />

<script type="text/javascript" src="https://apis.google.com/js/plusone.js">
  {lang: 'it'}
</script>

<script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
<?php */ ?>

<?php echo $scripts_for_layout; ?>

    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-40787907-1', 'mechatronics-training.com');
      ga('send', 'pageview');

    </script>
    
    <script type="text/javascript">
	/* Opens a popup window */
	function openPopupWindow(url,windowname,properties) {
		if (properties.length == 0) {
			properties = 'toolbar=no,scrollbars=no,menubar=no,statusbar=no,width=600,height=600,resizable=0,left=100,top=100,screenX=100,screenY=100';
		}
		popupWindow = window.open(url,windowname,properties);
	}
	</script>

  </head>

  <body>
  
  
  
  

<?php ////////////////////////////////////////////////////////////HEADER LAYOUT SKF ?>
<div id="header">
	<div id="top-navigation">
    	<ul>
			<li class="home"><a href="index.php"><span>&nbsp;&nbsp;&nbsp;&nbsp;Home</span></a></li></ul>
	</div>
	<div id="site-header">
		<ul class="clearfix">
			<li id="logo"><a href="http://www.skf.com" target="_blank">SKF logo</a></li>
			<li id="current-site"><?php echo __('title application home', true); ?></li>
		</ul>
	</div>
	<div id="search-header">
		
	</div>
</div>
<?php ///////////////////////////////////////////////////////////////////////////// ?>   



 

<?php echo $this->element('public/spinner'); ?>
<?php
//if (!empty($user_logged)) {
?>
<?php echo $this->element('public/_navbar'); ?>
<?php
//}
?>
<?php echo $this->element('public/_subhead'); ?>
<div class="clearfix" id="main">
	<div class="maincontent">
        <div class="content">

	<?php
	//TODO: verificare in quale view serve ...
	echo $this->Session->flash();
//	echo $this->Session->flash('auth');
	?>

	<?php echo $content_for_layout; ?>
        </div>
	</div>
</div>
<?php //echo $this->element('public/_footer'); ?>

    <div id="disclaimer"><?php __('The content of this selection tool is a compilation of information published by SKF Actuation System. Every care has been taken to ensure the accuracy of the compilation, but no liability can be accepted for any loss or damage whether direct, indirect or consequential arising out of the use of information contained herein.'); ?></div>

<div class="clear-both"></div>

<?php echo $this->element('sql_dump'); ?>




<?php ////////////////////////////////////////////////////////////FOOTER LAYOUT SKF ?>
<div id="footer">
	<div id="page-footer">		 
	</div>
	<div id="legal-footer">
		<ul class="links">	 
			<li><div class="link"><span>&copy; Copyright <?php echo $html -> image('/img/skf_layout/logo_footer.jpg', array());?> </span></div></li>
			<li><a class="link" href="javascript:openPopupWindow('http://www.skf.com/termsandconditions','','width=600,height=600,resizable=0,scrollbars=no')"><span>Terms &amp; Conditions</span></a></li>
			<li><a class="link" href="javascript:openPopupWindow('http://www.skf.com/privacy','','width=600,height=600,resizable=0,scrollbars=no')"><span>Privacy Policy</span></a></li>
			<li><a class="link" href="javascript:openPopupWindow('http://www.skf.com/ownership','','width=600,height=600,resizable=0,scrollbars=no')"><span>Site Ownership</span></a></li>				
			<li><a class="link" href="javascript:openPopupWindow('http://www.skf.com/cookies','','width=600,height=600,resizable=0,scrollbars=no')"><span>cookies</span></a></li>
			<li class="last"><a class="link" href="javascript:openPopupWindow('http://www.skf.com','','width=960,height=900,resizable=1,toolbar=no,scrollbars=yes,menubar=no,statusbar=no')"><span>www.skf.com</span></a></li>
		</ul>
	</div>
</div>
<?php ///////////////////////////////////////////////////////////////////////////// ?> 


  </body>
</html>