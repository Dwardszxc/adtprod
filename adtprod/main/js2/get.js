$(document).ready(function(){
	$.ajax({
		type: "GET",
		url: "php/applist/get_appname.php",
		contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
		cache: false,
		dataType: "json",
		success: function(data)
		{
			if ($.isArray(data))
			{
				for (i = 0; i < data.length; i++)
				{
					var o = new Option(data[i].app_name, data[i].app_id);
					$(o).html(data[i].app_name);
					$('#app_list').append(o);
					var x = new Option(data[i].app_name, data[i].app_id);
					$(x).html(data[i].app_name);
					$('#itsm_app_list').append(x);
					var d = new Option(data[i].app_name, data[i].app_id);
					$(d).html(data[i].app_name);
					$('#cap_app_list').append(d);
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
		url: "php/tasklist/get_taskname.php",
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
					$('#task_list').append(o);
					$('#cap_task_list').append(o);
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
		url: "php/statuslist/get_statname.php",
		contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
		cache: false,
		dataType: "json",
		success: function(data)
		{
			if ($.isArray(data))
			{
				for (i = 0; i < data.length; i++)
				{
					var o = new Option(data[i].stat_name, data[i].stat_id);
					$(o).html(data[i].stat_name);
					$('#stat_list').append(o);
					var x = new Option(data[i].stat_name, data[i].stat_id);
					$(x).html(data[i].stat_name);
					$('#itsm_status_list').append(x);
					var d = new Option(data[i].stat_name, data[i].stat_id);
					$(d).html(data[i].stat_name);
					$('#cap_status_list').append(d);
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
		url: "php/issuelist/get_issuename.php",
		contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
		cache: false,
		dataType: "json",
		success: function(data)
		{
			if ($.isArray(data))
			{
				for (i = 0; i < data.length; i++)
				{
					var o = new Option(data[i].issue_name, data[i].issue_id);
					$(o).html(data[i].issue_name);
					$('#issue_list').append(o);
					var x = new Option(data[i].issue_name, data[i].issue_id);
					$(x).html(data[i].issue_name);
					$('#itsm_issue_list').append(x);
				}
			}
		},
		error: function(xhr, ajaxoption, thrownerror)
		{
			console.log("Get Issue list error: "+xhr.status+" "+thrownerror);
		}
	});
});