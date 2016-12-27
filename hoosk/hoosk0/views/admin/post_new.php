<?php echo $header; ?>
<link href="<?php echo ADMIN_THEME; ?>/js/trevor/sir-trevor.css" rel="stylesheet">
<link href="<?php echo ADMIN_THEME; ?>/js/trevor/sir-trevor-bootstrap.css" rel="stylesheet">
<link href="<?php echo ADMIN_THEME; ?>/js/trevor/sir-trevor-icons.css" rel="stylesheet">
<link href="<?php echo ADMIN_THEME; ?>/js/datepicker/jquery.datetimepicker.css" rel="stylesheet">
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                <?php echo $this->lang->line('posts_new_header'); ?>
            </h1>
            <ol class="breadcrumb">
                <li>
                <i class="fa fa-dashboard"></i>
                	<a href="/admin"><?php echo $this->lang->line('nav_dash'); ?></a>
                </li>
                <li>
                <i class="fa fa-fw fa-newspaper-o"></i>
                	<a href="/admin/posts"><?php echo $this->lang->line('nav_posts_all'); ?></a>
                </li>
                <li class="active">
                <i class="fa fa-fw fa-pencil"></i>
                	<?php echo $this->lang->line('posts_new_header'); ?>
                </li>
            </ol>
        </div>
    </div>
</div>
<div class="container-fluid">
  <div class="row">
      <div class="col-md-12">
       	 	<?php echo form_error('postTitle', '<div class="alert alert-danger">', '</div>'); ?>
            <?php echo form_error('postURL', '<div class="alert alert-danger">', '</div>'); ?>
            <?php echo form_error('postExcerpt', '<div class="alert alert-danger">', '</div>'); ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <i class="fa fa-pencil fa-fw"></i>
                    <?php echo $this->lang->line('posts_new_header'); ?>
                </h3>
            </div>

         <div class="panel-body">
			<?php
			$attr = array('id' => 'contentForm');
			echo form_open(BASE_URL.'/admin/posts/new/add', $attr); ?>
						<?php 	$data = array(
						  'name'        => 'content',
						  'id'          => 'content',
						  'class'       => 'js-st-instance',
						);

						echo form_textarea($data, set_value('content', $this->input->post('content'), FALSE)); ?>




              </div>
              <div class="panel-footer">
                    <a class="btn btn-primary" data-toggle="modal" href="#attributes"><?php echo $this->lang->line('btn_next'); ?></a>
					<a class="btn" href="<?php echo BASE_URL; ?>/admin/posts"><?php echo $this->lang->line('btn_cancel'); ?></a>
				</div>
			</div>


		<div id="attributes" class="modal fade" role="dialog">
          <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?php echo $this->lang->line('posts_new_attributes'); ?></h4>
              </div>
              <div class="modal-body">
            <div class="alert alert-info"><?php echo $this->lang->line('posts_new_required'); ?></div>
            <div class="form-group">
            		<?php echo form_error('postTitle', '<div class="alert alert-danger">', '</div>'); ?>
					<label class="control-label" for="postTitle"><?php echo $this->lang->line('posts_new_title'); ?></label>
					<div class="controls">
                    <?php 	$data = array(
						  'name'        => 'postTitle',
						  'id'          => 'postTitle',
						  'class'       => 'form-control',
						  'value'		=> set_value('postTitle', '', FALSE)
						);

						echo form_input($data); ?>
					</div> <!-- /controls -->
				</div> <!-- /form-group -->
               <div class="form-group">
            		<?php echo form_error('file_upload', '<div class="alert alert-danger">', '</div>'); ?>
					<label class="control-label" for="file_upload"><?php echo $this->lang->line('posts_new_feature'); ?></label>
					<div class="controls">
						<div><img src="" id="logo_preloaded" style='display:none;'></div>
						<img src="<?php echo BASE_URL; ?>/theme/admin/images/ajax-loader.gif" style="margin:-7px 5px 0 5px;display:none;" id="loading_pic" />
						<?php
							$data = array(
								'name'		=> 'file_upload',
								'id'		=> 'file_upload',
								'class'		=> 'form-control'
							);
							echo form_upload($data);
						?>
						<input type="hidden" id="postImage" name="postImage" />
					</div> <!-- /controls -->
				</div> <!-- /form-group -->
               <div class="form-group">
                    <?php echo form_error('postExcerpt', '<div class="alert alert-danger">', '</div>'); ?>
					<label class="control-label" for="postExcerpt"><?php echo $this->lang->line('posts_new_excerpt'); ?></label>
					<div class="controls">
						 <?php 	$data = array(
						  'name'        => 'postExcerpt',
						  'id'          => 'postExcerpt',
						  'class'       => 'form-control',
						  'rows'		=>	'4',
						);

						echo form_textarea($data, set_value('postExcerpt', '', FALSE)); ?>

					</div> <!-- /controls -->
				</div> <!-- /form-group -->

				<div class="form-group">
            		<?php echo form_error('postURL', '<div class="alert alert-danger">', '</div>'); ?>
					<label class="control-label" for="postURL"><?php echo $this->lang->line('posts_new_url'); ?></label>
					<div class="controls">
						 <?php 	$data = array(
						  'name'        => 'postURL',
						  'id'          => 'postURL',
						  'class'       => 'form-control URLField',
						  'value'		=> set_value('postURL', '', FALSE)
						);

						echo form_input($data); ?>

					</div> <!-- /controls -->
				</div> <!-- /form-group -->
				 <div class="form-group">
                <?php echo form_error('categoryID', '<div class="alert alert-danger">', '</div>'); ?>
					<label class="control-label" for="categoryID"><?php echo $this->lang->line('posts_new_category'); ?></label>
					<div class="controls">
                        <?php
						$att = 'id="categoryID" class="form-control"';
						$data = array();
						foreach ($categories as $c){
						$data[$c['categoryID']] = $c['categoryTitle'];
						}
						echo form_dropdown('categoryID', $data, '0', $att); ?>
					</div> <!-- /controls -->
				</div> <!-- /form-group -->
            <div class="form-group">
                    <div id="datetimepicker1" class="input-append date">
                    <label class="control-label" for="categoryID"><?php echo $this->lang->line('posts_new_date'); ?></label>
                        <div class="controls">
                        <?php 	$data = array(
						  'name'        => 'datePosted',
						  'id'          => 'datetimepicker',
						  'class'       => 'form-control',
						  'value'		=> set_value('datePosted', '', FALSE)
						);

						echo form_input($data); ?>
 					 <?php 	$data = array(
						  'name'        => 'unixStamp',
						  'id'          => 'unixStamp',
						  'style'		=> 'display:none;',
						  'value'		=> set_value('unixStamp', '', FALSE)
						);

						echo form_input($data); ?>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
            <button class="btn" data-dismiss="modal" aria-hidden="true"><?php echo $this->lang->line('btn_back'); ?></button>
            <a class="btn btn-primary" onClick="formSubmit()"><?php echo $this->lang->line('btn_save'); ?></a>
            </div></div>
           <?php  echo form_close(); ?>
     </div>
      <!-- /span12 -->

      </div>
      <!-- /row -->
    </div>

