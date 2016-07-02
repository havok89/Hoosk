<?php echo $header; ?>
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-default">
                <div class="panel-heading">
                    <img src="<?php echo ADMIN_THEME; ?>/images/large_logo.png" class="login_logo" />
                </div>
                <div class="panel-body">
                <h3><?php echo $this->lang->line('forgot_reset'); ?></h3>
			<?php echo form_open(BASE_URL.'/admin/user/forgot'); ?>
      		<div class="form-group">		
                <?php echo form_error('email', '<div class="alert alert-danger">', '</div>'); ?>									
					<label class="control-label" for="email"><?php echo $this->lang->line('forgot_email'); ?></label>
					<div class="controls">
						 <?php 	$data = array(
						  'name'        => 'email',
						  'id'          => 'email',
						  'class'       => 'form-control',
						  'value'		=> set_value('email')
						);
			
						echo form_input($data); ?>

					</div> <!-- /controls -->				
				</div> <!-- /control-group -->        
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