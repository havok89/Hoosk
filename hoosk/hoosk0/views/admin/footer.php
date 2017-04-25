<div class="push"></div>
<input type="hidden" id="URLStore" value="">
</div>
<div class="footer">
  <div class="footer-inner">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12"> &copy; <?php echo date("Y"); ?> <a href="http://hoosk.org/">Hoosk CMS </a>. v1.7.0</div>
        <!-- /span12 -->
      </div>
      <!-- /row -->
    </div>
    <!-- /container -->
  </div>
  <!-- /footer-inner -->
</div>
<!-- /footer -->
<!-- remote modals -->
<div id="remote-modals">
    <div class="modal fade" id="ajaxModal" aria-labelledby="ajaxModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            </div> <!-- /.modal-content -->
        </div> <!-- /.modal-dialog -->
    </div> <!-- /.modal -->
</div>
<!-- Modal -->
<div id="loginModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"><?php echo $this->lang->line('login_signin'); ?></h4>
      </div>
      <div class="modal-body">
        <div class="alert alert-warning"><p><?php echo $this->lang->line('login_expired'); ?></p></div>
        <div id="loginError" class='alert alert-danger'><?php echo $this->lang->line('login_incorrect'); ?></div>

        <div class="form-group">
            <label for="username"><?php echo $this->lang->line('login_username'); ?></label>
<?php 	$data = array(
                      'name'        => 'username',
                      'id'          => 'username',
                      'class'       => 'form-control',
                      'value'		=> set_value('username'),
                      'placeholder'	=> $this->lang->line('login_username')
                    );

                    echo form_input($data); ?>
        </div>
        <div class="form-group">
            <label for="password"><?php echo $this->lang->line('login_password'); ?>:</label>
<?php 	$data = array(
                  'name'        => 'password',
                  'id'          => 'password',
                  'class'       => 'form-control',
                  'value'		=> set_value('password'),
                  'placeholder'	=> $this->lang->line('login_password')
                );

                echo form_password($data); ?>
        </div>
      </div>
      <div class="modal-footer">
        <a id="ajaxLoginbtn" class="btn btn-primary"><?php echo $this->lang->line('login_signin'); ?></a>
      </div>
    </div>
  </div>
</div>
</body>
</html>
