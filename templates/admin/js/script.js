$(document).ready(function(){
	function li_active(){
		var current = $('a[href="'+location.href+'"]').closest('li');
		current.addClass('active');
		if(current.parent('ul').length>0){
			current.closest('ul').closest('li').addClass('active');
		}
	}
	li_active();
	$();
});