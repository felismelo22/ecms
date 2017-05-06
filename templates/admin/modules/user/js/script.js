$(document).ready(function(){
	$('input[name="title"]').on('focusout', function(){
		var a = $(this).val();
		var b = $(this).siblings('input[name="id"]').val();
		$.ajax({
		  type: "GET",
		  url:  _url+"admin/content_category",
		  data: {
		  	"title": a,
		  	"id": b
		  },
		  dataType: "json",
		  beforeSend: function(i){

		  },
		  success: function(i){
	  		if(i.success==1){
		  		$('#user_error').html('<div class="alert alert-danger"><strong>danger !</strong> username sudah ada.</div>');
		  		$('#user_edit').on('submit',function(e){
		  			e.preventDefault();
		  		});
		  	}else{
		  		$('#user_error').html('');
		  		$('#user_edit').unbind('submit');
		  	}
		  },
		});
	});
	// $('#selectAllDel').on('click',function() {
	//   var checkedStatus = this.checked;
	//   $('input[class="del_check"]').each(function() {
	//     $(this).prop('checked', checkedStatus);
	//   });
	// });
	// $('#selectAllPub').on('click',function() {
	//   var checkedStatus = this.checked;
	//   $('input[class="pub_check"]').each(function() {
	//     $(this).prop('checked', checkedStatus);
	//   });
	// });
	// $('input[type="text"]').focus();
});