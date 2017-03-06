<?php echo $header; ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                <?php echo $this->lang->line('menu_new_nav'); ?>
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
                <li class="active">
                <i class="fa fa-fw fa-pencil"></i>
                	<?php echo $this->lang->line('menu_new_pages'); ?>
                </li>
            </ol>
        </div>
    </div>
</div>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-4">
           <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <i class="fa fa-pencil fa-fw"></i>
                    <?php echo $this->lang->line('menu_new_pages'); ?>
                </h3>
            </div>
            <div class="panel-body">
             <div class="form-group">

					<?php $attr = array('id' => 'navForm');
					echo form_open(BASE_URL.'admin/navigation/insert', $attr); ?>

            		<?php echo form_error('navSlug', '<div class="alert alert-danger">', '</div>'); ?>
					<label class="control-label" for="navSlug"><?php echo $this->lang->line('menu_new_nav_slug'); ?></label>
					<div class="controls">
                    <?php 	$data = array(
						  'name'        => 'navSlug',
						  'id'          => 'navSlug',
						  'class'       => 'form-control URLField',
						  'maxlength'		=> '10',
						  'value'		=> set_value('navSlug', '', FALSE)
						);

						echo form_input($data); ?>
					</div> <!-- /controls -->
				</div> <!-- /form-group -->

                 <div class="form-group">
            		<?php echo form_error('navTitle', '<div class="alert alert-danger">', '</div>'); ?>
					<label class="control-label" for="navTitle"><?php echo $this->lang->line('menu_new_nav_title'); ?></label>
					<div class="controls">
                    <?php 	$data = array(
						  'name'        => 'navTitle',
						  'id'          => 'navTitle',
						  'class'       => 'form-control',
						  'value'		=> set_value('navTitle', '', FALSE)
						);

						echo form_input($data); ?>
					</div> <!-- /controls -->
				</div> <!-- /form-group -->
              	<hr />
                <h3><?php echo $this->lang->line('menu_new_add_page'); ?></h3>
                <hr />
             <div class="form-group">
					<label class="control-label" for="pagesList"><?php echo $this->lang->line('menu_new_select_page'); ?></label>
					<div class="controls">

                       <?php $att = 'id="pagesList" class="form-control"';
				$data = array();
				foreach ($pages as $p){
				$data[$p['pageURL']] = $p['navTitle'];
				}
				echo form_dropdown('pagesList', $data, '1', $att); ?>

					</div> <!-- /controls -->
				</div> <!-- /form-group -->
      		<div class="form-group">
					<div class="controls">
           				<a class="btn btn-primary" onClick="addNav()"><?php echo $this->lang->line('btn_add'); ?></a>
      				</div> <!-- /controls -->
			</div> <!-- /form-group -->
            <hr />
            <div class="form-group">
					<label class="control-label" for="customlinkTitle"><?php echo $this->lang->line('menu_new_custom_title'); ?></label>
					<div class="controls">

                       <input type="text" id="customlinkTitle" value=""  class="form-control" />

					</div> <!-- /controls -->
				</div> <!-- /form-group -->
            <div class="form-group">
					<label class="control-label" for="customURLHREF"><?php echo $this->lang->line('menu_new_custom_link'); ?></label>
					<div class="controls">

                       <input type="text" id="customURLHREF" value="http://" class="form-control" />

					</div> <!-- /controls -->
				</div> <!-- /form-group -->
      		<div class="form-group">
					<div class="controls">
           				<a class="btn btn-primary" onClick="addCustomURL()"><?php echo $this->lang->line('btn_add'); ?></a>
      				</div> <!-- /controls -->
			</div> <!-- /form-group -->
            <hr />
            <h3><?php echo $this->lang->line('menu_new_drop_down'); ?></h3>
            <hr />
               <div class="form-group">
					<label class="control-label" for="parent"><?php echo $this->lang->line('menu_new_drop_title'); ?></label>
					<div class="controls">
                       <input type="text" id="parentTitle" value="" class="form-control" />
					</div> <!-- /controls -->
				</div> <!-- /form-group -->
                 <div class="form-group">
					<label class="control-label" for="parent"><?php echo $this->lang->line('menu_new_drop_link'); ?></label>
					<div class="controls">
                       <input type="text" id="parentSlug" value="" class="form-control URLField" />
					</div> <!-- /controls -->
				</div> <!-- /form-group -->
      		<div class="form-group">
					<div class="controls">
           				<a class="btn btn-primary" onClick="addDropDown()"><?php echo $this->lang->line('btn_add'); ?></a>
      				</div> <!-- /controls -->
			</div> <!-- /form-group -->
            </div>
          </div>
     </div>

	<div class="col-md-8">
         <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <?php echo $this->lang->line('menu_new_nav'); ?>
                </h3>
            </div>
            <div class="panel-body">
                <div class="dd" id="navHolder">
                    <ul class="dd-list list-group" id="mainNav">

                    </ul>
                </div>
            </div>
            <div class="panel-footer">
               <input type="hidden" id="seriaNav" name="seriaNav"/>
               <input type="hidden" name="convertedNav" id="convertedNav"/>
                <div class="controls">
                    <a class="btn btn-primary" onClick="serializeNav()"><?php echo $this->lang->line('btn_save'); ?></a>
                </div> <!-- /controls -->
                <?php echo form_close() ?>
            </div>

          </div>
		</div>
	</div>
	<!-- /row -->
