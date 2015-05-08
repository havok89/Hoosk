<?php echo $header; ?>

<div class="main">
  <div class="main-inner">
    <div class="container">
      <div class="row">
      <div class="span12">
          <div class="widget widget-table action-table">
            <div class="widget-header"> <i class="icon-user"></i>
              <h3><?php echo $this->lang->line('user_header'); ?></h3>
            </div>
            <!-- /widget-header -->
            <div class="widget-content">
                   
<table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th> <?php echo $this->lang->line('user_username'); ?> </th>
                    <th> <?php echo $this->lang->line('user_email'); ?> </th>
                    <th class="td-actions"> </th>
                  </tr>
                </thead>
                <tbody>
                    <?php 
					foreach ($users as $u) {
						echo '<tr>';
						echo '<td>'.$u['userName'].'</td>';
						echo '<td>'.$u['email'].'</td>';
						echo '<td class="td-actions"><a href="/admin/users/edit/'.$u['userID'].'" class="btn btn-small btn-success"><i class="btn-icon-only icon-pencil"> </i></a><a data-toggle="modal" role="button" class="btn btn-danger btn-small" href="#dlt'.$u['userID'].'"><i class="btn-icon-only icon-remove"> </i></a></td>';
						echo '</tr>';
					} ?>
                </tbody>
              </table>
              <?php echo $this->pagination->create_links(); ?>
                <!-- /widget-content --> 
            <?php foreach ($users as $u) {
			echo '<div id="dlt'.$u['userID'].'" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>';
            echo '<h3 id="myModalLabel">'.$this->lang->line('user_delete').'"'.$u['userName'].'"?</h3>';
            echo '</div><div class="modal-body">';
            echo '<p>'.$this->lang->line('user_delete_message').'</p></div>';
            echo '<div class="modal-footer">';
            echo '<button class="btn" data-dismiss="modal" aria-hidden="true">'.$this->lang->line('btn_cancel').'</button>';
            echo '<a class="btn btn-danger" href="'.BASE_URL.'/admin/users/delete/'.$u['userID'].'">'.$this->lang->line('btn_delete').'</a>';
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
