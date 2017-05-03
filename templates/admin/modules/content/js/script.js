$(document).ready(function(){
	$('input[name="re-password"]').on('focusout', function(){
		var a = $('#user_edit').find('input[name="password"]').val();
		var b = $(this).val();
		if(a!=b){
			$('#pass_error').html('<div class="alert alert-danger">'+
	  		'<strong>danger !</strong> password tidak cocok.'+
				'</div>');
		}else{
			$('#pass_error').html('');
		}
	});
	$('input[name="username"]').on('focusout', function(){
		var a = $(this).val();
		var b = $(this).siblings('input[name="id"]').val();
		$.ajax({
		  type: "GET",
		  url:  _url+"user/check_exist",
		  data: {
		  	"username": a,
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
	$('#selectAll').on('click',function() {
	  var checkedStatus = this.checked;
	  $('input[type="checkbox"]').each(function() {
	    $(this).prop('checked', checkedStatus);
	  });
	});
	$('input[type="text"]').focus();
});