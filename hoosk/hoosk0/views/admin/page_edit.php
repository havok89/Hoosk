<?php echo $header; ?>
<link href="<?php echo ADMIN_THEME; ?>/js/trevor/sir-trevor.css" rel="stylesheet">
<link href="<?php echo ADMIN_THEME; ?>/js/trevor/sir-trevor-bootstrap.css" rel="stylesheet">
<link href="<?php echo ADMIN_THEME; ?>/js/trevor/sir-trevor-icons.css" rel="stylesheet">
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                <?php echo $this->lang->line('pages_edit_header'); ?>
            </h1>
            <ol class="breadcrumb">
                <li>
                <i class="fa fa-dashboard"></i>
                	<a href="<?php echo BASE_URL; ?>/admin"><?php echo $this->lang->line('nav_dash'); ?></a>
                </li>
                <li>
                <i class="fa fa-fw fa-file"></i>
                	<a href="<?php echo BASE_URL; ?>/admin/pages"><?php echo $this->lang->line('nav_pages_all'); ?></a>
                </li>
                <li class="active">
                <i class="fa fa-fw fa-pencil"></i>
                	<?php echo $this->lang->line('pages_edit_header'); ?>
                </li>
            </ol>
        </div>
    </div>
</div>
<div class="container-fluid">
  <div class="row">
      <div class="col-md-12">
      		<?php echo form_error('pageTitle', '<div class="alert alert-danger">', '</div>'); ?>
            <?php echo form_error('pageURL', '<div class="alert alert-danger">', '</div>'); ?>
      	<div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <i class="fa fa-pencil fa-fw"></i>
                    <?php echo $this->lang->line('pages_edit_header'); ?>
                </h3>
            </div>
         <div class="panel-body">

            <?php foreach ($pages as $p) {?>

			<?php
			$attr = array('id' => 'contentForm');
			 echo form_open(BASE_URL.'/admin/pages/edited/'.$this->uri->segment(4), $attr); ?>
						<?php 	$data = array(
						  'id'          => 'content',
						  'name'          => 'content',
						  'class'       => 'js-st-instance',
						);

						if ($this->input->post('content')){
							$set = $this->input->post('content');
						} else {
							$set = $p['pageContent'];
						}
						echo form_textarea($data, set_value('content',$set, FALSE)); ?>

           </div>
           <div class="panel-footer">
                    <a class="btn btn-primary" data-toggle="modal" href="#attributes"><?php echo $this->lang->line('btn_next'); ?></a>
					<a class="btn" href="<?php echo BASE_URL; ?>/admin/pages"><?php echo $this->lang->line('btn_cancel'); ?></a>
				</div>
          </div>

		<div id="attributes" class="modal fade" role="dialog">
          <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?php echo $this->lang->line('pages_new_attributes'); ?></h4>
              </div>
              <div class="modal-body">

            <div class="form-group">
            <div class="alert alert-info"><?php echo $this->lang->line('pages_new_required'); ?></div>
            		<?php echo form_error('pageTitle', '<div class="alert alert-danger">', '</div>'); ?>
					<label class="control-label" for="pageTitle"><?php echo $this->lang->line('pages_new_title'); ?></label>
					<div class="controls">
                    <?php 	$data = array(
						  'name'        => 'pageTitle',
						  'id'          => 'pageTitle',
						  'class'       => 'form-control',
						  'value'		=> set_value('pageTitle', $p['pageTitle'], FALSE)
						);

						echo form_input($data); ?>
					</div> <!-- /controls -->
				</div> <!-- /form-group -->

				<div class="form-group">
            		<?php echo form_error('navTitle', '<div class="alert alert-danger">', '</div>'); ?>
					<label class="control-label" for="navTitle"><?php echo $this->lang->line('pages_new_nav'); ?></label>
					<div class="controls">
                    <?php 	$data = array(
						  'name'        => 'navTitle',
						  'id'          => 'navTitle',
						  'class'       => 'form-control',
						  'value'		=> set_value('navTitle', $p['navTitle'], FALSE)
						);

						echo form_input($data); ?>
					</div> <!-- /controls -->
				</div> <!-- /form-group -->

                <div class="form-group">
					<label class="control-label" for="pageKeywords"><?php echo $this->lang->line('pages_new_keywords'); ?></label>
					<div class="controls">
						 <?php 	$data = array(
						  'name'        => 'pageKeywords',
						  'id'          => 'pageKeywords',
						  'class'       => 'form-control',
						  'value'		=> set_value('pageKeywords', $p['pageKeywords'], FALSE)
						);

						echo form_input($data); ?>

					</div> <!-- /controls -->
				</div> <!-- /form-group -->

				<div class="form-group">
					<label class="control-label" for="pageDescription"><?php echo $this->lang->line('pages_new_description'); ?></label>
					<div class="controls">
						 <?php 	$data = array(
						  'name'        => 'pageDescription',
						  'id'          => 'pageDescription',
						  'class'       => 'form-control',
						  'value'		=> set_value('pageDescription', $p['pageDescription'], FALSE)
						);

						echo form_input($data); ?>

					</div> <!-- /controls -->
				</div> <!-- /form-group -->

				<div class="form-group">
            		<?php echo form_error('pageURL', '<div class="alert alert-danger">', '</div>'); ?>
					<label class="control-label" for="pageURL"><?php echo $this->lang->line('pages_new_url'); ?></label>
					<div class="controls">
						 <?php 	$data = array(
						  'name'        => 'pageURL',
						  'id'          => 'pageURL',
						  'value'		=> set_value('pageURL', $p['pageURL'], FALSE)
						);
						if ($p['pageURL'] == "home") { $data['disabled'] = ""; $data['class'] = "form-control URLField disabled";  } else {  $data['class'] = "form-control URLField"; }

						echo form_input($data); ?>

					</div> <!-- /controls -->
				</div> <!-- /form-group -->

               <div class="form-group">
                <?php echo form_error('pagePublished', '<div class="alert">', '</div>'); ?>
					<label class="control-label" for="pagePublished"><?php echo $this->lang->line('pages_new_publish'); ?></label>
					<div class="controls">

                        <?php
						$att = 'id="pagePublished" class="form-control"';
						$data = array(
						  '1'        => $this->lang->line('option_yes'),
						  '0'         => $this->lang->line('option_no'),
						);

						echo form_dropdown('pagePublished', $data, $p['pagePublished'], $att); ?>

					</div> <!-- /controls -->
				</div> <!-- /form-group -->

                <div class="form-group">
                <?php echo form_error('pageTemplate', '<div class="alert">', '</div>'); ?>
					<label class="control-label" for="pageTemplate"><?php echo $this->lang->line('pages_new_template'); ?></label>
					<div class="controls">

                        <?php

						$att = 'id="pageTemplate" class="form-control"';
						$data = array();
						foreach ($templates as $t){
						$t = str_replace(".php", "", $t);
						if (($t != "header") && ($t != "footer") && ($t != "error") && ($t != "article") && ($t != "category") && ($t != "index.html")){
						$data[$t] = $t;
						}
						}

						echo form_dropdown('pageTemplate', $data, $p['pageTemplate'], $att); ?>

					</div> <!-- /controls -->
				</div> <!-- /form-group -->

            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true"><?php echo $this->lang->line('btn_back'); ?></button>
                <a class="btn btn-primary" onClick="formSubmit()"><?php echo $this->lang->line('btn_save'); ?></a>
            </div>
            </div>
           <?php  echo form_close();
		   } ?>
     </div>
      <!-- /colmd12 -->

      </div>
      <!-- /row -->
    </div>
    <!-- /container -->

