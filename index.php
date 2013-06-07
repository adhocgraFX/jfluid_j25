<?php
/**
 * @copyright	© 2011 adhocgraFX Johannes Hock 2011 - All Rights Reserved.
 * @copyright	JFluid responsive template ©
 * @license		GNU/GPL
**/
defined( '_JEXEC' ) or die; 

// variables
$app = JFactory::getApplication();
$doc = JFactory::getDocument(); 
$params = $app->getParams();
$pageclass = $params->get('pageclass_sfx'); // parameter (menu entry)
$tpath = $this->baseurl.'/templates/'.$this->template;

$this->setGenerator(null);

// mobile detect usage von Rene Kreijveld
include_once ('js/Mobile_Detect.php');
$detect = new Mobile_Detect();
$layout = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'mobile') : 'desktop');

// mein css 
$doc->addStyleSheet($tpath.'/css/template.css.php'); 

// load this script
$doc->addScript($tpath.'/js/modernizr-2.6.2.custom.min.js'); // <- Modernisierungen - this script must be in the head

// unset scripts, put them into /js/template.js.php to minify http requests
unset($doc->_scripts[$this->baseurl.'/media/system/js/mootools-core.js']);
unset($doc->_scripts[$this->baseurl.'/media/system/js/mootools-more.js']);
unset($doc->_scripts[$this->baseurl.'/media/system/js/core.js']);
unset($doc->_scripts[$this->baseurl.'/media/system/js/caption.js']);

// get my params
$logo = $this->params->get('logo');
$sitetitle = $this->params->get('sitetitle');
$twitterid = $this->params->get('twitterid');
$googleplus = $this->params->get('googleplus');
$analytics = $this->params->get('analytics');
$anonym = $this->params->get('anonym');
$typesize = $this->params->get('typesize');
$slidethumb = $this->params->get('slidethumb');
$rtl = $this->params->get('rtl');
?>

<?php // a little grid sort stuff
$gridsort = $this->params->get('gridsort'); ?>
<?php if ($this->countModules('left or left_hide or left_tabs or left_slider') and $this->countModules('right or right_hide or right_tabs or right_slider')): ?>
	<?php if ($gridsort == 'lmr'): ?>
	<?php $mainpos = 'width-50 push-25';
	      $leftpos = 'width-25 pull-50';
	      $rightpos = 'width-25'; ?>
	<?php elseif ($gridsort == 'mlr'): ?>
	<?php $mainpos = 'width-50';
	      $leftpos = 'width-25';
	      $rightpos = 'width-25'; ?>
	<?php elseif ($gridsort == 'lrm'): ?>
	<?php $mainpos = 'width-50 push-50';
	      $leftpos = 'width-25 pull-50';
	      $rightpos = 'width-25 pull-50'; ?>
	<?php endif; ?>
<?php elseif ($this->countModules('right or right_hide or right_tabs or right_slider')): ?>
	<?php $mainpos = 'width-66';
	      $rightpos = 'width-33'; ?>
<?php elseif ($this->countModules('left or left_hide or left_tabs or left_slider')): ?>
	<?php $mainpos = 'width-66 push-33';
	      $leftpos = 'width-33 pull-66'; ?>
<?php else : ?>
	<?php $mainpos = 'width-100'; ?>
<?php endif;?>

<!doctype html>

<!-- ...Modernisierungen... -->
<!--[if IEMobile]><html lang="<?php echo $this->language; ?>" class="iemobile"> <![endif]-->
<!--[if lt IE 7 ]> <html lang="<?php echo $this->language; ?>" class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>    <html lang="<?php echo $this->language; ?>" class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>    <html lang="<?php echo $this->language; ?>" class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="<?php echo $this->language; ?>" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html lang="<?php echo $this->language; ?>" class="no-js">
<!--<![endif]-->

<head>
<!-- my scripts -->
<script type="text/javascript" src="<?php echo $tpath.'/js/template.js.php'; ?>"></script>
<jdoc:include type="head" />

<!-- Mobile Specific Metas -->
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta name="HandheldFriendly" content="true" />
<meta name="apple-touch-fullscreen" content="YES" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<?php // meine css optionen
include_once ('css/styles_css.php'); ?>

<!--[if lte IE 7]>
	<link rel="stylesheet" href="<?php echo $tpath; ?>/css/font-awesome-ie7.min.css" />
<![endif]-->

