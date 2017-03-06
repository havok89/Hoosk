<?php echo $header; ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                <?php echo $this->lang->line('menu_header'); ?>
            </h1>
            <ol class="breadcrumb">
                <li>
                <i class="fa fa-dashboard"></i>
                	<a href="<?php echo BASE_URL; ?>/admin"><?php echo $this->lang->line('nav_dash'); ?></a>
                </li>
                <li class="active">
                <i class="fa fa-fw fa-list-alt"></i>
                	<a href="<?php echo BASE_URL; ?>/admin/navigation"><?php echo $this->lang->line('menu_header'); ?></a>
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
                    <th> <?php echo $this->lang->line('menu_table_title'); ?> </th>
                    <th class="td-actions"> </th>
                  </tr>
                </thead>
                <tbody>
                <?php foreach ($nav as $n):?>
						    <tr>
						      <td><?php echo $n['navTitle']?></td>
						      <td class="td-actions">
                    <a href="<?php echo BASE_URL; ?>/admin/navigation/edit/<?php echo $n['navSlug']?>" class="btn btn-small btn-success"><i class="fa fa-pencil"> </i></a>
                    <a data-toggle="modal" data-target="#ajaxModal" class="btn btn-danger btn-small" href="<?php echo BASE_URL.'/admin/navigation/delete/'.$n['navSlug']; ?>"><i class="fa fa-remove"> </i></a>
                  </td>
						    </tr>
					     <?php endforeach; ?>
                </tbody>
              </table>
              <?php echo $this->pagination->create_links(); ?>
		
        	</div>
      </div>         
 </div>
<?php echo $footer; ?>
