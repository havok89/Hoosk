var sessionExist=1;

$( document ).ready(function() {
	setInterval(function() {
		if(sessionExist==1){
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
				}
			});
		}
	}, 60000);
});

$(document).on("click", "#ajaxLoginbtn", function(event){
	$.post("/admin/ajax/login", {
		username: $('#username').val(),
		password: $('#password').val()
	}).done(function(data) {
    if(data==1){
			$('#loginModal').modal('hide');
			sessionExist=1;
		} else {
			$('#loginError').show();
		}
  });
});

$(function () {
	$('.subnavbar').find ('li').each (function (i) {
		var mod = i % 3;
		if (mod === 2) {
			$(this).addClass ('subnavbar-open-right');
		}
	});
});

$('#remote-modals').on("hidden.bs.modal", ".modal:not(.local-modal)", function (e) {
	$(e.target).removeData("bs.modal").find(".modal-content").empty();
});

$(document).ready(function() {
$(".URLField").blur(function() {
	var identbefore=$(".URLField").val();
	var ident=identbefore.toLowerCase();
	ident=ident.replace(/ /g,'-');
	ident=ident.replace(/_/g,'-');
	ident=ident.replace(/[^\w-]+/g,'');
	$(".URLField").val(ident);
	if( identbefore.length >ident.length ) {
		alert("URL amended\nPlease use only a-z,0-9 or dash");
	}
});

});
var field;
function fancybox(elem) {
	field = $(elem).parent().prev();
	$.fancybox.open({
			width		: '900',
			height	: '600',
	    href: elem,
	    type: 'iframe'
	});
}

function responsive_filemanager_callback(field_id){
	var url=jQuery('#'+field_id).val();
	$(field).val(url);

}
$(function(){
	$('#searchString').on("keyup", function(e) {
		if (e.keyCode == 13) {
			$("#searchBtn").trigger("click");
		}
	});
});
function doPostSearch(){
	$('#postContainer').html("");
	$('#loadingSpinner').show();
	$.post("/admin/ajax/post-search", {
		term: $('#searchString').val(),
	}).done(function(data) {
		$('#loadingSpinner').hide();
		$('#postContainer').html(data);
		if($('#searchString').val()==""){
			$('#paginationContainer').show();
		} else {
			$('#paginationContainer').hide();
		}
  });
	
}
function doPageSearch(){
	$('#pageContainer').html("");
	$('#loadingSpinner').show();
	$.post("/admin/ajax/page-search", {
		term: $('#searchString').val(),
	}).done(function(data) {
		$('#loadingSpinner').hide();
		$('#pageContainer').html(data);
		if($('#searchString').val()==""){
			$('#paginationContainer').show();
		} else {
			$('#paginationContainer').hide();
		}  });
}


