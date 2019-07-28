<div class="col" id="home_screen" style="background-color: #ffffff !important;">
	<?php
	$blogContent = getCustomizerPage('home');
	if (!empty($blogContent['blog_content'])) {
	    echo $blogContent['blog_content'];
	} else {
    	?>
        <fieldset id="welcome_msg">
	        <ul class="infobox">
	        	<li>
					<h1 style="text-align: center;margin-bottom: 30px;font-size: 19px;">Welcome to Spark – A unified platform to handle all your on-page SEO needs</h1>
					<p>Our in-house accelerators help in tackling subscription and licensing costs, reducing efforts and have everything on our own servers. With Spark, you can manage all your on-page SEO needs on a unified platform. For a complimentary demo please contact us at <a href="mailto:DigitalMarketingBD@cognizant.com">DigitalMarketingBD@cognizant.com.</a></p>
	        	</li>
	        </ul>
        </fieldset>
        
        <?php 
        echo str_replace( array('<?'.'=SP_PLUGINSITE?>', '<?'.'=SP_INSTALLED?>'), array(SP_PLUGINSITE, ""), $spTextHome['home_cont2']);
        ?>
        
        <?php 
        $search = array(
			'<?'.'=SP_DOWNLOAD_LINK?>', '<?'.'=SP_DEMO_LINK?>', '<?'.'=SP_CONTACT_LINK?>', 
			'<?'.'=SP_HELP_LINK?>', '<?'.'=SP_FORUM_LINK?>', '<?'.'=SP_SUPPORT_LINK?>', '<?'.'=SP_DONATE_LINK?>', '<?'.'=SP_HOSTED_LINK?>'
		);
        $replace = array(SP_DOWNLOAD_LINK,SP_DEMO_LINK,SP_CONTACT_LINK,SP_HELP_LINK,SP_FORUM_LINK,SP_SUPPORT_LINK,SP_DONATE_LINK,SP_HOSTED_LINK);
        echo str_replace( $search, $replace, $spTextHome['home_cont3']);
    }?>
</div>
