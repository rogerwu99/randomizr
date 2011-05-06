<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml">
<head>

<title>MOO Bantana</title>
	<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8"></META>
	<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" ></link>
 	
	<?php echo $_SERVER['HTTP_USER_AGENT'];?> 
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
		       	<div id="contentwrapper">
                	<div id="leftcolumn">
		    			<div class="container_12">
                        	<div class="grid_12">
                            <div class="nav"></div>
                            	<?php echo $this->element('logo'); ?>
	                            </div>
                        </div>
						<?php echo $content_for_layout; ?>
					</div>
				</div>
               </div>		
	           </div>
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
        

</div>
	

        
</body>
</html>

