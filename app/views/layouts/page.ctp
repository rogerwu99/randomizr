<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml">
<head>
<script type="text/javascript" src="http://static.ak.connect.facebook.com/js/api_lib/v0.4/FeatureLoader.js.php"></script>
<script type="text/javascript">FB.init("76b016269ec6898e763789fe9228f307","/xd_receiver.htm");</script>

	<title>Moo Crunch</title>
	<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8"></META>
	<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" ></link>

	<?php echo $scripts_for_layout ?>
	<?php //echo $html->css('main'); ?>
	<?php //echo $html->css('menu'); ?>
	<?php echo $html->css('style'); ?>
	<?php echo $html->css('type'); ?>
	<!--[if IE 6]>
	  <?php echo $html->css('ie6'); ?>
	<![endif]-->
	<!--[if IE 7]>
	  <?php echo $html->css('ie7'); ?>
	<![endif]-->
	<!--[if IE 8]>
	  <?php echo $html->css('ie7'); ?>
	<![endif]-->
</head>
<body onload="MM_preloadImages('img/klickable_create_your_video_over.jpg','img/klickable_publish_over.jpg','img/klickable_make_money_over.jpg')">
	   <div id="bkgrnd">
      <div id="wrapper">
        <div id="maincontent">
          <div id="content">
            <div id="roundedtopwrapper">
              <div id="topleftcorner"></div>
              <div id="topcenterborderwrapper">
                <div id="topcenterborder">
                </div>
              </div>
             <div id="toprightcorner"></div>
            </div>
            <div id="maincontentwrapper">
              <div id="shadowleft"></div>
              <div id="contentwrapper">
                        <?php if(!empty($_Auth['User'])): ?>

              <div id="contentwrapper">
                <div id="leftcolumn">
			<?php echo $content_for_layout; ?>
                <div id="middlecolumn">
					<?php echo $this->element('shorten',array('c'=>$this->name, 'a'=>$this->action, 'deny'=>'')); ?>
				</div>
				</div>
				
                <div id="rightcolumn">
                         <?php echo $this->element('beta_r_col', array('c'=>$this->name, 'a'=>$this->action, 'deny'=>'')); ?>
                </div>
	</div>

                        <?php else: ?>

              <div id="contentwrapper">
                <div id="leftcolumn">
                        <?php echo $content_for_layout; ?>
	                <div id="middlecolumn">
					<?php echo $this->element('share_url',array('c'=>$this->name, 'a'=>$this->action, 'deny'=>'')); ?>
				</div>
						
                </div>
                <div id="rightcolumn">
                         <?php //echo $this->element('beta_r_col', array('c'=>$this->name, 'a'=>$this->action, 'deny'=>'nope')); ?>
                </div>
        </div>

                        <?php endif; ?>

              </div>
         <!--     <div id="shadowright"></div>
           --> </div>
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
		<?php echo $this->element('footer'); ?>
        </div>
      </div>
    </div>


</div></div>
<?/*
xy
	<div id="frame">
		<?php //if($session->check('Message.flash')){$session->flash();} ?>

		
		<div id="mid_col">
			<?php if($_Auth['Access']['Beta']==1): ?>
				<?php echo $html->link('<div id="logo" class="float_left"></div>', array('controller'=>'beta'), array(), false, false); ?>
			<?php else: ?>
			    <?php echo $html->link('<div id="logo" class="float_left"></div>', '/', array(), false, false); ?>
			<?php endif; ?>
		    <div id="content">
		    	<?php //echo $content_for_layout; ?>
			</div>
		</div>
		<div id="r_col">
			<?php if($_Auth['Access']['Beta']==1): ?>
					<div id="login">
						<?php echo $this->element('login'); ?>
					</div>
					
					<div id="beta_r_col">
					    <?php echo $this->element('beta_r_col', array('c'=>$this->name, 'a'=>$this->action)); ?>
					</div>
			<?php else: ?>    
				<div id="forms">
					<div id="login">
						<?php echo $this->element('login'); ?>
					</div>
					<div id="join">
					    <?php echo $this->element('join'); ?>
					</div>
				</div>
				<div id="www">
					<?php echo $this->element('www'); ?>
				</div>
				
					<?php echo $this->element('checkusout'); ?>
			<?php endif; ?>
		</div>
		
		<div class="clear"></div>
		<div id="footer">
			<?php //echo $this->element('footer'); ?>
		</div>
	</div>
-->
<?*/?>	
	<script type="text/javascript">
		var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
		document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
		</script>
		<script type="text/javascript">
		var pageTracker = _gat._getTracker("UA-1271462-7");
		pageTracker._trackPageview();
	</script>

        <?php echo $javascript->link('MM_Swap.js'); ?>
        <?php echo $javascript->link('jquery-1.2.6.min.js'); ?>
        <?php //echo $javascript->link('form.js'); ?>
        <?php echo $javascript->link('hint.js'); ?>
        <?php echo $javascript->link('ready.js'); ?>
        <?php //echo $javascript->link('corner.js'); ?>
        <?php //echo $javascript->link('jquery.selectbox.js'); ?>
        <?php //echo $javascript->link('tiny_mce/tiny_mce.js'); ?>
        <script type="text/javascript">
        $(document).ready(function()
        {
          //hide the all of the element with class msg_body
          $(".msg_body").hide();
          //toggle the componenet with class msg_body
          $(".msg_head").click(function()
          {
            $(this).next(".msg_body").slideToggle(100);
          });
        });
        </script>

</body>
</html>
