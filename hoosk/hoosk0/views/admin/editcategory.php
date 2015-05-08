<?php echo $header; ?>

<div class="main">
  <div class="main-inner">
    <div class="container">
      <div class="row">
      <div class="span12">
          <div class="widget widget-nopad">
            <div class="widget-header"> <i class="icon-edit"></i>
              <h3><?php echo $this->lang->line('cat_edit_header'); ?></h3>
            </div>
            <!-- /widget-header -->
            <div class="widget-content">
            <div class="content">
            <?php foreach ($category as $c) {
				echo form_open(BASE_URL.'/admin/posts/categories/edited/'.$c['categoryID']); ?>
            <div class="alert alert-info"><?php echo $this->lang->line('cat_new_required'); ?></div>	
                <div class="control-group">		
                <?php echo form_error('categoryTitle', '<div class="alert">', '</div>'); ?>									
					<label class="control-label" for="categoryTitle"><?php echo $this->lang->line('cat_new_title'); ?></label>
					<div class="controls">
                    <?php 	$data = array(
						  'name'        => 'categoryTitle',
						  'id'          => 'categoryTitle',
						  'class'       => 'span4',
						  'value'		=> set_value('categoryTitle', $c['categoryTitle'], FALSE)
						);
			
						echo form_input($data); ?>
					</div> <!-- /controls -->				
				</div> <!-- /control-group -->

				<div class="control-group">		
                <?php echo form_error('categorySlug', '<div class="alert">', '</div>'); ?>									
					<label class="control-label" for="categorySlug"><?php echo $this->lang->line('cat_new_url'); ?></label>
					<div class="controls">
						 <?php 	$data = array(
						  'name'        => 'categorySlug',
						  'id'          => 'categorySlug',
						  'class'       => 'span4',
						  'value'		=> set_value('categorySlug', $c['categorySlug'], FALSE)
						);
			
						echo form_input($data); ?>

					</div> <!-- /controls -->				
				</div> <!-- /control-group -->
                
               	<div class="control-group">		
                    <?php echo form_error('categoryDescription', '<div class="alert">', '</div>'); ?>									
					<label class="control-label" for="categoryDescription"><?php echo $this->lang->line('cat_new_description'); ?></label>
					<div class="controls">
						 <?php 	$data = array(
						  'name'        => 'categoryDescription',
						  'id'          => 'categoryDescription',
						  'class'       => 'span4',
						  'rows'		=>	'4',
						);
			
						echo form_textarea($data, set_value('categoryDescription', $c['categoryDescription'], FALSE)); ?>

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
					<a class="btn" href="<?php echo BASE_URL; ?>/admin/posts/categories"><?php echo $this->lang->line('btn_cancel'); ?></a>
				</div> <!-- /form-actions -->
               <?php  echo form_close(); } ?>
                
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
