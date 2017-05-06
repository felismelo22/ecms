$(document).ready(function(){
	function li_active(){
		var current = $('a[href="'+location.href+'"]').closest('li');
		current.addClass('active');
		if(current.parent('ul').length>0){
			current.closest('ul').closest('li').addClass('active');
		}
	}
	li_active();
	$('input[type="text"]').focus();
	// CKEDITOR.replace('textckeditor');
	$('#selectAllDel').on('click',function() {
	  var checkedStatus = this.checked;
	  $('input[class="del_check"]').each(function() {
	    $(this).prop('checked', checkedStatus);
	  });
	});
	$('#selectAllPub').on('click',function() {
	  var checkedStatus = this.checked;
	  $('input[class="pub_check"]').each(function() {
	    $(this).prop('checked', checkedStatus);
	  });
	});
});