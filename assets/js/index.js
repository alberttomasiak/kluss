$(document).ready(function() {
	$('.form--button').on("click", function(e){
		var email = $("#email").val();

		$.ajax({
			url: "ajax/newsletterForm.php",
			type: "POST",
			data: {email: email},
			cache: false,
			success: function(status){
				console.log(status);
				if(status.email == "false"){
					$("#email").css("border-top", "3px solid red");
				}else{
					$("#email").css("border-top", "2px solid #FFFFFF");
				}

				if(status.status == "success"){
					$(".contactFeedback").html("Thanks for subscribing! You'll get a newsletter soon :)");
					$("#email").val("");
				}
			},
			error: function(request, status, error){
				console.log(error);
			}
		});
		e.preventDefault();
	});
});