<!-- adaptive 960 CSS grid system von Nathan Smith -->
<?php if ($rtl == 1):?>
<link rel="stylesheet" href="<?php echo $tpath; ?>/css/rtl-layout.css" />
<!-- hier: Geschmackssache, entweder desktop oder mobile first -->
<noscript>
<link rel="stylesheet" href="<?php echo $tpath; ?>/css/rtl-grid-desktop.min.css" />
</noscript>
<script>
var ADAPT_CONFIG = {
  // Where is your CSS?
  path: '<?php echo $tpath; ?>/css/',
  // false = Only run once, when page first loads.
  // true = Change on window resize and page tilt.
  dynamic: true,
  callback: myCallback,
  // First range entry is the minimum.
  // Last range entry is the maximum.
  // Separate ranges by "to" keyword.
  range: [
     '0 to 760 = grid-mobile.min.css',
     '760 = rtl-grid-desktop.min.css'
  ]
};
function myCallback(i) {
  // Replace HTML tag's ID.
  document.documentElement.id = 'range_' + i;
};
</script>
<?php else : ?>
<!-- hier: Geschmackssache, entweder desktop oder mobile first -->
<noscript>
<link rel="stylesheet" href="<?php echo $tpath; ?>/css/grid-desktop.min.css" />
</noscript>
<script>
var ADAPT_CONFIG = {
  // Where is your CSS?
  path: '<?php echo $tpath; ?>/css/',
  // false = Only run once, when page first loads.
  // true = Change on window resize and page tilt.
  dynamic: true,
  callback: myCallback,
  // First range entry is the minimum.
  // Last range entry is the maximum.
  // Separate ranges by "to" keyword.
  range: [
     '0 to 760 = grid-mobile.min.css',
     '760 = grid-desktop.min.css'
  ]
};
function myCallback(i) {
  // Replace HTML tag's ID.
  document.documentElement.id = 'range_' + i;
};
</script>
<?php endif;?>
<script src="<?php echo $tpath; ?>/js/adapt.min.js"></script>

<!-- Favicons -->
<link rel="shortcut icon" href="<?php echo $tpath; ?>/favicon.ico">
<link rel="apple-touch-icon" href="<?php echo $tpath; ?>/images/apple-touch-icon-57x57.png">
<link rel="apple-touch-icon" sizes="72x72" href="<?php echo $tpath; ?>/images/apple-touch-icon-72x72.png">
<link rel="apple-touch-icon" sizes="114x114" href="<?php echo $tpath; ?>/images/apple-touch-icon-114x114.png">
</head>
<body class="<?php echo $pageclass; ?>">
<a id="top-of-page"></a> 

