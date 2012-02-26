<?php require 'required/template-top.php'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

<title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>

<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<?php if ( is_home()) { require_once('js/rotate-script.php'); ?>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>

<!-- for shadowbox -->
<link rel="stylesheet" type="text/css" href="<?php bloginfo( 'template_directory' ); ?>/js/shadowbox2/shadowbox.css">
<script type="text/javascript" src="<?php bloginfo( 'template_directory' ); ?>/js/shadowbox2/shadowbox.js"></script>
<script type="text/javascript">
Shadowbox.init({
    counterType:     "skip",
    continuous:         true,
    handleOversize:  "resize",
	initialHeight:	"200",
	initialWidth:	"400",
	overlayOpacity:	"0.95"
});
</script>

<?php } ?>

<?php if(is_page('get-involved')) { ?>
<!--
  <link rel="stylesheet" type="text/css" href="<?php bloginfo( 'template_directory' ); ?>/js/jquery-ui-1.8.6.custom.css"/>
-->
  <link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/ui-lightness/jquery-ui.css"/>
  <style type="text/css">
    #slider {
      margin: 10px;
      width: 600px;
    }
    #impact {
      width: 800px;
    }
  </style>

  <script type="text/javascript" src="/wp-includes/js/jquery/jquery.js?ver=1.4.2"></script>
  <script type="text/javascript" src="<?php bloginfo( 'template_directory' ); ?>/js/jquery-ui-1.8.6.custom.min.js"></script>
  <script type="text/javascript" src="<?php bloginfo( 'template_directory' ); ?>/js/jshashtable-2.1.js"></script>
  <script type="text/javascript" src="<?php bloginfo( 'template_directory' ); ?>/js/jquery.numberformatter-1.2.1.min.js"></script>
  <script type="text/javascript" src="<?php bloginfo( 'template_directory' ); ?>/js/get-involved.js"></script>
  <script type="text/javascript">
      var jq = jQuery.noConflict();
      jq(document).ready(function() {
          var initialDonation = 25;
          // add and initialize the slider
          jq("#slider").slider({
              value: valueToPercent(initialDonation),
              min: 0,
              max: 100,
              step: 1,
              slide: function(event, ui) {
                  var amt = percentToValue(ui.value);
                  updateAmountText(amt);
              },
              change: function(event, ui) {
                  var amt = percentToValue(ui.value);
                  updatePayPal(amt);
                  flashImpact(amt);
              }
          });

          // add scale to slider
          jq("#donation_amounts").html(generateScale());

          // update donation amount when user clicks on links for specific dollar amounts
          jq(".amount").click(function(event) {
              var amt = jq(event.target).parseNumber({format: "#,###", locale: "us"}, false);
              updateAmountText(amt);
              updatePayPal(amt);
              moveSlider(amt);
              flashImpact(amt);
          });

          // format manually entered amounts and sync slider
          jq("#amount").on("blur", function() {
              var amt = jq(this).parseNumber({format: "#,###", locale: "us"}, false);
              updateAmountText(amt);
              updatePayPal(amt);
              moveSlider(amt);
              flashImpact(amt);
          });

          // initialize amount text field and impact statement
          updateAmountText(initialDonation);
          flashImpact(initialDonation);
      });
  </script>
<?php } ?>



<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>

<?php wp_head(); ?>
</head>




<body <?php body_class($heli_site_color); echo $color_css;?>>

<div id="top-bar"></div>

<div id="container">

    <div id="holder">
    
		<div id="header">
			<ul id="nav-main">
				<li <?php if(is_front_page()) echo'class="current_page_item"'; ?>> <a href="<?php bloginfo('url'); ?>">Home</a> </li>
                <li <?php if(is_page('about')) echo'class="current_page_item"'; ?>> <a href="<?php bloginfo('url'); ?>/about">About</a> </li>   
                  <li <?php if(is_page('events')) echo'class="current_page_item"'; ?>> <a href="<?php bloginfo('url'); ?>/events">Events</a> </li>      
                
                
                <li <?php if(is_page('get-involved')) echo'class="current_page_item"'; ?>> <a href="<?php bloginfo('url'); ?>/get-involved">Get Involved / Give</a> </li>  
                
                <li <?php if(is_page('products-page')) echo'class="current_page_item"'; ?>> <a href="<?php bloginfo('url'); ?>/products-page">Our Shop</a> </li>   
                
                <li <?php if(is_page('sponsors')) echo'class="current_page_item"'; ?>> <a href="<?php bloginfo('url'); ?>/sponsors">Sponsors</a> </li> 
                
                 <li <?php if(is_page('theblog')) echo'class="current_page_item"'; ?>> <a href="<?php bloginfo('url'); ?>/drill4water2012/"><img src="http://nuafrica.org/wp-content/themes/heliumified/images/Drill4Water.png" width="103" height="30" alt="Drill4Water" border="2"></a> </li>    
                 
                   <li <?php if(is_page('contact')) echo'class="current_page_item"'; ?>> <a href="<?php bloginfo('url'); ?>/contact">Contact</a> </li>               
				
			</ul>
			<h1><a href="<?php echo get_option('home'); ?>/"><img src="<?php bloginfo('template_directory'); ?>/images/nuafrica-logo.png" width="267" height="65" alt="<?php bloginfo('name'); ?>" /></a></h1>
		</div>
		
		<div id="content-box">
        
