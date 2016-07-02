<?php echo $header; ?>
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-default">
                <div class="panel-heading">
                    <img src="<?php echo ADMIN_THEME; ?>/images/large_logo.png" class="login_logo" />
                </div>
                <div class="panel-body">
			 <div class="form-group">		
                <?php echo form_error('password', '<div class="alert alert-danger">', '</div>'); ?>									
					<label class="control-label" for="password"><?php echo $this->lang->line('forgot_password'); ?></label>
					<div class="controls">
						<?php 	$data = array(
						  'name'        => 'password',
						  'id'          => 'password',
						  'class'       => 'form-control',
						  'value'		=> set_value('password')
						);
			
						echo form_password($data); ?>
					</div> <!-- /controls -->				
				</div> <!-- /form-group -->

				<div class="form-group">	
                <?php echo form_error('con_password', '<div class="alert alert-danger">', '</div>'); ?>									
					<label class="control-label" for="con_password"><?php echo $this->lang->line('forgot_confirm'); ?></label>
					<div class="controls">
						<?php 	$data = array(
						  'name'        => 'con_password',
						  'id'          => 'con_password',
						  'class'       => 'form-control',
						  'value'		=> set_value('con_password')
						);
			
						echo form_password($data); ?>
					</div> <!-- /controls -->				
				</div> <!-- /form-group -->      
                </div>
                <div class="panel-footer">
                <?php 	$data = array(
						  'name'        => 'submit',
						  'id'          => 'submit',
						  'class'       => 'btn btn-primary',
						  'value'		=> $this->lang->line('forgot_btn'),
						);
					 echo form_submit($data); ?> 
				</div> <!-- /form-actions -->
               <?php  echo form_close(); ?>
      	  	</div>
        </div>
    </div>
</div>