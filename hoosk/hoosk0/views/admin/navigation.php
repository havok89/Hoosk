<?php echo $header; ?>

<div class="main">
  <div class="main-inner">
    <div class="container">
      <div class="row">
      <div class="span12">
          <div class="widget widget-table action-table">
            <div class="widget-header"> <i class="icon-list"></i>
              <h3><?php echo $this->lang->line('menu_header'); ?></h3>
            </div>
            <!-- /widget-header -->
            <div class="widget-content">
                 
            <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th> <?php echo $this->lang->line('menu_table_title'); ?> </th>
                    <th class="td-actions"> </th>
                  </tr>
                </thead>
                <tbody>
                <?php foreach ($nav as $n):?>
						    <tr>
						      <td><?php echo $n['navTitle']?></td>
						      <td class="td-actions">
                    <a href="/admin/navigation/edit/<?php echo $n['navSlug']?>" class="btn btn-small btn-success"><i class="btn-icon-only icon-pencil"> </i></a>
                    <a data-toggle="modal" role="button" class="btn btn-danger btn-small" href="#dlt<?php echo $n['navSlug']?>"><i class="btn-icon-only icon-remove"> </i></a>
                  </td>
						    </tr>
					     <?php endforeach; ?>
                </tbody>
              </table>
              <?php echo $this->pagination->create_links(); ?>
                <!-- /widget-content --> 
            <?php foreach ($nav as $n) {
			echo '<div id="dlt'.$n['navSlug'].'" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>';
            echo '<h3 id="myModalLabel">'.$this->lang->line('menu_delete').'"'.$n['navTitle'].'"?</h3>';
            echo '</div><div class="modal-body">';
            if ($n['navSlug'] == "header") { echo '<p>'.$this->lang->line('menu_delete_message_header').'</p>'; } else {
            echo '<p>'.$this->lang->line('menu_delete_message').'</p>';
			}
			echo '</div>';
            echo '<div class="modal-footer">';
            echo '<button class="btn" data-dismiss="modal" aria-hidden="true">'.$this->lang->line('btn_cancel').'</button>';
			if ($n['navSlug'] != "header") {
			echo '<a class="btn btn-danger" href="'.BASE_URL.'/admin/navigation/delete/'.$n['navSlug'].'">'.$this->lang->line('btn_delete').'</a>';
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
