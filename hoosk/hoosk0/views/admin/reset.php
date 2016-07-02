<?php echo $header; ?>
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-default">
                <div class="panel-heading">
                    <img src="<?php echo ADMIN_THEME; ?>/images/large_logo.png" class="login_logo" />
                </div>
                <div class="panel-body">
                    <h3><?php echo $this->lang->line('forgot_reset'); ?></h3>
                </div>
                <div class="panel-footer">
                    <a class="button btn btn-success" href="<?php echo BASE_URL; ?>/admin/login"><?php echo $this->lang->line('login_signin'); ?></a>
                </div>
            </div>
        </div>
    </div>
</div>