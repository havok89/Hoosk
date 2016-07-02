<?php echo $header; ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                <?php echo $this->lang->line('pages_header'); ?>
            </h1>
            <ol class="breadcrumb">
                <li>
                <i class="fa fa-dashboard"></i>
                	<a href="/admin"><?php echo $this->lang->line('nav_dash'); ?></a>
                </li>
                <li class="active">
                <i class="fa fa-fw fa-file"></i>
                	<a href="/admin/pages"><?php echo $this->lang->line('nav_pages_all'); ?></a>
                </li>
            </ol>
        </div>
    </div>
</div>

<div class="container-fluid">
  	<div class="row">
      	<div class="col-md-12">
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
							echo '<td class="td-actions"><a href="/admin/pages/jumbo/'.$p['pageID'].'" class="btn btn-small btn-primary">'.$this->lang->line('btn_jumbotron').'</a> <a href="/admin/pages/edit/'.$p['pageID'].'" class="btn btn-small btn-success"><i class="fa fa-pencil"> </i></a> <a data-toggle="modal" data-target="#ajaxModal" class="btn btn-danger btn-small" href="'.BASE_URL.'/admin/pages/delete/'.$p['pageID'].'"><i class="fa fa-remove"> </i></a></td>';
						echo '</tr>';
					} ?>
                </tbody>
              </table>
              <?php echo $this->pagination->create_links(); ?>
     </div>
      <!-- /colmd12 -->
  </div>
  <!-- /row --> 
</div>
<!-- /container --> 
<?php echo $footer; ?>