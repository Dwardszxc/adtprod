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
		url: "get_wl_name.php",
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
					$('#edit_wl_app_list').append(o);
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
					var d = new Option(data[i].stat_name, data[i].stat_id);
					$(d).html(data[i].stat_name);
					$('#edit_wl_status').append(d);
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
        url: "get_wl_data.php",
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
                    $('#edit_wl_start').val(data[0].wl_tix_start);
                    $('#edit_wl_start').prop("disabled", false);
                    $('#edit_wl_end').val(data[0].wl_tix_end);
                    $('#edit_wl_end').prop("disabled", false);
                    $('#edit_wl_app_list').val(data[0].workload_id);
                    $('#edit_wl_app_list').prop("disabled", false);
                    $('#edit_wl_det').val(data[0].wl_tix_details);
                    $('#edit_wl_det').prop("disabled", false);
                    $('#edit_wl_status').val(data[0].status_id);
                    $('#edit_wl_status').prop("disabled", false);
                }
            }, 500);
        },
        error: function(xhr, ajaxoption, thrownerror)
        {
            console.log("Get Status Error: "+xhr.status+" "+thrownerror);
        }
    });

});