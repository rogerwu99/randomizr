<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<title>MOO Bantana</title>
	<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8"></META>
    <meta name="viewport" content="user-scalable=no, width=device-width" />
	<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" ></link>
 	
<?php
	$mobile = false;
	$regex_match="/(nokia|iphone|android|motorola|^mot\-|softbank|foma|docomo|kddi|up\.browser|up\.link|";
	$regex_match.="htc|dopod|blazer|netfront|helio|hosin|huawei|novarra|CoolPad|webos|techfaith|palmsource|";
	$regex_match.="blackberry|alcatel|amoi|ktouch|nexian|samsung|^sam\-|s[cg]h|^lge|ericsson|philips|sagem|wellcom|bunjalloo|maui|";
	$regex_match.="symbian|smartphone|midp|wap|phone|windows ce|iemobile|^spice|^bird|^zte\-|longcos|pantech|gionee|^sie\-|portalmmm|";
	$regex_match.="jig\s browser|hiptop|^ucweb|^benq|haier|^lct|opera\s*mobi|opera\*mini|320x320|240x320|176x220";
	$regex_match.=")/i";
	//echo $_SERVER['HTTP_USER_AGENT'];
		if( isset($_SERVER['HTTP_X_WAP_PROFILE']) or isset($_SERVER['HTTP_PROFILE']) or preg_match($regex_match, strtolower($_SERVER['HTTP_USER_AGENT']))){
		$mobile = true;
		//echo 'mobile';  
		Configure::write('mobile',true);

	}
	else {
		$mobile = false;
			Configure::write('mobile',false);

	}
	?>
    <? if (!Configure::read('mobile')): ?>
    <?php echo $scripts_for_layout ?>
	<?php echo $html->css('style-log'); ?>
	<?php echo $html->css('type'); ?>
	
	<?php echo $html->css('reset.css'); ?>
	<?php echo $html->css('text.css'); ?>
	<?php echo $html->css('grid_fluid.css'); ?>
	<?php echo $html->css('layout.css'); ?>
	<?php echo $html->css('nav.css'); ?>
	<?php echo $html->css('table-in-css.css'); ?>
	
	<?php print $html->charset('UTF-8'); ?>
	<?php print $javascript->link('prototype'); ?>
    <?php print $javascript->link('scriptaculous.js?load=effects,slider'); ?>
    <?php print $javascript->link('scripts'); ?>
       

		<!--[if lt IE 8]>
<p>We do not support your current web browser.  Please upgrade to the latest <a href="http://www.microsoft.com/windows/Internet-explorer/default.aspx">Internet Explorer.</a></p>
<![endif]-->
	

	<!--[if IE 6]>
	  <?php echo $html->css('ie6'); ?>
	<![endif]-->
	<!--[if IE 7]>
	  <?php echo $html->css('ie7'); ?>
	<![endif]-->
	<!--[if IE 8]>
	  <?php //echo $html->css('ie7'); ?>
	<![endif]-->
    <? else : ?>
    	<?php echo $scripts_for_layout ?>
		<?php echo $html->css(array('style-log-mobile'),'stylesheet',array('media'=>"only screen and (max-width: 854px)")); ?>
		<?php //echo $html->css('type'); ?>
		<?php //echo $html->css('reset.css'); ?>
		<?php //echo $html->css('text.css'); ?>
		<?php //echo $html->css('grid_fluid.css'); ?>
		<?php echo $html->css(array('layout-mobile.css'),'stylesheet',array('media'=>"only screen and (max-width: 854px)")); ?>
		<?php //echo $html->css('nav.css'); ?>
		<?php echo $html->css(array('table-in-css-mobile.css'),'stylesheet',array('media'=>"only screen and (max-width: 854px)")); ?>
		
		<?php print $html->charset('UTF-8'); ?>
		<?php print $javascript->link('prototype'); ?>
    	<?php print $javascript->link('scriptaculous.js?load=effects,slider'); ?>
       

		<? //echo $javascript->link('http://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js'); ?>
	    <? //echo $javascript->link('http://code.jquery.com/mobile/1.0a4.1/jquery.mobile-1.0a4.1.min.js'); ?>
    	<? //echo $html->css('http://code.jquery.com/mobile/1.0a4.1/jquery.mobile-1.0a4.1.min.css'); ?>
    <? endif; ?>
    <script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-21429562-1']);
  _gaq.push(['_setDomainName', '.bantana.com']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</head>
<body>
	
  
  <div id="bkgrnd">
      <div id="wrapper">
        <div id="maincontent">
          <div id="content">
            <div id="roundedtopwrapper">
              <div id="topleftcorner"></div>
              <div id="topcenterborderwrapper">
                <div id="topcenterborder"></div>
              </div>
           	  <div id="toprightcorner"></div>
            </div>
            <div id="maincontentwrapper">
              <div id="shadowleft"></div>
            	 <div id="contentwrapper">
		       	<div id="contentwrapper"><div id="leftcolumn">
	    	<div class="container_12"><div class="grid_12">
					<div class="nav">
                    <?php if(empty($_Auth['User'])): ?>
					<? if (!Configure::read('mobile')): ?>
				   		 <?php echo $this->element('login-prompt', array('c'=>$this->name, 'a'=>$this->params, 'deny'=>'nope')); ?>
                    </div>
						<?php echo $this->element('logo'); ?>
                    <? else: ?>    
						<?php echo $this->element('logo'); ?>
                    	</div>
						 <?php echo $this->element('login-prompt', array('c'=>$this->name, 'a'=>$this->params, 'deny'=>'nope')); ?>
                    <? endif; ?>
                        
				</div></div>
				<?php echo $content_for_layout; ?>
				<?php else: ?>
            			<?php echo $this->element('login');?>
					</div>
						 <? if (!Configure::read('mobile')): ?>
						<?php echo $this->element('logo'); ?>
                         <? endif; ?>
						
				</div></div>		
	            <?php echo $content_for_layout; ?>
				<?php endif; ?>
			   </div></div> 
			  	</div></div>
		<div id="roundedbottomwrapper">
         <div id="bottomleftcorner"></div>
          <div id="bottomcenterborderwrapper">
            <div id="bottomcenterborderfiller"></div>
            <div id="bottomcenterborder"></div>
          </div>
          <div id="bottomrightcorner"></div>
        </div>
	    <div id="footer">
            			<?php echo $this->element('footer');?>
		
	   </div>
    </div>
</div>
        

</div></div>
	

        
</body>
</html>
