$(document).ready(function(){
	function login()
	{
		var user = $('#username').val();
		var pass = $('#password').val();
		$.ajax({
			type: "POST",
			url: "php/verify.php",
			dataType: "text",
			contentType: "application/x-www-form-urlencoded; charset=UTF-8;",
			data: $('#login').serialize(),
			cache: false,
			success: function(data)
			{
				if (data == "1")
				{
					window.location.assign('main/');
				}
				else
				{
					alert(data);
				}
				// alert(data)
			},
			error: function(xhr, ajaxoption, thrownerror)
			{
				alert(xhr.status+" "+thrownerror);
			}
		});
	}
	$('#submit').click(function(){
		login();
	});
})