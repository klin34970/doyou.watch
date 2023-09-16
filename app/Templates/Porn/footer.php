<?php 

use Helpers\Hooks;

//initialise hooks
$hooks = Hooks::get(); 

?>
	   <?php $hooks->run('footer'); ?>
	   
				<!-- Start footer content -->
				<footer class="footer-content">
				</footer><!-- /.footer-content -->
			
			<!--/ End footer content -->
			 </section><!-- /#page-content -->
			<!--/ END PAGE CONTENT -->
			
	   </section><!-- /#wrapper -->
        <!--/ END WRAPPER -->

        <!-- START @BACK TOP -->
        <div id="back-top" class="animated pulse circle">
            <i class="fa fa-angle-up"></i>
        </div><!-- /#back-top -->
        <!--/ END BACK TOP -->

        <!-- START JAVASCRIPT SECTION (Load javascripts at bottom to reduce load time) -->
        <!-- START @CORE PLUGINS -->
		
        <script src="<?=Url::templatePath();?>global/plugins/bower_components/jquery/dist/jquery.min.js"></script>
        <script src="<?=Url::templatePath();?>global/plugins/bower_components/jquery-cookie/jquery.cookie.js"></script>
        <script src="<?=Url::templatePath();?>global/plugins/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="<?=Url::templatePath();?>global/plugins/bower_components/typehead.js/dist/handlebars.js"></script>
        <script src="<?=Url::templatePath();?>global/plugins/bower_components/typehead.js/dist/typeahead.bundle.min.js"></script>
        <script src="<?=Url::templatePath();?>global/plugins/bower_components/jquery-nicescroll/jquery.nicescroll.min.js"></script>
        <script src="<?=Url::templatePath();?>global/plugins/bower_components/jquery.sparkline.min/index.js"></script>
        <script src="<?=Url::templatePath();?>global/plugins/bower_components/jquery-easing-original/jquery.easing.1.3.min.js"></script>
        <script src="<?=Url::templatePath();?>global/plugins/bower_components/ionsound/js/ion.sound.min.js"></script>
        <script src="<?=Url::templatePath();?>global/plugins/bower_components/bootbox/bootbox.js"></script>
		<script src="<?=Url::templatePath();?>global/plugins/bower_components/retina.js/dist/retina.min.js"></script>
        <!--/ END CORE PLUGINS -->

        <!-- START @PAGE LEVEL SCRIPTS -->
        <script src="<?=Url::templatePath();?>admin/js/apps.js"></script>
        <script src="<?=Url::templatePath();?>admin/js/demo.js"></script>
		<script src="<?=Url::templatePath();?>admin/js/porn.js"></script>
		
		
		<?php $hooks->run('js'); ?>
		
		<?php if(isset($user->username)) : ?>
			<script>
				$(function() 
				{
					activityUser("<?php echo $user->id; ?>");
				});
			</script>
		<?php endif; ?>
		
		
		<script>
		  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

		  ga('create', 'UA-53892647-1', 'auto');
		  ga('send', 'pageview');

		</script>
        <!--/ END PAGE LEVEL SCRIPTS -->
        <!--/ END JAVASCRIPT SECTION -->

    </body>
    <!--/ END BODY -->

</html>