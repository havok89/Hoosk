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
			<?php echo form_open(BASE_URL.'/admin/user/forgot'); ?>
      		<div class="control-group">		
                <?php echo form_error('email', '<div class="alert">', '</div>'); ?>									
					<label class="control-label" for="email"><?php echo $this->lang->line('forgot_email'); ?></label>
					<div class="controls">
						 <?php 	$data = array(
						  'name'        => 'email',
						  'id'          => 'email',
						  'class'       => 'span4',
						  'value'		=> set_value('email')
						);
			
						echo form_input($data); ?>

					</div> <!-- /controls -->				
				</div> <!-- /control-group -->        
                
                <div class="form-actions">
                <?php 	$data = array(
						  'name'        => 'submit',
						  'id'          => 'submit',
						  'class'       => 'btn btn-primary',
						  'value'		=> $this->lang->line('forgot_btn'),
						);
					 echo form_submit($data); ?> 
				</div> <!-- /form-actions -->
               <?php  echo form_close(); ?>
                
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