<!--	 äußerer Hauptrahmen	-->
<div id="wrapper"> 
	<!--	 off canvas navi	-->
	<nav id="navmenu">
		<header>
			<p><span class="icon-reorder" ></span>Go to...</p>
		</header>
		<jdoc:include type="modules" name="nav" />
	</nav>
	<!-- innerer Hauptrahmen  -->
	<div class="container" id="main-pad"> 
		<!-- navi + suche  -->
		<div id="toolbarnav">
			<div class="container">
				<?php if ($layout != 'mobile'):?>
				<nav class="width-100 hide-on-mobile" id="nav">
					<jdoc:include type="modules" name="nav" />
				</nav>
				<?php endif; ?>
				<?php if ($layout == 'mobile'):?>
				<div class="mobile-width-20 hide-on-desktop">
					<button class="reorder" id="menu-btn">
					<a href="#navmenu"></a>
					</button>
				</div>
				<?php if ($this->countModules('search')): ?>
				<div class="mobile-width-80 hide-on-desktop clearfix" id="search-pad">
					<jdoc:include type="modules" name="search" style="joomskeleton"/>
				</div>
				<?php endif; ?>
				<?php endif; ?>
			</div>
		</div>
		<!-- logo  -->
		<?php if ($logo): ?>
		<div class=" width-60 mobile-width-100 headerlogo"> <a href="<?php echo $this->baseurl ?>" id="logo" > <img src="<?php echo $this->baseurl ?>/<?php echo htmlspecialchars($logo); ?>"  alt="<?php echo htmlspecialchars($sitetitle); ?>" /> </a> </div>
		<?php else : ?>
		<div class="width-60 mobile-width-100 headerlogo"> <a href="<?php echo $this->baseurl ?>" id="logo" > <IMG src="<?php echo $tpath; ?>/images/logo.png" alt="joomfluid" /> </a> </div>
		<?php endif;?>
		<?php if ($layout != 'mobile'):?>
		<div class="width-40 hide-on-mobile clearfix" id="search-pad2">
			<?php if ($this->countModules('search')): ?>
			<jdoc:include type="modules" name="search" style="joomskeleton"/>
			<?php endif; ?>
			<?php if ($typesize == 1):?>
			<div class="hide-on-mobile clearfix" id="textsizer-embed">
				<ul class="textresizer">
					<li><a href="#nogo" class="small-text" title="Small">Small</a></li>
					<li><a href="#nogo" class="default-text" title="Default">Default</a></li>
					<li><a href="#nogo" class="large-text" title="Large">Large</a></li>
					<li><a href="#nogo" class="larger-text" title="Larger">Larger</a></li>
				</ul>
			</div>
			<?php endif;?>
		</div>
		<?php endif;?>
		<!--[if lte IE 7]>
            <p class="box red2">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/" target="_blank">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true" target="_blank">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->
		<?php if ($layout != 'mobile'):?>
		<!-- breadcrumbs -->
		<?php if ($this->countModules('breadcrumbs')): ?>
		<div class="width-100 hide-on-mobile" id="breadcrumbs-pad">
			<jdoc:include type="modules" name="breadcrumbs" />
		</div>
		<?php endif; ?>
		<!-- slideshow -->
		<?php if ($this->countModules('slideshow')): ?>
		<div class="width-100 hide-on-mobile" id="slideshow-pad">
			<div class="rslides_container">
				<jdoc:include type="modules" name="slideshow" />
			</div>
		</div>
		<?php endif; ?>
		<!-- head1 + head2 + head3 -->
		<?php if ($this->countModules('head1') or $this->countModules('head2') or $this->countModules('head3')): ?>
		<section class="width-100 medium">
			<?php if ($this->countModules('head1')): ?>
			<div class="width-100" id="equal1" >
				<jdoc:include type="modules" name="head1" style="joomskeleton" />
			</div>
			<?php endif; ?>
			<?php if ($this->countModules('head2')): ?>
			<div class="width-100" id="equal2" >
				<jdoc:include type="modules" name="head2" style="joomskeleton" />
			</div>
			<?php endif; ?>
			<?php if ($this->countModules('head3')): ?>
			<div class="width-100" id="equal3" >
				<jdoc:include type="modules" name="head3" style="joomskeleton" />
			</div>
			<?php endif; ?>
		</section>
		<?php endif; ?>
		<?php endif; ?>
		<!-- 3 bzw 2 columns with left + content + right / + message above content -->
		<section class="width-100" >
		<section class="<?php echo htmlspecialchars($mainpos); ?>" id="main" >
			<jdoc:include type="modules" name="head_tabs" style="beezTabs" headerLevel="2"  id="5" />
			<jdoc:include type="message" />
			<jdoc:include type="component" />
			<jdoc:include type="modules" name="bottom_tabs" style="beezTabs" headerLevel="2"  id="6" />
		</section>
		<?php if ($this->countModules('left or left_hide or left_tabs or left_slider')): ?>
		<aside class="<?php echo htmlspecialchars($leftpos); ?>" id="left" >
			<jdoc:include type="modules" name="left_hide" style="beezHide" headerLevel="4" state="0"  />
			<jdoc:include type="modules" name="left" style="joomskeleton" />
			<jdoc:include type="modules" name="left_tabs" style="beezTabs" headerLevel="2"  id="3" />
			<jdoc:include type="modules" name="left_slider" style="slider" />
		</aside>
		<?php endif; ?>
		<?php if ($this->countModules('right or right_hide or right_tabs or right_slider')): ?>
		<aside class="<?php echo htmlspecialchars($rightpos); ?>" id="right" >
			<jdoc:include type="modules" name="right_hide" style="beezHide" headerLevel="4" state="0"  />
			<jdoc:include type="modules" name="right" style="joomskeleton"  />
			<jdoc:include type="modules" name="right_tabs" style="beezTabs" headerLevel="2"  id="4" />
			<jdoc:include type="modules" name="right_slider" style="slider" />
		</aside>
		<?php endif; ?>
		</section>
		<!-- head1 + head2 + head3  content first in mobile mode -->
		<?php if ($layout == 'mobile'):?>
		<?php if ($this->countModules('head1') or $this->countModules('head2') or $this->countModules('head3')): ?>
		<section class="width-100 small" >
			<?php if ($this->countModules('head1')): ?>
			<div class="width-100">
				<jdoc:include type="modules" name="head1" style="joomskeleton" />
			</div>
			<?php endif; ?>
			<?php if ($this->countModules('head2')): ?>
			<div class="width-100">
				<jdoc:include type="modules" name="head2" style="joomskeleton" />
			</div>
			<?php endif; ?>
			<?php if ($this->countModules('head3')): ?>
			<div class="width-100">
				<jdoc:include type="modules" name="head3" style="joomskeleton" />
			</div>
			<?php endif; ?>
		</section>
		<?php endif; ?>
		<!-- bottom1 + bottom2 + bottom3 in mobile mode  -->
		<?php if ($this->countModules('bottom1') or $this->countModules('bottom2') or $this->countModules('bottom3')): ?>
		<section class="width-100 small" >
			<?php if ($this->countModules('bottom1')): ?>
			<div class="width-100" >
				<jdoc:include type="modules" name="bottom1" style="joomskeleton" />
			</div>
			<?php endif; ?>
			<?php if ($this->countModules('bottom2')): ?>
			<div class="width-100" >
				<jdoc:include type="modules" name="bottom2" style="joomskeleton" />
			</div>
			<?php endif; ?>
			<?php if ($this->countModules('bottom3')): ?>
			<div class="width-100" >
				<jdoc:include type="modules" name="bottom3" style="joomskeleton" />
			</div>
			<?php endif; ?>
		</section>
		<?php endif; ?>
		<?php endif; ?>
		<!-- bottom1 + bottom2 + bottom3 -->
		<?php if ($layout != 'mobile'):?>
		<?php if ($this->countModules('bottom1') or $this->countModules('bottom2') or $this->countModules('bottom3')): ?>
		<div class="width-100 medium" >
			<?php if ($this->countModules('bottom1')): ?>
			<div class="width-100" id="equal4" >
				<jdoc:include type="modules" name="bottom1" style="joomskeleton" />
			</div>
			<?php endif; ?>
			<?php if ($this->countModules('bottom2')): ?>
			<div class="width-100" id="equal5" >
				<jdoc:include type="modules" name="bottom2" style="joomskeleton" />
			</div>
			<?php endif; ?>
			<?php if ($this->countModules('bottom3')): ?>
			<div class="width-100" id="equal6" >
				<jdoc:include type="modules" name="bottom3" style="joomskeleton" />
			</div>
			<?php endif; ?>
		</div>
		<?php endif; ?>
		<?php endif; ?>
		<!-- footer + copy + social buttons -->
		<?php if ($this->countModules('nav_bottom')): ?>
		<menu class="width-100" id="nav-bottom">
			<jdoc:include type="modules" name="nav_bottom" />
		</menu>
		<?php endif; ?>
		<?php if ($this->countModules('footer')): ?>
		<footer class="width-50" id="footer-pad">
			<jdoc:include type="modules" name="footer" style="joomskeleton" />
		</footer>
		<?php endif; ?>
		<?php if ($twitterid or $googleplus == 1): ?>
		<div class="width-50" id="buttons-pad">
			<?php if ($twitterid): ?>
			<a href="https://twitter.com/share" class="twitter-share-button" data-via="<?php echo htmlspecialchars($twitterid);?>" data-size="large" data-hashtags="JoomSkeleton">Tweet</a> 
			<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
			<?php endif; ?>
			<?php if ($googleplus == 1): ?>
			<!-- Google +1-Schaltfläche -->
			<g:plusone></g:plusone>
			<?php endif; ?>
		</div>
		<?php endif; ?>
		<!-- delete me - if you don't like me :(	-->
		<div class="width-100" id="copy-pad"> <a href="http://www.adhocgrafx.de" target="_blank">adhocgraFX &copy; Johannes Hock 2011 all rights reserved</a> </div>
		<!--	:(	-->
		<div class="width-100" id="gototop-pad">
			<ul class="mynav">
				<li><a href="#top-of-page">Top</a></li>
			</ul>
		</div>
	</div>
	<!--	 main pad	--> 
</div>
<!--	 wrapper	--> 
<!-- debug -->
<jdoc:include type="modules" name="debug" />
<script type="text/javascript">
<!-- smooth scroll -->
	$(document).ready(function() {
		$('ul.mynav a').smoothScroll({
			speed: 600
		});
	});
  
<!-- BEEZ Tabs - Ideen und WAI ARIA von Angie Radtke --> 
	var altopen='<?php echo JText::_('TPL_BEEZ5_ALTOPEN', true); ?>';
      var altclose='<?php echo JText::_('TPL_BEEZ5_ALTCLOSE', true); ?>';
	var bildauf='<?php echo $tpath; ?>/images/plus.png';
      var bildzu='<?php echo $tpath; ?>/images/minus.png';

<!-- google analytics id -->
<?php if ($analytics != "UA-XXXXX-X"): ?>
	var _gaq=[['_setAccount','<?php echo htmlspecialchars($analytics); ?>'],['_trackPageview']]; 
	<?php if ($anonym == 1):?>
		_gaq.push (['_gat._anonymizeIp']);
	<?php endif; ?>
	(function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';s.parentNode.insertBefore(g,s)}(document,'script'));
<?php endif; ?>

<!-- google Render-Anweisung --> 
<?php if ($googleplus == 1): ?> 
  (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/plusone.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();
<?php endif; ?>

<?php if ($layout == 'mobile'):?>
<!-- menü in select klonen --> 
	// DOM ready
	 $(function() {
	// Create the dropdown base
      $("<select />").appendTo("menu");
      // Create default option "Go to..."
      $("<option />", {
         "selected": "selected",
         "value"   : "",
         "text"    : "Go to..."
      }).appendTo("menu select");
      // Populate dropdown with menu items
      $("menu a").each(function() {
       var el = $(this);
       $("<option />", {
           "value"   : el.attr("href"),
           "text"    : el.text()
       }).appendTo("menu select");
      });
       // To make dropdown actually work
	 $("menu select").change(function() {
        window.location = $(this).find("option:selected").val();
      });
	 });
<?php endif; ?>
<?php if ($layout != 'mobile'):?>
<!-- für gleiche modulhöhen - nun mit window load --> 
$(window).load(function(){
  $('#equal1 > div').syncHeight();
  $(window).resize(function(){ 
    $('#equal1 > div').syncHeight();
  });
  $('#equal2 > div').syncHeight();
  $(window).resize(function(){ 
    $('#equal2 > div').syncHeight();
  });
   $('#equal3 > div').syncHeight();
  $(window).resize(function(){ 
    $('#equal3 > div').syncHeight();
  });
  $('#equal4 > div').syncHeight();
  $(window).resize(function(){ 
    $('#equal4 > div').syncHeight();
  });
  $('#equal5 > div').syncHeight();
  $(window).resize(function(){ 
    $('#equal5 > div').syncHeight();
  });
   $('#equal6 > div').syncHeight();
  $(window).resize(function(){ 
    $('#equal6 > div').syncHeight();
  });
});

<!-- neu eingebaut: responsive slideshow von viljamis -->
<?php if ($this->countModules('slideshow')): ?>
    $(window).load(function() {
	$("#slider").responsiveSlides({
         <?php if ($slidethumb == 1):?>
	  	auto: true,
        	//pager: true,
        	manualControls: '#slider-pager',
	  	//nav: true,
        	speed: 1000,
	  	//namespace: "centered-btns"
        <?php else : ?>
	  	auto: true,
        	pager: true,
        	//manualControls: '#slider-pager',
	  	nav: true,
        	speed: 1000,
	  	namespace: "centered-btns"
	  <?php endif; ?>
       });
   });
<?php endif; ?>

<!-- text resizer --> 
<?php if ($typesize == 1):?>
	jQuery(document).ready( function() {
		jQuery( "#textsizer-embed a" ).textresizer({
		target: "#main",
		type: "css",
		sizes: [
			// Small. Index 0
			{ "font-size" : "87.5%",			  
			},
 			// Medium. Index 1
			{ "font-size" : "100%",			  
			},
 			// Large. Index 2
			{ "font-size" : "112.5%",			  
			},
 			// Larger. Index 3
			{ "font-size" : "125%",	 
			}
		],
		selectedIndex: 1
		});
	});
<?php endif; ?>
<?php endif; ?>

<!-- footable responsive tables --> 
  $(window).load(function() {
    $('.footable').footable();  	
  });
</script>
</body>
</html>