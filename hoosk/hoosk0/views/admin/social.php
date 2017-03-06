<?php echo $header; ?> 
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                <?php echo $this->lang->line('social_header'); ?>
            </h1>
            <ol class="breadcrumb">
                <li>
                <i class="fa fa-dashboard"></i>
                	<a href="<?php echo BASE_URL; ?>/admin"><?php echo $this->lang->line('nav_dash'); ?></a>
                </li>
                <li class="active">
                <i class="fa fa-fw fa-share-alt"></i>
                	<a href="<?php echo BASE_URL; ?>/admin/social"><?php echo $this->lang->line('social_header'); ?></a>
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
                    <i class="fa fa-share-alt fa-fw"></i>
                    <?php echo $this->lang->line('social_header'); ?>
                </h3>
            </div>
         	<div class="panel-body">
            	<?php echo $this->lang->line('social_message'); ?>
            </div> 
          </div>
          <div class="panel panel-default">
			<div class="panel-heading">
                <h3 class="panel-title">
                    <i class="fa fa-share-alt fa-fw"></i>
                    <?php echo $this->lang->line('social_header'); ?>
                </h3>
               </div>
         	<div class="panel-body">
             <?php echo form_open(BASE_URL.'/admin/social/update'); ?>
            <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th> <?php echo $this->lang->line('social_table_title'); ?> </th>
                    <th> <?php echo $this->lang->line('social_table_link'); ?> </th>
                    <th> <?php echo $this->lang->line('social_table_enabled'); ?> </th>
                  </tr>
                </thead>
                <tbody>
            <?php foreach ($social as $s){ ?>
			<tr>
            	<td><?php echo $this->lang->line('social_'.$s['socialName']); ?></td>
                <td><?php 	$data = array(
						  'name'        => $s['socialName'],
						  'id'          => $s['socialName'],
						  'class'       => 'form-control ',
						  'value'		=> set_value($s['socialName'], $s['socialLink'], FALSE)
						);
			
						echo form_input($data); ?></td>
                <td><input type="checkbox" value="1" name="checkbox<?php echo $s['socialName']; ?>" <?php if ($s['socialEnabled']==1){ echo " checked ";} ?>></td>
			</tr>
           
            
            <?php } ?>
            
            </tbody>
            </table>
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
			 	?>
             </div>
            </div> 
          </div>
     </div>
 </div>
<?php echo $footer; ?>