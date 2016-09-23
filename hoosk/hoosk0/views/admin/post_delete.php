<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title"><?php echo $this->lang->line('posts_delete').": ".$form[0]['postTitle'] ?>?</h4>
</div>			<!-- /modal-header -->
<div class="modal-body">
        <div class="alert alert-danger" role="alert">
        	<strong>WARNING: </strong><p><?php echo $this->lang->line('posts_delete_message'); ?></p>
		</div>
</div>			<!-- /modal-body -->
<div class="modal-footer">
	<form ACTION="<?php echo BASE_URL.'/admin/posts/delete/'.$form[0]['postID']; ?>" method="POST" name="pageform" id="pageform">
        <input name="deleteid" type="hidden" id="deleteid" value="<?php echo $form[0]['postID'] ?>" />
        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $this->lang->line('btn_cancel'); ?></button>
        <input class="btn btn-danger" type="submit" value="<?php echo $this->lang->line('btn_delete'); ?>"/>
    </form> 
</div>			<!-- /modal-footer -->