    <!-- FOOTER
    =================================-->
    <div class="footer">
      <div class="container">
        <div class="row">
          <div class="col-md-5 col-xs-12 pull-left">
           <p><?php echo $settings['siteFooter']; ?></p>
          </div>
          <div class="col-md-5 col-xs-12 pull-right text-right">
           <?php getSocial(); ?>
          </div>
        </div>
      </div>
    </div>

	<!-- /FOOTER ============-->

   	<!-- script references -->
	<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
	<script src="<?php echo THEME_FOLDER; ?>/js/bootstrap.min.js"></script>
	<?php echo $settings['siteAdditionalJS']; ?>
	</body>
</html>
