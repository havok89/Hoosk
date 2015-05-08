<?php echo $header; ?>

<div class="main">
  <div class="main-inner">
    <div class="container">
      <div class="row">
      <div class="span12">
          <div class="widget widget-table action-table">
            <div class="widget-header"> <i class="icon-file"></i>
              <h3><?php echo $this->lang->line('pages_header'); ?></h3>
            </div>
            <!-- /widget-header -->
            <div class="widget-content">
                   
<table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th> <?php echo $this->lang->line('pages_table_page'); ?> </th>
                    <th> <?php echo $this->lang->line('pages_table_updated'); ?> </th>
                    <th> <?php echo $this->lang->line('pages_table_created'); ?> </th>
                    <th class="td-actions"> </th>
                  </tr>
                </thead>
                <tbody>
                    <?php 
					foreach ($pages as $p) {
						echo '<tr>';
						echo '<td>'.$p['navTitle'].'</td>';
						echo '<td>'.$p['pageUpdated'].'</td>';
						echo '<td>'.$p['pageCreated'].'</td>';
						echo '<td class="td-actions"><a href="/admin/pages/jumbo/'.$p['pageID'].'" class="btn btn-small btn-primary">'.$this->lang->line('btn_jumbotron').'</a><a href="/admin/pages/edit/'.$p['pageID'].'" class="btn btn-small btn-success"><i class="btn-icon-only icon-pencil"> </i></a><a data-toggle="modal" role="button" class="btn btn-danger btn-small" href="#dlt'.$p['pageID'].'"><i class="btn-icon-only icon-remove"> </i></a></td>';
						echo '</tr>';
					} ?>
                </tbody>
              </table>
              <?php echo $this->pagination->create_links(); ?>
                <!-- /widget-content --> 
            <?php foreach ($pages as $p) {
			echo '<div id="dlt'.$p['pageID'].'" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>';
            echo '<h3 id="myModalLabel">'.$this->lang->line('pages_delete').'"'.$p['navTitle'].'"?</h3>';
            echo '</div><div class="modal-body">';
			if ($p['pageID'] == "1") { echo '<p>'.$this->lang->line('pages_delete_home').'</p>'; } else {
            echo '<p>'.$this->lang->line('pages_delete_message').'</p>';
			}
            echo '</div>';
            echo '<div class="modal-footer">';
            echo '<button class="btn" data-dismiss="modal" aria-hidden="true">'.$this->lang->line('btn_cancel').'</button>';
			if ($p['pageID'] != "1") {
            echo '<a class="btn btn-danger" href="'.BASE_URL.'/admin/pages/delete/'.$p['pageID'].'">'.$this->lang->line('btn_delete').'</a>';
			}
            echo '</div></div>';
			} ?>
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
