<?php
	//echo header("HTTP/1.0 404 Not Found");
	echo header("HTTP/1.0 410 Gone");
?>


<!DOCTYPE html>
<html lang="it">

  <head>
    <?php echo $this->Html->charset(); ?>
    <title><?php __('skf actuator selector'); ?> <?php echo $title_for_layout; ?></title>

<!-- TODO: verificare -->
	<meta name="google-site-verification" content="xxxxxx" />
<!-- TODO: verificare -->

	<meta name="owner" content="<?php __('skf actuator selector'); ?>" />
	<meta name="copyright" content="&copy;2012 - <?php __('skf actuator selector'); ?>" />
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

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

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


<!-- TODO: verificare -->
<script type="text/javascript">
// <![CDATA[

// TODO: verificare codice account
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-11459707-3']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

// ]]>
</script>
<!-- TODO: verificare -->

  </head>

  <body>

<?php echo $this->element('public/_navbar'); ?>

<?php echo $this->element('public/_subhead'); ?>

	<div class="container">

	<?php
	//TODO: verificare in quale view serve ...
	//echo $this->Session->flash();
	?>

	<?php echo $content_for_layout; ?>

	</div>

<?php echo $this->element('public/_footer'); ?>


<div class="clear-both"></div>

<?php echo $this->element('sql_dump'); ?>

  </body>
</html>