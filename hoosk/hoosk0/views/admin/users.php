<?php echo $header; ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                <?php echo $this->lang->line('user_header'); ?>
            </h1>
            <ol class="breadcrumb">
                <li>
                <i class="fa fa-dashboard"></i>
                	<a href="<?php echo BASE_URL; ?>/admin"><?php echo $this->lang->line('nav_dash'); ?></a>
                </li>
                <li class="active">
                <i class="fa fa-fw fa-user"></i>
                	<a href="<?php echo BASE_URL; ?>/admin/users"><?php echo $this->lang->line('user_header'); ?></a>
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
						echo '<td class="td-actions"><a href="'.BASE_URL.'/admin/users/edit/'.$u['userID'].'" class="btn btn-small btn-success"><i class="fa fa-pencil"> </i></a> <a data-toggle="modal" data-target="#ajaxModal" class="btn btn-danger btn-small" href="'.BASE_URL.'/admin/users/delete/'.$u['userID'].'"><i class="fa fa-remove"> </i></a></td>';
						echo '</tr>';
					} ?>
                </tbody>
              </table>
              <?php echo $this->pagination->create_links(); ?>
        	</div>
      </div>
 </div>
<?php echo $footer; ?>
