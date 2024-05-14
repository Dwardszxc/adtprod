$(document).ready(function(){
	function sort_applist() 
	{
		var lb = document.getElementById('app_list');
		arrTexts = new Array();
		for(i=0; i<lb.length; i++)
		{
  			arrTexts[i] = lb.options[i].text;
		}
		arrTexts.sort();
		for(i=0; i<lb.length; i++)
		{
  			lb.options[i].text = arrTexts[i];
  			lb.options[i].value = arrTexts[i];
		}
	}

	function sort_tasklist() 
	{
		var lb = document.getElementById('task_list');
		arrTexts = new Array();
		for(i=0; i<lb.length; i++)
		{
  			arrTexts[i] = lb.options[i].text;
		}
		arrTexts.sort();
		for(i=0; i<lb.length; i++)
		{
  			lb.options[i].text = arrTexts[i];
  			lb.options[i].value = arrTexts[i];
		}
	}

	function sort_statlist() 
	{
		var lb = document.getElementById('stat_list');
		arrTexts = new Array();
		for(i=0; i<lb.length; i++)
		{
  			arrTexts[i] = lb.options[i].text;
		}
		arrTexts.sort();
		for(i=0; i<lb.length; i++)
		{
  			lb.options[i].text = arrTexts[i];
  			lb.options[i].value = arrTexts[i];
		}
	}

	function sort_issuelist() 
	{
		var lb = document.getElementById('issue_list');
		arrTexts = new Array();
		for(i=0; i<lb.length; i++)
		{
  			arrTexts[i] = lb.options[i].text;
		}
		arrTexts.sort();
		for(i=0; i<lb.length; i++)
		{
  			lb.options[i].text = arrTexts[i];
  			lb.options[i].value = arrTexts[i];
		}
	}

	$('#put_app').click(function(){
		var app_name = $('#app_name').val();
		if (app_name == "")
		{
			alert("Blank application name is invalid!");
		}
		else
		{
			$.ajax({
				url: "php/applist/submit_appname.php",
				dataType: "text",
				contentType: "application/x-www-form-urlencoded; charset=UTF-8;",
				cache: false,
				type: "POST",
				data:{
					app_name: app_name
				},
				success: function(data)
				{
					var res = data.split("!");
					var o = new Option(app_name, res[1]);
					$(o).html(app_name);
					$('#app_list').append(o);
					$('#app_name').val("");
					sort_applist();
					alert(res[0]);
				},
				error: function(xhr, ajaxoption, thrownerror)
				{
					alert(xhr.status+" "+thrownerror);
				}
			})
		}
	});

	$('#put_task').click(function(){
		var task_name = $('#task_name').val();
		if (task_name == "")
		{
			alert("Blank task name is invalid!");
		}
		else
		{
			$.ajax({
				url: "php/tasklist/submit_taskname.php",
				dataType: "text",
				contentType: "application/x-www-form-urlencoded; charset=UTF-8;",
				cache: false,
				type: "POST",
				data:{
					task_name: task_name
				},
				success: function(data)
				{
					var res = data.split("!");
					var o = new Option(task_name, res[1]);
					$(o).html(task_name);
					$('#task_list').append(o);
					$('#task_name').val("");
					sort_tasklist();
					alert(res[0]);
				},
				error: function(xhr, ajaxoption, thrownerror)
				{
					alert(xhr.status+" "+thrownerror);
				}
			})
		}
	});

	$('#put_stat').click(function(){
		var stat_name = $('#stat_name').val();
		if (stat_name == "")
		{
			alert("Blank status name is invalid!");
		}
		else
		{
			$.ajax({
				url: "php/statuslist/submit_statname.php",
				dataType: "text",
				contentType: "application/x-www-form-urlencoded; charset=UTF-8;",
				cache: false,
				type: "POST",
				data:{
					stat_name: stat_name
				},
				success: function(data)
				{
					var res = data.split("!");
					var o = new Option(stat_name, res[1]);
					$(o).html(stat_name);
					$('#stat_list').append(o);
					$('#stat_name').val("");
					sort_statlist();
					alert(res[0]);
				},
				error: function(xhr, ajaxoption, thrownerror)
				{
					alert(xhr.status+" "+thrownerror);
				}
			})
		}
	});

	$('#put_issue').click(function(){
		var issue_name = $('#issue_name').val();
		if (issue_name == "")
		{
			alert("Blank issue name is invalid!");
		}
		else
		{
			$.ajax({
				url: "php/issuelist/submit_issuename.php",
				dataType: "text",
				contentType: "application/x-www-form-urlencoded; charset=UTF-8;",
				cache: false,
				type: "POST",
				data:{
					issue_name: issue_name
				},
				success: function(data)
				{
					var res = data.split("!");
					var o = new Option(issue_name, res[1]);
					$(o).html(issue_name);
					$('#issue_list').append(o);
					$('#issue_name').val("");
					sort_issuelist();
					alert(res[0]);
				},
				error: function(xhr, ajaxoption, thrownerror)
				{
					alert(xhr.status+" "+thrownerror);
				}
			})
		}
	});

	$('#remove_app').click(function(){
		var app_id = $('#app_list option:selected').val();
		var app_name = $('#app_list option:selected').text();
		if (app_name != "")
		{
			if (confirm("Are you sure you want to delete " + app_name + "? All related records to productivity will also be deleted.") && app_name != "")
			{
				$.ajax({
					url: "php/applist/delete_app.php",
					dataType: "text",
					contentType: "application/x-www-form-urlencoded; charset=UTF-8;",
					cache: false,
					type: "POST",
					data:{
						app_id: app_id,
						app_name: app_name
					},
					success: function(data)
					{
						alert(data)
						location.reload();
					},
					error: function(xhr, ajaxoption, thrownerror)
					{
						alert(xhr.status+" "+thrownerror);
					}
				});
			}
		}
		
	});

	$('#remove_task').click(function(){
		var task_id = $('#task_list option:selected').val();
		var task_name = $('#task_list option:selected').text();
		if (task_name != "")
		{
			if (confirm("Are you sure you want to delete " + task_name + "? All related records to productivity will also be deleted."))
			{
				$.ajax({
					url: "php/tasklist/delete_task.php",
					dataType: "text",
					contentType: "application/x-www-form-urlencoded; charset=UTF-8;",
					cache: false,
					type: "POST",
					data:{
						task_id: task_id,
						task_name: task_name
					},
					success: function(data)
					{
						alert(data)
						location.reload();
					},
					error: function(xhr, ajaxoption, thrownerror)
					{
						alert(xhr.status+" "+thrownerror);
					}
				});
			}
		}
		
	});

	$('#remove_stat').click(function(){
		var stat_id = $('#stat_list option:selected').val();
		var stat_name = $('#stat_list option:selected').text();
		if (stat_name != "")
		{
			if (confirm("Are you sure you want to delete " + stat_name + "? All related records to productivity will also be deleted."))
			{
				$.ajax({
					url: "php/statuslist/delete_stat.php",
					dataType: "text",
					contentType: "application/x-www-form-urlencoded; charset=UTF-8;",
					cache: false,
					type: "POST",
					data:{
						stat_id: stat_id,
						stat_name: stat_name
					},
					success: function(data)
					{
						alert(data)
						location.reload();
					},
					error: function(xhr, ajaxoption, thrownerror)
					{
						alert(xhr.status+" "+thrownerror);
					}
				});
			}
		}
		
	});

	$('#submit_ticket').click(function(){
		var tix_num = $('#tix_num').val();
		var itsm_app_list = $('#itsm_app_list option:selected').val();
		var itsm_issue_list = $('#itsm_issue_list option:selected').val();
		var itsm_inc_date = $('#itsm_inc_date').val();
		var itsm_sev_list = $('#itsm_sev_list option:selected').val();
		var itsm_prio_list = $('#itsm_prio_list option:selected').val();
		var itsm_status_list = $('#itsm_status_list option:selected').val();
		if (tix_num != "" && itsm_app_list != "" && itsm_issue_list !=  "" && itsm_inc_date != "" && itsm_sev_list != "" && itsm_prio_list != "" && itsm_prio_list != "")
		{
			$.ajax({
				url: "php/itsm/submit_ticket.php",
				dataType: "text",
				contentType: "application/x-www-form-urlencoded; charset=UTF-8;",
				cache: false,
				type: "POST",
				data:{
					tix_num: tix_num,
					itsm_app_list: itsm_app_list,
					itsm_issue_list: itsm_issue_list,
					itsm_inc_date: itsm_inc_date,
					itsm_sev_list: itsm_sev_list,
					itsm_prio_list: itsm_prio_list,
					itsm_status_list: itsm_status_list
				},
				success: function(data)
				{
					alert(data)
					location.reload();
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

	$('#submit_cap').click(function(){
		var cap_start = $('#cap_start').val();
		var cap_end = $('#cap_end').val();
		var cap_app_list = $('#cap_app_list option:selected').val();
		var cap_task_list = $('#cap_task_list option:selected').val();
		var cap_status_list = $('#cap_status_list option:selected').val();
		var cap_det = $('#cap_det').val();
		if (cap_start != "" && cap_end != "" && cap_app_list != "" && cap_task_list != "" && cap_status_list != "" && cap_det != "")
		{
			$.ajax({
				url: "php/cap/submit_cap.php",
				dataType: "text",
				contentType: "application/x-www-form-urlencoded; charset=UTF-8;",
				cache: false,
				type: "POST",
				data:{
					cap_start: cap_start,
					cap_end: cap_end,
					cap_app_list: cap_app_list,
					cap_task_list: cap_task_list,
					cap_status_list: cap_status_list,
					cap_det: cap_det
				},
				success: function(data)
				{
					alert(data)
					location.reload();
				},
				error: function(xhr, ajaxoption, thrownerror)
				{
					alert(xhr.status+" "+thrownerror);
				}
			});
		}
		else
		{
			alert('Please complete the following');
		}
	});
})