</div>
<!-- /container -->
<script type="text/javascript">

function addNav(){
	var navHolder = document.getElementById("mainNav").innerHTML;
	var navSelected = $('#pagesList').val();
	$.ajax({
		  url: "<?php echo BASE_URL; ?>/admin/navadd/" + navSelected,
		  type: "POST",
		  success: function(html){
			var navContainer = $('#navContainer'); //jquery selector (get element by id)
              if(html){
				 document.getElementById("mainNav").innerHTML += html;
              }
		  },
		  error: function (html){
			alert('error');
		  }
		});

}

function addCustomURL(){
	var navHolder = document.getElementById("mainNav").innerHTML;
	var customlinkTitle = document.getElementById("customlinkTitle").value;
	var customURLHREF = document.getElementById("customURLHREF").value;
	if (customlinkTitle != ""){
	newLink = "<li class='dd-item' data-href='" + customURLHREF +"' data-title='" + customlinkTitle +"' data-type='1'><a class='right' onclick='var li = this.parentNode; var ul = li.parentNode; ul.removeChild(li);'><i class='fa fa-remove'></i></a><div class='dd-handle'>" + customlinkTitle +"</div></li>";
	document.getElementById("mainNav").innerHTML += newLink;
	}
}

function addDropDown(){
	var navHolder = document.getElementById("mainNav").innerHTML;
	var parentTitle = document.getElementById("parentTitle").value;
	var parentSlug = document.getElementById("parentSlug").value;
	var regexp = /^[a-zA-Z0-9-_]+$/;
	if (parentSlug.search(regexp) == -1)
    { alert('<?php echo $this->lang->line('menu_new_drop_error'); ?>'); }
	else
    {
	if (parentTitle != "" && parentSlug != ""){
	newLink = "<li class='dd-item parent' data-href='" + parentSlug + "' data-title='" + parentTitle +"'><a class='right' onclick='var li = this.parentNode; var ul = li.parentNode; ul.removeChild(li);'><i class='fa fa-remove'></i></a><div class='dd-handle'>" + parentTitle +" <b class='fa fa-caret-down'></b></div></li>";
	document.getElementById("mainNav").innerHTML += newLink;
	}}
}

 function updateOutput(e)
    {
        var list   = e.length ? e : $(e.target),
            output = list.data('output');
        if (window.JSON) {
            output.val(window.JSON.stringify(list.nestable('serialize')));//, null, 2));
        } else {
            output.val('JSON browser support required for this demo.');
        }
    };

$(document).ready(function()
{



    // activate Nestable for list 1
    $('.dd').nestable({
        group: 1,
		listNodeName:'ul',
		maxDepth: 2,
    })
    .on('change', updateOutput);
	 // output initial serialised data
    updateOutput($('.dd').data('output', $('#seriaNav')));
});

function serializeNav(){

  $.ajax({
    url: "/admin/check/session",
  }).done(function(data) {
    sessionExist = data;
    if(sessionExist==0){
      $('.modal').modal('hide');
      $('#loginModal').modal({
        backdrop: 'static',
        keyboard: false
      }).modal('show');
      } else {
      updateOutput($('.dd').data('output', $('#seriaNav')));
    	var jsn = JSON.parse(document.getElementById('seriaNav').value);
    	var parentHREF = '';
  	var parseJsonAsHTMLTree = function(jsn) {
      var result = '';

  jsn.forEach(function(item) {
        if (item.title && item.children) {
          result += '<li class="dropdown"><a href="#" data-toggle="dropdown" class="dropdown-toggle">' + item.title + '<b class="caret"></b></a><ul class="dropdown-menu">';
  		parentHREF = item.href;
          result += parseJsonAsHTMLTree(item.children);
  		parentHREF = "";
          result += '</ul></li>';
        } else {
  		  if (parentHREF == ""){
  			  	if (item.href != "home"){
  					if (item.type != "1"){
          				result += '<li><a href="/' + item.href + '">' + item.title + '</a></li>';
  					} else {
  			  			result += '<li><a href="' + item.href + '">' + item.title + '</a></li>';
  					}
  				} else {
  				result += '<li><a href="<?php echo BASE_URL; ?>">' + item.title + '</a></li>';
  				}
  		  } else {
  				if (item.type != "1"){
  			  	result += '<li><a href="/' + parentHREF + "/" + item.href + '">' + item.title + '</a></li>';
  				} else {
  			  	result += '<li><a href="' + item.href + '">' + item.title + '</a></li>';
  				}
  		  }
        }
      });

      return result + '';
    };

    var result = '<ul class="nav navbar-nav">' + parseJsonAsHTMLTree(jsn) + '</ul>';
    document.getElementById('convertedNav').value = result;
    document.getElementById('seriaNav').value = document.getElementById("mainNav").innerHTML;
    document.getElementById("navForm").submit();
  }
});
 }
</script>
<?php echo $footer; ?>