<script src="<?php echo ADMIN_THEME; ?>/js/datepicker/jquery.datetimepicker.js"></script>
<script src="<?php echo ADMIN_THEME; ?>/js/trevor/underscore.js"></script>
<script src="<?php echo ADMIN_THEME; ?>/js/trevor/eventable.js"></script>
<script src="<?php echo ADMIN_THEME; ?>/js/trevor/sortable.min.js"></script>
<script src="<?php echo ADMIN_THEME; ?>/js/trevor/sir-trevor.js"></script>
<script src="<?php echo ADMIN_THEME; ?>/js/trevor/sir-trevor-bootstrap.js"></script>
<script src="<?php echo ADMIN_THEME; ?>/js/date.js"></script>
<script type="text/javascript">
window.onload = function() {
    var now = new Date();
    var strDateTime = [[AddZero(now.getMonth() + 1), AddZero(now.getDate()), now.getFullYear()].join("/"), [AddZero(now.getHours()), AddZero(now.getMinutes()), AddZero(now.getSeconds())].join(":")].join(" ");
    document.getElementById("datetimepicker").value = strDateTime;
};

function AddZero(num) {
    return (num >= 0 && num < 10) ? "0" + num : num + "";
}
	jQuery('#datetimepicker').datetimepicker({
		format:'m/d/Y H:m:s'
	});

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
      var unixtime = Date.parse(document.getElementById('datetimepicker').value).getTime()/1000;
      document.getElementById("unixStamp").value = unixtime;
      document.getElementById("contentForm").submit();
    }
  });
}
</script>
<script type="text/javascript">
$(function () {

	if(document.getElementById('file_upload'))
		{
			function prepareUpload(event)
			{
				files = event.target.files;
				uploadFiles(event);
			}

			function uploadFiles(event)
			{
				event.stopPropagation();
				event.preventDefault();

				$('#loading_pic').show();

				var data = new FormData();
				$.each(files, function(key, value){ data.append(key, value); });

				$.ajax({
					url: '<?php echo BASE_URL; ?>/admin/settings/submit/?files',
					type: 'POST',
					data: data,
					cache: false,
					dataType: 'json',
					processData: false,
					contentType: false,
					success: function(data, textStatus, jqXHR){
						if(data!='0')
						{
							$('#logo_preloaded').show();
							document.getElementById('logo_preloaded').src = '<?php echo BASE_URL; ?>/uploads/' + data;
							document.getElementById('postImage').value = data;
							$('#loading_pic').hide();
						}
						else
							alert('Error! The file is not an image.');
					}
				});
			}

			function submitForm(event, data)
			{
				$form = $(event.target);
				var formData = $form.serialize();
				$.each(data.files, function(key, value){ formData = formData + '&filenames[]=' + value; });

				$.ajax({
					url: '<?php echo BASE_URL; ?>/admin/settings/submit',
					type: 'POST',
					data: formData,
					cache: false,
					dataType: 'json',
					success: function(data, textStatus, jqXHR){
						if(typeof data.error === 'undefined')
							console.log('SUCCESS: ' + data.success);
						else
							console.log('ERRORS: ' + data.error);
					},
					error: function(jqXHR, textStatus, errorThrown){
						console.log('ERRORS: ' + textStatus);
					},
					complete: function()
					{
						$('#loading_pic').hide();
					}
				});
			}

			var files;
			$('input[type=file]').on('change', prepareUpload);
		}
	});
</script>
<?php echo $footer; ?>
