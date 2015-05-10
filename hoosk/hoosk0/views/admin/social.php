<?php echo $header; ?> 
<div class="main">
  <div class="main-inner">
    <div class="container">
      <div class="row">
      <div class="span4">
          <div class="widget">
            <div class="widget-header"> <i class="icon-share"></i>
              <h3><?php echo $this->lang->line('social_header'); ?></h3>
            </div>
            <!-- /widget-header -->
            <div class="widget-content">
            <?php echo $this->lang->line('social_message'); ?>
               
            </div> 
          </div>
          <!-- /widget -->
 
         
     </div>
      <!-- /span4 -->

	<div class="span8">
          <div class="widget">
            <div class="widget-header"> <i class="icon-share"></i>
              <h3><?php echo $this->lang->line('social_header'); ?></h3>
            </div>
            <!-- /widget-header -->
             <?php echo form_open(BASE_URL.'/admin/social/update'); ?>

            <div class="widget-content">
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
            <hr />
            
			
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
          <!-- /widget -->
 
         
     </div>
      </div>
      <!-- /row --> 
    </div>
    <!-- /container --> 
  </div>
  <!-- /main-inner --> 
</div>

<?php echo $footer; ?>
