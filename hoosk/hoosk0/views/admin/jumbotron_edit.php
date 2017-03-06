<?php echo $header; ?>
<link href="<?php echo ADMIN_THEME; ?>/js/trevor/sir-trevor.css" rel="stylesheet">
<link href="<?php echo ADMIN_THEME; ?>/js/trevor/sir-trevor-bootstrap.css" rel="stylesheet">
<link href="<?php echo ADMIN_THEME; ?>/js/trevor/sir-trevor-icons.css" rel="stylesheet">
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                <?php echo $this->lang->line('pages_jumbo_edit'); ?>
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
                	<?php echo $this->lang->line('pages_jumbo_edit'); ?>
                </li>
            </ol>
        </div>
    </div>
</div>
    <div class="container-fluid">
      <div class="row">
      <div class="col-md-12">
                     <div class="alert alert-info"><?php echo $this->lang->line('pages_jumbo_intro'); ?></div>
			<div class="panel panel-default">
        		<div class="panel-heading">
                    <h3 class="panel-title">
                        <i class="fa fa-pencil fa-fw"></i>
                        <?php echo $this->lang->line('pages_slider_header'); ?>
                    </h3>
                </div>
            	<div class="panel-body">
					<div class="form-actions">
                    	<a class="btn btn-primary" data-toggle="modal" href="#slider"><?php echo $this->lang->line('pages_slider_btn'); ?></a>
					</div>
                </div>
            </div>

            <div class="panel panel-default">
        		<div class="panel-heading">
                    <h3 class="panel-title">
                        <i class="fa fa-pencil fa-fw"></i>
                        <?php echo $this->lang->line('pages_jumbo_header'); ?>
                    </h3>
                </div>
            	<div class="panel-body text-center">
					<?php foreach ($pages as $p) {
                    echo form_error('pageTitle', '<div class="alert">', '</div>');
                    $attr = "id='contentForm'";
                   echo form_open(BASE_URL.'/admin/pages/jumbotron/'.$this->uri->segment(4), $attr); ?>
                                <?php 	$data = array(
                                  'id'          => 'jumbotron',
                                  'name'          => 'jumbotron',
                                  'class'       => 'js-st-instance',
                                );

					echo form_textarea($data, set_value('jumbotron', $p['jumbotron'], FALSE)); ?>
                </div>
                <div class="panel-footer">
                    <a class="btn btn-primary" data-toggle="modal" href="#attributes"><?php echo $this->lang->line('btn_next'); ?></a>
                    <a class="btn" href="<?php echo BASE_URL; ?>/admin/pages"><?php echo $this->lang->line('btn_cancel'); ?></a>
                </div> <!-- /form-actions -->
            </div>
         <div id="attributes" class="modal fade" role="dialog">
          <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?php echo $this->lang->line('pages_jumbo_header_att'); ?></h4>
              </div>
              <div class="modal-body">
                <div class="form-group">
                <?php echo form_error('enableJumbotron', '<div class="alert">', '</div>'); ?>
					<label class="control-label" for="enableJumbotron"><?php echo $this->lang->line('pages_jumbo_enable'); ?></label>

                        <?php
						$att = 'id="enableJumbotron" class="form-control"';
						$data = array(
						  '1'        => $this->lang->line('option_yes'),
						  '0'         => $this->lang->line('option_no'),
						);

						echo form_dropdown('enableJumbotron', $data, $p['enableJumbotron'], $att); ?>

				</div> <!-- /form-group -->
              </div>
              <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true"><?php echo $this->lang->line('btn_back'); ?></button>
            <a class="btn btn-primary" onClick="formSubmit()"><?php echo $this->lang->line('btn_save'); ?></a>
              </div>
            </div>

          </div>
        </div>

        <div id="slider" class="modal fade" role="dialog">
          <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?php echo $this->lang->line('pages_slider_header'); ?></h4>
              </div>
              <div class="modal-body" id="pic_container">


               <div class="form-group">
                <?php echo form_error('enableSlider', '<div class="alert">', '</div>'); ?>

						<label class="control-label" for="enableJumbotron"><?php echo $this->lang->line('pages_slider_enable'); ?></label>
                        <?php
						$att = 'id="enableSlider" class="form-control"';
						$data = array(
						  '1'        => $this->lang->line('option_yes'),
						  '0'         => $this->lang->line('option_no'),
						);

						echo form_dropdown('enableSlider', $data, $p['enableSlider'], $att); ?>

				</div> <!-- /form-group -->

                <button onclick="addNewPic();" class="btn btn-primary" type="button"><?php echo $this->lang->line('pages_slider_add'); ?></button>
                <hr />
                <div class="slider">
               <?php $i=0;

                 foreach ($slides as $s) {
                  $i++;?>
                 <div class="control-group" id="pic_element<?php echo $i; ?>">
                    <label class="control-label">
                        <span><?php echo $this->lang->line('pages_slider_title'); ?></span>

                        <button id="delete<?php echo $i; ?>" class="close" type="button" onClick="removePrePic('<?php echo $i; ?>');">×</button>
                    </label>
                    <div class="controls">
                        <div><img src="<?php if ($s['slideImage'] != "") { echo BASE_URL.'/uploads/'.$s['slideImage']; } ?>" id="logo_preloaded<?php echo $i; ?>" <?php if ($s['slideImage'] == "") { echo "style='display:none;'"; } ?>></div>
                        <img src="<?php echo BASE_URL; ?>/theme/admin/images/ajax-loader.gif" style="margin:-7px 5px 0 5px;display:none;" id="loading_pic<?php echo $i; ?>" />
                        <?php
                            $data = array(
                                'name'		=> 'file_upload'.$i,
                                'id'		=> 'file_upload'.$i,
                                'class'		=> 'span5',
                            );
                            echo form_upload($data);
                        ?>
                        <p><?php echo $this->lang->line('pages_slider_alt'); ?></p>
                         <input class="form-control" type="text" id="alt<?php echo $i; ?>" name="alt<?php echo $i; ?>" <?php if ($s['slideAlt'] != "") { echo 'value="'.$s['slideAlt'].'"'; } else { echo  ''; } ?> />
                         <p><?php echo $this->lang->line('pages_slider_link'); ?></p>
                        <input class="form-control" type="text" id="link<?php echo $i; ?>" name="link<?php echo $i; ?>" <?php if ($s['slideLink'] != "") { echo 'value="'.$s['slideLink'].'"'; } else { echo  ''; } ?> />

                        <input type="hidden" id="slide<?php echo $i; ?>" name="slide<?php echo $i; ?>" value="<?php echo $s['slideImage']; ?>" />
                    </div> <!-- /controls -->
                </div> <!-- /control-group -->
                <?php
                     }

            ?>
            </div>
            <input type="hidden" id="pics" name="pics" value="" />


            </div><!-- /modal-body -->
              <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true"><?php echo $this->lang->line('btn_back'); ?></button>
            <a class="btn btn-primary" onClick="formSubmit()"><?php echo $this->lang->line('btn_save'); ?></a>
              </div>
            </div>

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
  	blockTypes: ["Columns", "Heading", "Text", "ImageExtended", "Accordion", "Button", "Video", "List", "Iframe"]
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
  	data_to_post = '';
  	for(i=1;i<=total_pics;i++)
  	{
  		if(document.getElementById('slide' + i))
  		{
  			slide = document.getElementById('slide' + i).value;
  			link = document.getElementById('link' + i).value;
  			alt = document.getElementById('alt' + i).value;
  			data_to_post += '{' + slide + '|' + link + '|' + alt + '}';
  		}
  	}

  	document.getElementById('pics').value = data_to_post;

  	SirTrevor.onBeforeSubmit();
  	document.getElementById("contentForm").submit();
  }
  });
}
</script>
<script type="text/javascript">
	function removePrePic(actual_pic)
	{
		return (elem=document.getElementById('pic_element' + actual_pic)).parentNode.removeChild(elem);
	}
	function removePic(id_in)
	{
		n = id_in.split('delete');
		actual_pic = n[1];
		return (elem=document.getElementById('pic_element' + actual_pic)).parentNode.removeChild(elem);
	}

	function addNewPic()
	{
		total_pics++;


		new_div = document.createElement('div');
		new_div.className = 'panel panel-default';
		new_div.id = 'pic_element' + total_pics;

		new_div_holder = document.createElement('div');
		new_div_holder.className = 'panel-body';
		new_div_holder.id = 'element' + total_pics;


		new_form_holder = document.createElement('div');
		new_form_holder.className = 'form-group';
		new_form_holder.id = 'pic' + total_pics;


		new_form_holder2 = document.createElement('div');
		new_form_holder2.className = 'form-group';
		new_form_holder2.id = 'pic2' + total_pics;

		new_form_holder3 = document.createElement('div');
		new_form_holder3.className = 'form-group';
		new_form_holder3.id = 'pic2' + total_pics;

		new_label = document.createElement('div');
		new_label.for = 'file_upload' + total_pics;
		new_label.className = 'panel-heading';

		new_span = document.createElement('span');
		new_span.innerHTML = '<?php echo $this->lang->line('pages_slider_title'); ?>';

		new_button = document.createElement('button');
		new_button.type = 'button';
		new_button.className = 'close';
		new_button.id = 'delete' + total_pics;
		new_button.innerHTML = '×';
		new_button.onclick = function(){ removePic(this.id); }

		new_label.appendChild(new_span);
		new_label.appendChild(new_button);

		new_div2 = document.createElement('div');
		new_div2.className = 'controls';

		new_div3 = document.createElement('div');

		new_img = document.createElement('img');
		new_img.id = 'logo_preloaded' + total_pics;
		new_img.style.display = 'none';

		new_div3.appendChild(new_img);

		new_img2 = document.createElement('img');
		new_img2.id = 'loading_pic' + total_pics;
		new_img2.src = '<?php echo BASE_URL; ?>/theme/admin/images/ajax-loader.gif';
		new_img2.style.margin = '-7px 5px 0 5px';
		new_img2.style.display = 'none';

		new_file = document.createElement('input');
		new_file.type = 'file';
		new_file.name = 'file_upload' + total_pics;
		new_file.id = 'file_upload' + total_pics;

		new_hidden = document.createElement('input');
		new_hidden.type = 'hidden';
		new_hidden.id = 'slide' + total_pics;
		new_hidden.name = 'slide' + total_pics;

		new_alt_span = document.createElement('label');
		new_alt_span.innerHTML = '<?php echo $this->lang->line('pages_slider_alt'); ?>';


		new_alt = document.createElement('input');
		new_alt.type = 'text';
		new_alt.id = 'alt' + total_pics;
		new_alt.name = 'alt' + total_pics;
		new_alt.className = 'form-control';

		new_link_span = document.createElement('label');
		new_link_span.innerHTML =  '<?php echo $this->lang->line('pages_slider_link'); ?>';

		new_link = document.createElement('input');
		new_link.type = 'text';
		new_link.id = 'link' + total_pics;
		new_link.name = 'link' + total_pics;
		new_link.className = 'form-control';

		new_form_holder.appendChild(new_alt_span);
		new_form_holder.appendChild(new_alt);

		new_form_holder2.appendChild(new_link_span);
		new_form_holder2.appendChild(new_link);


		new_form_holder3.appendChild(new_file);

		new_div2.appendChild(new_div3);
		new_div2.appendChild(new_img2);
		new_div2.appendChild(new_form_holder3);
		new_div2.appendChild(new_form_holder);
		new_div2.appendChild(new_form_holder2);
		new_div2.appendChild(new_hidden);

		new_div_holder.appendChild(new_div2);

		new_div.appendChild(new_label);
		new_div.appendChild(new_div_holder);

		document.getElementById('pic_container').appendChild(new_div);

		$('input[type=file]').on('change', prepareUpload);
	}

	function prepareUpload(event)
	{
		files = event.target.files;
		uploadFiles(event, this.id);
	}

	function uploadFiles(event, id_in)
	{
		event.stopPropagation();
		event.preventDefault();

		n = id_in.split('file_upload');
		actual_pic = n[1];

		$('#loading_pic' + actual_pic).show();

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
					$('#logo_preloaded' + actual_pic).show();
					document.getElementById('logo_preloaded' + actual_pic).src = '<?php echo BASE_URL; ?>/uploads/' + data;
					document.getElementById('slide' + actual_pic).value = data;
					$('#loading_pic' + actual_pic).hide();
				}
				else
				{
					alert('Error! The file is not an image.');
					$('#loading_pic' + actual_pic).hide();
				}
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

	var total_pics;
	total_pics = <?php echo $i; ?>;
</script>
<?php echo $footer; ?>
