<?php echo $header; ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                <?php echo $this->lang->line('user_new_header'); ?>
            </h1>
            <ol class="breadcrumb">
                <li>
                <i class="fa fa-dashboard"></i>
                	<a href="<?php echo BASE_URL; ?>/admin"><?php echo $this->lang->line('nav_dash'); ?></a>
                </li>
                <li>
                <i class="fa fa-fw fa-user"></i>
                	<a href="<?php echo BASE_URL; ?>/admin/users"><?php echo $this->lang->line('user_header'); ?></a>
                </li>
                <li class="active">
                <i class="fa fa-fw fa-pencil"></i>
                	<?php echo $this->lang->line('user_new_header'); ?>
                </li>
            </ol>
        </div>
    </div>
</div>
<div class="container-fluid">
  <div class="row">
      <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <i class="fa fa-pencil fa-fw"></i>
                    <?php echo $this->lang->line('user_new_header'); ?>
                </h3>
            </div>
            
         <div class="panel-body">
			<?php echo form_open(BASE_URL.'/admin/users/new/add'); ?>

                <div class="form-group">		
                <?php echo form_error('username', '<div class="alert alert-danger">', '</div>'); ?>									
					<label class="control-label" for="username"><?php echo $this->lang->line('user_new_username'); ?></label>
					<div class="controls">
                    <?php 	$data = array(
						  'name'        => 'username',
						  'id'          => 'username',
						  'class'       => 'form-control',
						  'value'		=> set_value('username', '', FALSE)
						);
			
						echo form_input($data); ?>

						<p class="help-block"><?php echo $this->lang->line('user_new_message'); ?></p>
					</div> <!-- /controls -->				
				</div> <!-- /form-group -->

				<div class="form-group">		
                <?php echo form_error('email', '<div class="alert alert-danger">', '</div>'); ?>									
					<label class="control-label" for="email"><?php echo $this->lang->line('user_new_email'); ?></label>
					<div class="controls">
						 <?php 	$data = array(
						  'name'        => 'email',
						  'id'          => 'email',
						  'class'       => 'form-control',
						  'value'		=> set_value('email', '', FALSE)
						);
			
						echo form_input($data); ?>

					</div> <!-- /controls -->				
				</div> <!-- /form-group -->
                
                <div class="form-group">		
                <?php echo form_error('password', '<div class="alert alert-danger">', '</div>'); ?>									
					<label class="control-label" for="password"><?php echo $this->lang->line('user_new_pass'); ?></label>
					<div class="controls">
						<?php 	$data = array(
						  'name'        => 'password',
						  'id'          => 'password',
						  'class'       => 'form-control',
						  'value'		=> set_value('password', '', FALSE)
						);
			
						echo form_password($data); ?>
					</div> <!-- /controls -->				
				</div> <!-- /form-group -->

				<div class="form-group">	
                <?php echo form_error('con_password', '<div class="alert alert-danger">', '</div>'); ?>									
					<label class="control-label" for="con_password"><?php echo $this->lang->line('user_new_confirm'); ?></label>
					<div class="controls">
						<?php 	$data = array(
						  'name'        => 'con_password',
						  'id'          => 'con_password',
						  'class'       => 'form-control',
						  'value'		=> set_value('con_password', '', FALSE)
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
						  'value'		=> $this->lang->line('btn_save'),
						);
					 echo form_submit($data); ?> 
					<a class="btn" href="<?php echo BASE_URL; ?>/admin/users"><?php echo $this->lang->line('btn_cancel'); ?></a>
				</div> <!-- /form-actions -->
               <?php  echo form_close(); ?>
            </div>
		</div>
	</div>
</div>
<?php echo $footer; ?>