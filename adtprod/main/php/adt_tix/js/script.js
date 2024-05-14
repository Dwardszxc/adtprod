$(document).ready(function(){
    function getQueryVariable(variable)
    {
        var query = window.location.search.substring(1);
        var vars = query.split("&");
        for (var i=0;i<vars.length;i++)
        {
          var pair = vars[i].split("=");
          if(pair[0] == variable)
            {
              return pair[1];
            }
        }
       return(false);
    }
    $('#submit_edit_tix').click(function(){
		var tix_num = $('#edit_tix_num').val();
		var adt_app_list = $('#edit_adt_app_list option:selected').val();
		var adt_task_list = $('#edit_adt_task_list option:selected').val();
		var tix_date = $('#edit_adt_tix_date').val();
		var adt_status_list = $('#edit_adt_status_list option:selected').val();
		if (tix_num != "" && adt_app_list != "" && adt_task_list !=  "" && tix_date != "" && adt_status_list != "")
		{
			$.ajax({
				url: "update_tix.php",
				dataType: "text",
				contentType: "application/x-www-form-urlencoded; charset=UTF-8;",
				cache: false,
				type: "POST",
				data:{
                    id: getQueryVariable("id"),
					tix_num: tix_num,
					adt_app_list: adt_app_list,
					adt_task_list: adt_task_list,
					tix_date: tix_date,
					adt_status_list: adt_status_list
				},
				success: function(data)
				{
					alert(data)
                    window.opener.location.reload(true);
                    window.close();
				},
				error: function(xhr, ajaxoption, thrownerror)
				{
					alert(xhr.status+" "+thrownerror);
				}
			});
		}
		else
		{
			alert('Please complete the following!')
		}
	});
});