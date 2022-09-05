$(document).ready(function(){
	$("#register-link").click(function(){
		$("#login-box").hide();
		$("#register-box").show();
	});

	$("#login-link").click(function(){
		$("#login-box").show();
		$("#register-box").hide();
	});

	$("#forgot-link").click(function(){
		$("#login-box").hide();
		$("#forgot-box").show();
	});

	$("#back-link").click(function(){
		$("#forgot-box").hide();
		$("#login-box").show();
	});

	//Register Ajax Request
	$("#register-btn").click(function(event){
		if ($("#register-form")[0].checkValidity()){
			event.preventDefault();
			$("#register-btn").val('Please Wait...');
			if ($("#rpassword").val() != $("#cpassword").val()){
				console.log("Not Matched");
			}
		}
	});
});