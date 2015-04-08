<?php echo $header; ?>

<div class="main">
  <div class="main-inner">
    <div class="container">
      <div class="row">
      <div class="span12">
          <div class="widget">
            <div class="widget-header"> <i class="icon-user"></i>
              <h3><?php echo $this->lang->line('forgot_reset'); ?></h3>
            </div>
            <!-- /widget-header -->
            <div class="widget-content">
			<p><?php echo $this->lang->line('forgot_complete'); ?></p>
				<a class="button btn btn-primary btn-large" href="<?php echo BASE_URL; ?>/admin/login"><?php echo $this->lang->line('login_signin'); ?></a>
                
                <!-- /widget-content --> 
            </div>
          </div>
          <!-- /widget -->
 
         
     </div>
      <!-- /span12 -->

      </div>
      <!-- /row --> 
    </div>
    <!-- /container --> 
  </div>
  <!-- /main-inner --> 
</div>
<?php echo $footer; ?>
