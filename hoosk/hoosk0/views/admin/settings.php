<?php echo $header; ?> 
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                <?php echo $this->lang->line('settings_header'); ?>
            </h1>
            <ol class="breadcrumb">
                <li>
                <i class="fa fa-dashboard"></i>
                	<a href="<?php echo BASE_URL; ?>/admin"><?php echo $this->lang->line('nav_dash'); ?></a>
                </li>
                <li class="active">
                <i class="fa fa-fw fa-cogs "></i>
                	<a href="<?php echo BASE_URL; ?>/admin/settings"><?php echo $this->lang->line('settings_header'); ?></a>
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
                    <i class="fa fa-cogs fa-fw"></i>
                    <?php echo $this->lang->line('settings_header'); ?>
                </h3>
            </div>
         	<div class="panel-body">
            <?php echo $this->lang->line('settings_message'); ?>
               
            </div> 
          </div>


	<div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">
                <i class="fa fa-cogs fa-fw"></i>
                <?php echo $this->lang->line('settings_info'); ?>
            </h3>
        </div>
        <div class="panel-body">
      		<div class="form-group">	
            <?php foreach ($settings as $s) {
			echo form_open_multipart(BASE_URL.'/admin/settings/update'); ?>
            		<?php echo form_error('siteTitle', '<div class="alert">', '</div>'); ?>									
					<label class="control-label" for="siteTitle"><?php echo $this->lang->line('settings_name'); ?></label>
					<div class="controls">
                    <?php 	$data = array(
						  'name'        => 'siteTitle',
						  'id'          => 'siteTitle',
						  'class'       => 'form-control',
						  'value'		=> set_value('siteTitle', $s['siteTitle'], FALSE)
						);
			
						echo form_input($data); ?>
					</div> <!-- /controls -->				
				</div> <!-- /form-group -->
                
            <div class="form-group">	
					<label class="control-label" for="siteFooter"><?php echo $this->lang->line('settings_footer'); ?></label>
					<div class="controls">
                    <?php 	$data = array(
						  'name'        => 'siteFooter',
						  'id'          => 'siteFooter',
						  'class'       => 'form-control',
						  'value'		=> set_value('siteFooter', $s['siteFooter'], FALSE)
						);
			
						echo form_input($data); ?>
					</div> <!-- /controls -->				
				</div> <!-- /form-group -->
            
            <div class="form-group">
					<label class="control-label" for="themes"><?php echo $this->lang->line('settings_theme'); ?></label>
					<div class="controls">
					<?php
						$att = 'id="siteTheme" class="form-control"';
						$data = array();
						foreach ($themesdir as $t){
							if (!is_dir($t)){
								if (($t != "index.html") && ($t != "admin/") && ($t != "admin")){
									$t = str_replace("/", "", $t);
									$data[$t] = $t;	
								}
							}
						}
	
						echo form_dropdown('siteTheme', $data, $s['siteTheme'], $att); ?>
					</div> <!-- /controls -->				
				</div> <!-- /form-group -->
                <div class="form-group">
					<label class="control-label" for="siteLang"><?php echo $this->lang->line('settings_lang'); ?></label>
					<div class="controls">
					<?php
						$att = 'id="siteLang" class="form-control"';
						$data = array();
						foreach ($langdir as $l){
							if (!is_dir($l)){
								if ($l != "index.html"){
									$l = str_replace("/", "", $l);
									$data[$l] = $l;		
								}
							}
						}
						
						echo form_dropdown('siteLang', $data, $s['siteLang'], $att); ?>
					</div> <!-- /controls -->				
				</div> <!-- /form-group -->
            <hr />
            
				<div class="form-group">		
            		<?php echo form_error('file_upload', '<div class="alert">', '</div>'); ?>									
					<label class="control-label" for="file_upload"><?php echo $this->lang->line('settings_logo'); ?></label>
					<div class="controls">
						<div><img src="<?php if ($s['siteLogo'] != "") { echo BASE_URL.'/images/'.$s['siteLogo']; } ?>" id="logo_preloaded" <?php if ($s['siteLogo'] == "") { echo "style='display:none;'"; } ?>></div>
						<img src="<?php echo BASE_URL; ?>/theme/admin/images/ajax-loader.gif" style="margin:-7px 5px 0 5px;display:none;" id="loading_pic" />
						<?php
							$data = array(
								'name'		=> 'file_upload',
								'id'		=> 'file_upload',
								'class'		=> 'form-control'
							);
							echo form_upload($data); 
						?>
						<input type="hidden" id="siteLogo" name="siteLogo" />
					</div> <!-- /controls -->				
				</div> <!-- /form-group -->
              <hr />
               <div class="form-group">		
            		<?php echo form_error('file_upload', '<div class="alert">', '</div>'); ?>									
					<label class="control-label" for="favicon_upload"><?php echo $this->lang->line('settings_favicon'); ?></label>
					<div class="controls">
						<div><img src="<?php if ($s['siteFavicon'] != "") { echo BASE_URL.'/images/'.$s['siteFavicon']; } ?>" id="favicon_preloaded" <?php if ($s['siteFavicon'] == "") { echo "style='display:none;'"; } ?>></div>
						<img src="<?php echo BASE_URL; ?>/theme/admin/images/ajax-loader.gif" style="margin:-7px 5px 0 5px;display:none;" id="loading_pic_favicon" />
						<?php
							$data = array(
								'name'		=> 'favicon_upload',
								'id'		=> 'favicon_upload',
								'class'		=> 'form-control'
							);
							echo form_upload($data); 
						?>
						<input type="hidden" id="siteFavicon" name="siteFavicon" />
					</div> <!-- /controls -->				
				</div> <!-- /form-group -->
                <hr />
                <div class="form-group">
					<label class="control-label" for="siteMaintenance"><?php echo $this->lang->line('settings_maintenance'); ?></label>
					<div class="controls">
					<?php
						$att = 'id="siteMaintenance" class="form-control"';
						$data = array(
						"0" => "Disabled",
						"1" => "Enabled"
						);
						
						
						echo form_dropdown('siteMaintenance', $data, $s['siteMaintenance'], $att); ?>
					</div> <!-- /controls -->				
				</div> <!-- /form-group -->
               <div class="form-group">	
					<label class="control-label" for="siteMaintenanceHeading"><?php echo $this->lang->line('settings_maintenance_heading'); ?></label>
					<div class="controls">
                    <?php 	$data = array(
						  'name'        => 'siteMaintenanceHeading',
						  'id'          => 'siteMaintenanceHeading',
						  'class'       => 'form-control',
						  'value'		=> set_value('siteMaintenanceHeading', $s['siteMaintenanceHeading'], FALSE)
						);
			
						echo form_input($data); ?>
					</div> <!-- /controls -->				
				</div> <!-- /form-group -->
               <div class="form-group">	
					<label class="control-label" for="siteMaintenanceMeta"><?php echo $this->lang->line('settings_maintenance_meta'); ?></label>
					<div class="controls">
                    <?php 	$data = array(
						  'name'        => 'siteMaintenanceMeta',
						  'id'          => 'siteMaintenanceMeta',
						  'class'       => 'form-control',
						  'value'		=> set_value('siteMaintenanceMeta', $s['siteMaintenanceMeta'], FALSE)
						);
			
						echo form_input($data); ?>
					</div> <!-- /controls -->				
				</div> <!-- /form-group -->
                <div class="form-group">	
					<label class="control-label" for="siteMaintenanceContent"><?php echo $this->lang->line('settings_maintenance_content'); ?></label>
					<div class="controls">
                    <?php 	$data = array(
						  'name'        => 'siteMaintenanceContent',
						  'id'          => 'siteMaintenanceContent',
						  'class'       => 'form-control',
						  'value'		=> set_value('siteMaintenanceContent', $s['siteMaintenanceContent'], FALSE)
						);
			
						echo form_textarea($data); ?>
					</div> <!-- /controls -->				
				</div> <!-- /form-group -->
			  <hr/>
			  <div class="form-group">	
					<label class="control-label" for="siteAdditionalJS"><?php echo $this->lang->line('settings_additional_js'); ?></label>
					<div class="controls">
					<?php 	$data = array(
						  'name'        => 'siteAdditionalJS',
						  'id'          => 'siteAdditionalJS',
						  'class'       => 'form-control',
						  'value'		=> set_value('siteAdditionalJS', $s['siteAdditionalJS'], FALSE)
						);

						echo form_textarea($data); ?>
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
					 <?php echo form_close();
			} ?>
			</div> 
		</div>
	</div>
</div>
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
							document.getElementById('siteLogo').value = data;
							$('#loading_pic').hide();
						}
						else
							alert('<?php echo $this->lang->line('settings_image_error'); ?>');
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
			$('input[name=file_upload]').on('change', prepareUpload);
		}
	if(document.getElementById('favicon_upload'))
		{
			function prepareUploadFavi(event)
			{
				files = event.target.files;
				uploadFilesFavi(event);
			}
	
			function uploadFilesFavi(event)
			{
				event.stopPropagation();
				event.preventDefault();
	
				$('#loading_pic_favicon').show();
	
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
							$('#favicon_preloaded').show();
							document.getElementById('favicon_preloaded').src = '<?php echo BASE_URL; ?>/uploads/' + data;
							document.getElementById('siteFavicon').value = data;
							$('#loading_pic_favicon').hide();
						}
						else
							alert('<?php echo $this->lang->line('settings_image_error'); ?>');
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
						$('#loading_pic_favicon').hide();
					}
				});
			}
			
			var files;
			$('input[name=favicon_upload]').on('change', prepareUploadFavi);
		}
	});	
</script>
<?php echo $footer; ?>
