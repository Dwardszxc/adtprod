$(document).ready(function(){

	var tbl_workload = $('#tbl_workload').DataTable({
         pageLength: 10,
         ordering: false,
         "language": {
         	"emptyTable": "No data found"
         },
         columnDefs: [
         	{
         		data: null,
         		defaultContent: "<div class='btn-group' role='group' aria-label='Basic outlined example'><button type='button' class='btn btn-outline-danger' id = 'del_wl'>Delete</button><button type='button' class='btn btn-outline-success' id = 'edit_wl'>Edit</button></div>",
         		targets: -1
         	}
         ]
    	});

	var table_adt = $('#table_adt').DataTable({
         pageLength: 10,
         ordering: false,
         "language": {
         	"emptyTable": "No data found"
         },
         columnDefs: [
			{
				data: null,
				defaultContent: "<div class='btn-group' role='group' aria-label='Basic outlined example'><button type='button' class='btn btn-outline-danger' id = 'del_adt'>Delete</button><button type='button' class='btn btn-outline-success' id = 'edit_adt'>Edit</button></div>",
				targets: -1
			}
         ]
    	});

	var tb_viewprod = $('#viewprod_table').DataTable({
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

	var tb_viewprod2 = $('#viewprod_table2').DataTable({
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

	var d = new Date();
	$('#prod_month').val(d.getMonth() + 1);
	$('#prod_year').val(d.getFullYear());
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
					var b = new Option(data[i].app_name, data[i].app_id);
					$(b).html(data[i].app_name);
					$('#adt_app_list').append(b);
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
		url: "php/wl_tix/get_wl_name.php",
		contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
		cache: false,
		dataType: "json",
		success: function(data)
		{
			if ($.isArray(data))
			{
				for (i = 0; i < data.length; i++)
				{
					var o = new Option(data[i].wl_name, data[i].wl_id);
					$(o).html(data[i].wl_name);
					$('#wl_app_list').append(o);
					var w = new Option(data[i].wl_name, data[i].wl_id);
					$(w).html(data[i].wl_name);
					$('#workload_list').append(w);
				}
			}
		},
		error: function(xhr, ajaxoption, thrownerror)
		{
			console.log("Get Workload list error:"+xhr.status+" "+thrownerror);
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
					var d = new Option(data[i].task_name, data[i].task_id);
					$(d).html(data[i].task_name);
					$('#adt_task_list').append(d);
					var x = new Option(data[i].task_name, data[i].task_id);
					$(x).html(data[i].task_name);
					$('#task_list').append(x);
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
					var x = new Option(data[i].stat_name, data[i].stat_id);
					$(x).html(data[i].stat_name);
					$('#adt_status_list').append(x);
					var d = new Option(data[i].stat_name, data[i].stat_id);
					$(d).html(data[i].stat_name);
					$('#wl_status').append(d);
					var t = new Option(data[i].stat_name, data[i].stat_id);
					$(t).html(data[i].stat_name);
					$('#stat_list').append(t);
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
		url: "php/prod/get_member.php",
		contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
		cache: false,
		dataType: "json",
		success: function(data)
		{
			if ($.isArray(data))
			{
				$('#prod_member').empty().append('<option value="All" selected>All</option>');
				for (i = 0; i < data.length; i++)
				{
					var o = new Option(data[i].emp_name, data[i].emp_id);
					$(o).html(data[i].emp_name);
					$('#prod_member').append(o);
				}
			}
		},
		error: function(xhr, ajaxoption, thrownerror)
		{
			console.log("Get Workload list error: "+xhr.status+" "+thrownerror);
		}
	});

	$.ajax({
		type: "GET",
		url: "php/wl_tix/get_wl_table.php",
		contentType: "application/x-www-form-urlencoded; charset=UTF-8;",
		cache: false,
		dataType: "json",
		success: function(data)
		{
			if ($.isArray(data))
			{
				for (i=0;i<data.length;i++)
				{
					tbl_workload.row.add([data[i].name, data[i].details, data[i].workload_name, data[i].stat_name, data[i].start, data[i].end]).node().id = data[i].tix_id
					tbl_workload.draw(false);
				}
			}
			else
			{
				alert("Unable to populate the table, please try again");
				console.log(data);
			}
		},
		error: function(xhr, ajaxoption, thrownerror)
		{
			console.log("Get CAP Table Error: "+xhr.status+" "+thrownerror);
		}
	});

	$.ajax({
		type: "GET",
		url: "php/adt_tix/get_adt_table.php",
		contentType: "application/x-www-form-urlencoded; charset=UTF-8;",
		cache: false,
		dataType: "json",
		success: function(data)
		{
			if ($.isArray(data))
			{
				for (i=0;i<data.length;i++)
				{
					table_adt.row.add([data[i].name, data[i].tix_num, data[i].app_name, data[i].task_name, data[i].status, data[i].date]).node().id = data[i].id;
					table_adt.draw(false);
				}
			}
			else
			{
				alert("Unable to populate the table, please try again");
				console.log(data);
			}
		},
		error: function(xhr, ajaxoption, thrownerror)
		{
			console.log("Get CAP Table Error: "+xhr.status+" "+thrownerror);
		}
	});

		tb_viewprod.clear().draw();
		tb_viewprod2.clear().draw();
		// $('#mod_getprod').modal('toggle');
		var month = d.getMonth() + 1
		var year = d.getFullYear()
		$.ajax({
			type: 'GET',
			url: "php/viewprod/getprod.php",
			contentType: "application/x-www-form-urlencoded; charset=UTF-8;",
			cache: false,
			dataType: "json",
			data: {
				month: month,
				year: year
			},
			success: function(data)
			{
				// $('#mod_getprod').modal('hide');
				$('#viewprod_table').show();
				$('#viewprod_table2').show();
				if ($.isArray(data))
				{
					for (i=0; i<data.length; i++)
					{
						tb_viewprod.row.add([
							data[i].name, 
							data[i].total_tix, 
							data[i].total_tix_mins, 
							data[i].total_workload, 
							data[i].total_workload_mins, 
							data[i].overall_tix, 
							data[i].entries_prod, 
							data[i].entries_qos]).node().id = data[i].id;
						tb_viewprod.draw(false);
						tb_viewprod2.row.add([
							data[i].name,
							data[i].total_prod_time,
							data[i].monthly_prod_actual,
							data[i].total_prod,
							data[i].prod_qos,
							data[i].qos_grade,
							data[i].qos]).node().id = data[i].id;
						tb_viewprod2.draw(false);
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