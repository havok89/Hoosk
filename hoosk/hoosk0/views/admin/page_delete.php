<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title"><?php echo $this->lang->line('pages_delete').": ".$form[0]['navTitle'] ?>?</h4>
</div>			<!-- /modal-header -->
<div class="modal-body">
        <div class="alert alert-danger" role="alert"><strong>WARNING: </strong><?php if ($form[0]['pageID'] == "1") { echo '<p>'.$this->lang->line('pages_delete_home').'</p>'; } else {
            echo '<p>'.$this->lang->line('pages_delete_message').'</p>';
			} ?></div>
</div>			<!-- /modal-body -->
<div class="modal-footer">
	<form ACTION="<?php echo BASE_URL.'/admin/pages/delete/'.$form[0]['pageID']; ?>" method="POST" name="pageform" id="pageform">
        <input name="deleteid" type="hidden" id="deleteid" value="<?php echo $form[0]['pageID'] ?>" />
        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $this->lang->line('btn_cancel'); ?></button>
        <?php if ($form[0]['pageID'] != "1") { ?>
            <input class="btn btn-danger" type="submit" value="<?php echo $this->lang->line('btn_delete'); ?>"/>
        <?php } ?>
    </form> 
</div>			<!-- /modal-footer -->