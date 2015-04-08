<?php echo $header; ?>

<div class="main">
  <div class="main-inner">
    <div class="container">
      <div class="row">
      <div class="span12">
          <div class="widget">
            <div class="widget-header"> <i class="icon-user"></i>
              <h3><?php echo $this->lang->line('forgot_check_email'); ?></h3>
            </div>
            <!-- /widget-header -->
            <div class="widget-content">
			 <div class="control-group">		
                <?php echo form_error('password', '<div class="alert">', '</div>'); ?>									
					<label class="control-label" for="password"><?php echo $this->lang->line('forgot_password'); ?></label>
					<div class="controls">
						<?php 	$data = array(
						  'name'        => 'password',
						  'id'          => 'password',
						  'class'       => 'span4',
						  'value'		=> set_value('password')
						);
			
						echo form_password($data); ?>
					</div> <!-- /controls -->				
				</div> <!-- /control-group -->

				<div class="control-group">	
                <?php echo form_error('con_password', '<div class="alert">', '</div>'); ?>									
					<label class="control-label" for="con_password"><?php echo $this->lang->line('forgot_confirm'); ?></label>
					<div class="controls">
						<?php 	$data = array(
						  'name'        => 'con_password',
						  'id'          => 'con_password',
						  'class'       => 'span4',
						  'value'		=> set_value('con_password')
						);
			
						echo form_password($data); ?>
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
