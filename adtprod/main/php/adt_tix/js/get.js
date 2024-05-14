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
    $.ajax({
		type: "GET",
		url: "../../php/applist/get_appname.php",
		contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
		cache: false,
		dataType: "json",
		success: function(data)
		{
			if ($.isArray(data))
			{
				for (i = 0; i < data.length; i++)
				{
					var d = new Option(data[i].app_name, data[i].app_id);
					$(d).html(data[i].app_name);
					$('#edit_adt_app_list').append(d);
				}
			}
		},
		error: function(xhr, ajaxoption, thrownerror)
		{
			console.log("Get Application list error: "+xhr.status+" "+thrownerror);
		}
	});

    $.ajax({
		type: "GET",
		url: "../../php/tasklist/get_taskname.php",
		contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
		cache: false,
		dataType: "json",
		success: function(data)
		{
			if ($.isArray(data))
			{
				for (i = 0; i < data.length; i++)
				{
					var o = new Option(data[i].task_name, data[i].task_id);
					$(o).html(data[i].task_name);
					$('#edit_adt_task_list').append(o);
				}
			}
		},
		error: function(xhr, ajaxoption, thrownerror)
		{
			console.log("Get Task list error: "+xhr.status+" "+thrownerror);
		}
	});

    $.ajax({
		type: "GET",
		url: "../../php/statuslist/get_statname.php",
		contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
		cache: false,
		dataType: "json",
		success: function(data)
		{
			if ($.isArray(data))
			{
				for (i = 0; i < data.length; i++)
				{
					var x = new Option(data[i].stat_name, data[i].stat_id);
					$(x).html(data[i].stat_name);
					$('#edit_adt_status_list').append(x);
				}
			}
		},
		error: function(xhr, ajaxoption, thrownerror)
		{
			console.log("Get Status list error: "+xhr.status+" "+thrownerror);
		}
	});


    $.ajax({
        type: "GET",
        url: "get_tix_data.php",
        contentType: "application/x-www-form-urlencoded; charset=UTF-8",
        cache: false,
        dataType: 'json',
        data:{
            id: getQueryVariable("id")
        },
        success: function(data)
        {
            setTimeout(function(){
                if($.isArray(data))
                {
                    $('#edit_tix_num').val(data[0].tix_num);
                    $('#edit_tix_num').prop("disabled", false);
                    $('#edit_adt_app_list').val(data[0].application_id);
                    $('#edit_adt_app_list').prop("disabled", false);
                    $('#edit_adt_task_list').val(data[0].task_id);
                    $('#edit_adt_task_list').prop("disabled", false);
                    $('#edit_adt_tix_date').val(data[0].tix_date);
                    $('#edit_adt_tix_date').prop("disabled", false);
                    $('#edit_adt_status_list').val(data[0].status_id);
                    $('#edit_adt_status_list').prop("disabled", false);
                }
            }, 500);
        },
        error: function(xhr, ajaxoption, thrownerror)
        {
            console.log("Get Status Error: "+xhr.status+" "+thrownerror);
        }
    });
});