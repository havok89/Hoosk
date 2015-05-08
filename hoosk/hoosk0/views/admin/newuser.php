<?php echo $header; ?>

<div class="main">
  <div class="main-inner">
    <div class="container">
      <div class="row">
      <div class="span12">
          <div class="widget widget-nopad">
            <div class="widget-header"> <i class="icon-user"></i>
              <h3><?php echo $this->lang->line('user_new_header'); ?></h3>
            </div>
            <!-- /widget-header -->
            <div class="widget-content">
            <div class="content">
			<?php echo form_open(BASE_URL.'/admin/users/new/add'); ?>

                <div class="control-group">		
                <?php echo form_error('username', '<div class="alert">', '</div>'); ?>									
					<label class="control-label" for="username"><?php echo $this->lang->line('user_new_username'); ?></label>
					<div class="controls">
                    <?php 	$data = array(
						  'name'        => 'username',
						  'id'          => 'username',
						  'class'       => 'span4',
						  'value'		=> set_value('username', '', FALSE)
						);
			
						echo form_input($data); ?>

						<p class="help-block"><?php echo $this->lang->line('user_new_message'); ?></p>
					</div> <!-- /controls -->				
				</div> <!-- /control-group -->

				<div class="control-group">		
                <?php echo form_error('email', '<div class="alert">', '</div>'); ?>									
					<label class="control-label" for="email"><?php echo $this->lang->line('user_new_email'); ?></label>
					<div class="controls">
						 <?php 	$data = array(
						  'name'        => 'email',
						  'id'          => 'email',
						  'class'       => 'span4',
						  'value'		=> set_value('email', '', FALSE)
						);
			
						echo form_input($data); ?>

					</div> <!-- /controls -->				
				</div> <!-- /control-group -->
                
                <div class="control-group">		
                <?php echo form_error('password', '<div class="alert">', '</div>'); ?>									
					<label class="control-label" for="password"><?php echo $this->lang->line('user_new_pass'); ?></label>
					<div class="controls">
						<?php 	$data = array(
						  'name'        => 'password',
						  'id'          => 'password',
						  'class'       => 'span4',
						  'value'		=> set_value('password', '', FALSE)
						);
			
						echo form_password($data); ?>
					</div> <!-- /controls -->				
				</div> <!-- /control-group -->

				<div class="control-group">	
                <?php echo form_error('con_password', '<div class="alert">', '</div>'); ?>									
					<label class="control-label" for="con_password"><?php echo $this->lang->line('user_new_confirm'); ?></label>
					<div class="controls">
						<?php 	$data = array(
						  'name'        => 'con_password',
						  'id'          => 'con_password',
						  'class'       => 'span4',
						  'value'		=> set_value('con_password', '', FALSE)
						);
			
						echo form_password($data); ?>
					</div> <!-- /controls -->				
				</div> <!-- /control-group -->
                
                </div><!-- /content -->
                <div class="form-actions">
                <?php 	$data = array(
						  'name'        => 'submit',
						  'id'          => 'submit',
						  'class'       => 'btn btn-primary',
						  'value'		=> $this->lang->line('btn_save'),
						);
					 echo form_submit($data); ?> 
					<a class="btn" href="<?php echo BASE_URL; ?>/admin/users"><?php echo $this->lang->line('btn_cancel'); ?></a>
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
