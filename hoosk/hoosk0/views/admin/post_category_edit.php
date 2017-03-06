<?php echo $header; ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                <?php echo $this->lang->line('cat_edit_header'); ?>
            </h1>
            <ol class="breadcrumb">
                <li>
                <i class="fa fa-dashboard"></i>
                	<a href="<?php echo BASE_URL; ?>/admin"><?php echo $this->lang->line('nav_dash'); ?></a>
                </li>
                <li>
                <i class="fa fa-fw fa-list"></i>
                	<a href="<?php echo BASE_URL; ?>/admin/posts/categories"><?php echo $this->lang->line('cat_header'); ?></a>
                </li>
                <li class="active">
                <i class="fa fa-fw fa-pencil"></i>
                	<?php echo $this->lang->line('cat_edit_header'); ?>
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
                    <?php echo $this->lang->line('cat_edit_header'); ?>
                </h3>
            </div>
            
         <div class="panel-body">
            <?php foreach ($category as $c) {
				echo form_open(BASE_URL.'/admin/posts/categories/edited/'.$c['categoryID']); ?>
            <div class="alert alert-info"><?php echo $this->lang->line('cat_new_required'); ?></div>	
                <div class="form-group">		
                <?php echo form_error('categoryTitle', '<div class="alert alert-danger">', '</div>'); ?>									
					<label class="control-label" for="categoryTitle"><?php echo $this->lang->line('cat_new_title'); ?></label>
					<div class="controls">
                    <?php 	$data = array(
						  'name'        => 'categoryTitle',
						  'id'          => 'categoryTitle',
						  'class'       => 'form-control',
						  'value'		=> set_value('categoryTitle', $c['categoryTitle'], FALSE)
						);
			
						echo form_input($data); ?>
					</div> <!-- /controls -->				
				</div> <!-- /form-group -->

				<div class="form-group">		
                <?php echo form_error('categorySlug', '<div class="alert alert-danger">', '</div>'); ?>									
					<label class="control-label" for="categorySlug"><?php echo $this->lang->line('cat_new_url'); ?></label>
					<div class="controls">
						 <?php 	$data = array(
						  'name'        => 'categorySlug',
						  'id'          => 'categorySlug',
						  'class'       => 'form-control URLField',
						  'value'		=> set_value('categorySlug', $c['categorySlug'], FALSE)
						);
			
						echo form_input($data); ?>

					</div> <!-- /controls -->				
				</div> <!-- /form-group -->
                
               	<div class="form-group">		
                    <?php echo form_error('categoryDescription', '<div class="alert alert-danger">', '</div>'); ?>									
					<label class="control-label" for="categoryDescription"><?php echo $this->lang->line('cat_new_description'); ?></label>
					<div class="controls">
						 <?php 	$data = array(
						  'name'        => 'categoryDescription',
						  'id'          => 'categoryDescription',
						  'class'       => 'form-control',
						  'rows'		=>	'4',
						);
			
						echo form_textarea($data, set_value('categoryDescription', $c['categoryDescription'], FALSE)); ?>

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
					<a class="btn" href="<?php echo BASE_URL; ?>/admin/posts/categories"><?php echo $this->lang->line('btn_cancel'); ?></a>
				</div>
               <?php  echo form_close(); } ?>
			</div>
		</div>
	</div>
</div>
<?php echo $footer; ?>