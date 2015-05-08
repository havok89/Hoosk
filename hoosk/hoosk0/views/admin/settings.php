<?php echo $header; ?> 
<div class="main">
  <div class="main-inner">
    <div class="container">
      <div class="row">
      <div class="span4">
          <div class="widget">
            <div class="widget-header"> <i class="icon-cog"></i>
              <h3><?php echo $this->lang->line('settings_header'); ?></h3>
            </div>
            <!-- /widget-header -->
            <div class="widget-content">
            <?php echo $this->lang->line('settings_message'); ?>
               
            </div> 
          </div>
          <!-- /widget -->
 
         
     </div>
      <!-- /span4 -->

	<div class="span8">
          <div class="widget">
            <div class="widget-header"> <i class="icon-cog"></i>
              <h3><?php echo $this->lang->line('settings_info'); ?></h3>
            </div>
            <!-- /widget-header -->
            <div class="widget-content">
      		<div class="control-group">	
            <?php foreach ($settings as $s) {
			echo form_open_multipart(BASE_URL.'/admin/settings/update'); ?>
            		<?php echo form_error('siteTitle', '<div class="alert">', '</div>'); ?>									
					<label class="control-label" for="siteTitle"><?php echo $this->lang->line('settings_name'); ?></label>
					<div class="controls">
                    <?php 	$data = array(
						  'name'        => 'siteTitle',
						  'id'          => 'siteTitle',
						  'class'       => 'span5',
						  'value'		=> set_value('siteTitle', $s['siteTitle'], FALSE)
						);
			
						echo form_input($data); ?>
					</div> <!-- /controls -->				
				</div> <!-- /control-group -->
                
            <div class="control-group">	
					<label class="control-label" for="siteFooter"><?php echo $this->lang->line('settings_footer'); ?></label>
					<div class="controls">
                    <?php 	$data = array(
						  'name'        => 'siteFooter',
						  'id'          => 'siteFooter',
						  'class'       => 'span5',
						  'value'		=> set_value('siteFooter', $s['siteFooter'], FALSE)
						);
			
						echo form_input($data); ?>
					</div> <!-- /controls -->				
				</div> <!-- /control-group -->
            
            <div class="control-group">
					<label class="control-label" for="themes"><?php echo $this->lang->line('settings_theme'); ?></label>
					<div class="controls">
					<?php
						$att = 'id="siteTheme" class="span5"';
						$data = array();
						foreach ($themesdir as $t){
							if (!is_dir($t)){
								if (($t != "index.html") && ($t != "admin")){
									$data[$t] = str_replace("/", "", $t);	
								}
							}
						}
	
						echo form_dropdown('siteTheme', $data, $s['siteTheme'], $att); ?>
					</div> <!-- /controls -->				
				</div> <!-- /control-group -->
                <div class="control-group">
					<label class="control-label" for="themes"><?php echo $this->lang->line('settings_lang'); ?></label>
					<div class="controls">
					<?php
						$att = 'id="siteLang" class="span5"';
						$data = array();
						foreach ($langdir as $l){
							if (!is_dir($l)){
								if ($l != "index.html"){
									$data[$l] = str_replace("/", "", $l);	
								}
							}
						}
						
						echo form_dropdown('siteLang', $data, $s['siteLang'], $att); ?>
					</div> <!-- /controls -->				
				</div> <!-- /control-group -->
            <hr />
            
				<div class="control-group">		
            		<?php echo form_error('file_upload', '<div class="alert">', '</div>'); ?>									
					<label class="control-label" for="file_upload"><?php echo $this->lang->line('settings_logo'); ?></label>
					<div class="controls">
						<div><img src="<?php if ($s['siteLogo'] != "") { echo BASE_URL.'/images/'.$s['siteLogo']; } ?>" id="logo_preloaded" <?php if ($s['siteLogo'] == "") { echo "style='display:none;'"; } ?>></div>
						<img src="<?php echo BASE_URL; ?>/theme/admin/images/ajax-loader.gif" style="margin:-7px 5px 0 5px;display:none;" id="loading_pic" />
						<?php
							$data = array(
								'name'		=> 'file_upload',
								'id'		=> 'file_upload',
								'class'		=> 'span5'
							);
							echo form_upload($data); 
						?>
						<input type="hidden" id="siteLogo" name="siteLogo" />
					</div> <!-- /controls -->				
				</div> <!-- /control-group -->
                
            <hr />

             
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
          <!-- /widget -->
 
         
     </div>
      </div>
      <!-- /row --> 
    </div>
    <!-- /container --> 
  </div>
  <!-- /main-inner --> 
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
			$('input[type=file]').on('change', prepareUpload);
		}
	});	
</script>
<?php echo $footer; ?>
