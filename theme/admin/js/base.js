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
