$(document).ready(function(){

	var tb_prod = $('#prod_table').DataTable({
		ordering: false,
		pageLength: 10,
		searching: false,
		bPaginate: false,
		bLengthChange: false,
		info: false,
		title: '',
		language: {
			"emptyTable":"No generated data yet"
		}
	});

	var tb_prod2 = $('#prod_table2').DataTable({
		ordering: false,
		pageLength: 10,
		searching: false,
		bPaginate: false,
		bLengthChange: false,
		info: false,
		title: '',
		language: {
			"emptyTable":"No generated data yet"
		}
	});

	var tb_gt = $('#gt_table').DataTable({
		ordering: false,
		pageLength: 10,
		searching: false,
		bPaginate: false,
		bLengthChange: false,
		info: false,
		title: '',
		language: {
			"emptyTable":"No generated data yet"
		}
	});

	$('#prod_table').hide();
	$('#prod_table2').hide();
	$('#gt_table').hide();
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
					alert(res[0]);
					location.reload();
				},
				error: function(xhr, ajaxoption, thrownerror)
				{
					alert(xhr.status+" "+thrownerror);
				}
			})
		}
	});

	$('#prod_submit').click(function(){
		tb_prod.clear().draw();
		tb_prod2.clear().draw();
		$('#mod_getprod').modal('toggle');
		var member = $('#prod_member option:selected').val();
		var month = $('#prod_month option:selected').val();
		var year = $('#prod_year option:selected').val();
		$.ajax({
			type: 'GET',
			url: "php/prod/get_prod.php",
			contentType: "application/x-www-form-urlencoded; charset=UTF-8;",
			cache: false,
			dataType: "json",
			data: {
				month: month,
				member: member,
				year: year
			},
			success: function(data)
			{
				$('#mod_getprod').modal('hide');
				$('#prod_table').show();
				$('#prod_table2').show();
				if ($.isArray(data))
				{
					for (i=0; i<data.length; i++)
					{
						tb_prod.row.add([
							data[i].name, 
							data[i].total_tix, 
							data[i].total_tix_mins, 
							data[i].total_workload, 
							data[i].total_workload_mins, 
							data[i].overall_tix, 
							data[i].entries_prod, 
							data[i].entries_qos]).node().id = data[i].id;
						tb_prod.draw(false);
						tb_prod2.row.add([
							data[i].name,
							data[i].total_prod_time,
							data[i].monthly_prod_actual,
							data[i].total_prod,
							data[i].prod_qos,
							data[i].qos_grade,
							data[i].qos]).node().id = data[i].id;
						tb_prod2.draw(false);
					}
				}
				console.log(data)
			},
			error: function(xhr, ajaxoption, thrownerror)
			{
				console.log(xhr.status+" "+thrownerror);
			}
		});
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
					alert(res[0]);
					location.reload();
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
					alert(res[0]);
					location.reload();
				},
				error: function(xhr, ajaxoption, thrownerror)
				{
					alert(xhr.status+" "+thrownerror);
				}
			})
		}
	});

	$('#put_workload').click(function(){
		var issue_name = $('#workload_name').val();
		if (issue_name == "")
		{
			alert("Blank workload name is invalid!");
		}
		else
		{
			$.ajax({
				url: "php/workloadlist/submit_workloadname.php",
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
					$('#workload_name').append(o);
					$('#workload_name').val("");
					alert(res[0]);
					location.reload();
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
		var adt_app_list = $('#adt_app_list option:selected').val();
		var adt_task_list = $('#adt_task_list option:selected').val();
		var tix_date = $('#adt_tix_date').val();
		var adt_status_list = $('#adt_status_list option:selected').val();
		if (tix_num != "" && adt_app_list != "" && adt_task_list !=  "" && tix_date != "" && adt_status_list != "")
		{
			$.ajax({
				url: "php/adt_tix/submit_ticket.php",
				dataType: "text",
				contentType: "application/x-www-form-urlencoded; charset=UTF-8;",
				cache: false,
				type: "POST",
				data:{
					tix_num: tix_num,
					adt_app_list: adt_app_list,
					adt_task_list: adt_task_list,
					tix_date: tix_date,
					adt_status_list: adt_status_list
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

	$('#submit_wl').click(function(){
		var wl_start = $('#wl_start').val();
		var wl_end = $('#wl_end').val();
		var wl_app_list = $('#wl_app_list option:selected').val();
		var wl_det = $('#wl_det').val();
		var wl_status = $('#wl_status option:selected').val();
		if (wl_start != "" && wl_end != "" && wl_app_list != "" && wl_det != "")
		{
			$.ajax({
				url: "php/wl_tix/submit_wl.php",
				dataType: "text",
				contentType: "application/x-www-form-urlencoded; charset=UTF-8;",
				cache: false,
				type: "POST",
				data:{
					wl_start: wl_start,
					wl_end: wl_end,
					wl_app_list: wl_app_list,
					wl_det: wl_det,
					wl_status: wl_status
				},
				success: function(data)
				{
					alert(data);
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

	$('#tbl_workload').on('click', 'button', function(){
		var id = $(this).closest('tr').attr('id');
		var wl_id = $(this).attr('id');
		if (wl_id == "del_wl")
		{
			if (confirm("Are you sure you want to delete this data?"))
			{
				$.ajax({
					url: "php/wl_tix/delete_wl.php",
					dataType: "text",
					contentType: "application/x-www-form-urlencoded; charset=UTF-8;",
					cache: false,
					type: "POST",
					data:{
						id: id
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
		else if (wl_id == "edit_wl")
		{
			url = "php/wl_tix/edit_wl.php?id="+id;
			window.open(url,'liveMatches','directories=no,titlebar=no,toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no,width=1000,height=500');
		}
	});

	$('#table_adt').on('click', 'button', function(){
		var id = $(this).closest('tr').attr('id');
		var adt_id = $(this).attr('id');
		if (adt_id == "del_adt")
		{
			if (confirm("Are you sure you want to delete this data?"))
				{
					$.ajax({
						url: "php/adt_tix/delete_tix.php",
						dataType: "text",
						contentType: "application/x-www-form-urlencoded; charset=UTF-8;",
						cache: false,
						type: "POST",
						data:{
							tix_id: id
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
		else if (adt_id == "edit_adt")
		{
			url = "php/adt_tix/edit_adt.php?id="+id;
			window.open(url,'liveMatches','directories=no,titlebar=no,toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no,width=1000,height=500');
		}
		
	});
});