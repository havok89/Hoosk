<?php echo $header; ?>

<div class="main">
  <div class="main-inner">
    <div class="container">
      <div class="row">
      <div class="span12">
          <div class="widget widget-table action-table">
            <div class="widget-header"> <i class="icon-edit"></i>
              <h3><?php echo $this->lang->line('cat_header'); ?></h3>
            </div>
            <!-- /widget-header -->
            <div class="widget-content">
                   
<table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th> <?php echo $this->lang->line('cat_table_category'); ?> </th>
                    <th class="td-actions"> </th>
                  </tr>
                </thead>
                <tbody>
                    <?php 
					foreach ($categories as $c) {
						echo '<tr>';
						echo '<td>'.$c['categoryTitle'].'</td>';
						echo '<td class="td-actions"><a href="/admin/posts/categories/edit/'.$c['categoryID'].'" class="btn btn-small btn-success"><i class="btn-icon-only icon-pencil"> </i></a><a data-toggle="modal" role="button" class="btn btn-danger btn-small" href="#dlt'.$c['categoryID'].'"><i class="btn-icon-only icon-remove"> </i></a></td>';
						echo '</tr>';
					} ?>
                </tbody>
              </table>
              <?php echo $this->pagination->create_links(); ?>
                <!-- /widget-content --> 
            <?php foreach ($categories as $c) {
			echo '<div id="dlt'.$c['categoryID'].'" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>';
            echo '<h3 id="myModalLabel">'.$this->lang->line('cat_delete').'"'.$c['categoryTitle'].'"?</h3>';
            echo '</div><div class="modal-body">';
            echo '<p>'.$this->lang->line('cat_delete_message').'</p>';
            echo '</div>';
            echo '<div class="modal-footer">';
            echo '<button class="btn" data-dismiss="modal" aria-hidden="true">'.$this->lang->line('btn_cancel').'</button>';
            echo '<a class="btn btn-danger" href="'.BASE_URL.'/admin/posts/categories/delete/'.$c['categoryID'].'">'.$this->lang->line('btn_delete').'</a>';
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
