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
    $('#submit_edit_wl').click(function(){
        var edit_wl_start = $('#edit_wl_start').val();
        var edit_wl_end = $('#edit_wl_end').val();
        var edit_wl_app_list = $('#edit_wl_app_list').val();
        var edit_wl_det = $('#edit_wl_det').val();
        var edit_wl_status = $('#edit_wl_status').val();
        if (edit_wl_start != "" && edit_wl_end != "" && edit_wl_app_list != "" && edit_wl_det != "" && edit_wl_status != "")
        {
            $.ajax({
				url: "update_wl.php",
				dataType: "text",
				contentType: "application/x-www-form-urlencoded; charset=UTF-8;",
				cache: false,
				type: "POST",
				data:{
                    id: getQueryVariable("id"),
					edit_wl_start: edit_wl_start,
					edit_wl_end: edit_wl_end,
					edit_wl_app_list: edit_wl_app_list,
					edit_wl_det: edit_wl_det,
					edit_wl_status: edit_wl_status
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
    });
});