<script src="<?php echo ADMIN_THEME; ?>/js/trevor/underscore.js"></script>
<script src="<?php echo ADMIN_THEME; ?>/js/trevor/eventable.js"></script>
<script src="<?php echo ADMIN_THEME; ?>/js/trevor/sortable.min.js"></script>
<script src="<?php echo ADMIN_THEME; ?>/js/trevor/sir-trevor.js"></script>
<script src="<?php echo ADMIN_THEME; ?>/js/trevor/sir-trevor-bootstrap.js"></script>
<script type="text/javascript">
	new SirTrevor.Editor({ el: $('.js-st-instance'),
  	blockTypes: ["Columns", "Heading", "Text", "ImageExtended", "Quote", "Accordion", "Button", "Video", "List", "Iframe"]
	});
	SirTrevor.onBeforeSubmit();
</script>
<script type="text/javascript">

function formSubmit(){
  $.ajax({
    url: "/admin/check/session",
  }).done(function(data) {
    sessionExist = data;
    if(sessionExist==0){
      $('.modal').modal('hide');
      $('#loginModal').modal({
        backdrop: 'static',
        keyboard: false
      }).modal('show');
    } else {
      SirTrevor.onBeforeSubmit();
    	document.getElementById("contentForm").submit();
    }
  });
}
</script>
<?php echo $footer; ?>
