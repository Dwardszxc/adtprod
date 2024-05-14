<?php
    include('../../connection/conn.php');
    include('../../check_session.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADT Tool</title>
    <!-- Full Calendar -->
    <link href='https://unpkg.com/fullcalendar@3.10.0/dist/fullcalendar.min.css' rel='stylesheet' />
    <link href='https://unpkg.com/fullcalendar@3.10.0/dist/fullcalendar.print.css' rel='stylesheet' media='print' />
    <script src='https://unpkg.com/moment@2.24.0/min/moment.min.js'></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src='https://unpkg.com/fullcalendar@3.10.0/dist/fullcalendar.min.js'></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
    <script src="https://unpkg.com/tooltip.js@1.3.2/dist/umd/tooltip.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!---Datepicker-->  
    <script type="text/javascript" type="text/javascript" src = "../../js/bootstrap-datetimepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../../css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!----FOR DATA TABLE-->
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js" type="text/javascript"></script>
    <!----FOR DATA EXPORT-->
    <link href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js" type="text/javascript"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.bootstrap4.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js" type="text/javascript"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js" type="text/javascript"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js" type="text/javascript"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js" type="text/javascript"></script>
    <link href='../../css/style.css' rel='stylesheet'/>
</head>
<body>
    <br>
    <div class = 'container login'>
        <br>
        <nav class="navbar navbar-expand-lg navbar-dark nb">
			<a class="navbar-brand" href="javascript:void(0)" onclick="window.location.reload()"><span class="navbar-brand mb-0 h1">ADT Workload - Edit</span></a>
		</nav>
        <br>
        <form id="adt_form">
            <div class = 'form-row'>
                <div class = 'col-md-6'>
                    <label for = 'edit_wl_start'><span class="required-mark">*</span>Start date and time (EST):</label>
                    <input type="text" class = 'form-control' id = 'edit_wl_start' name="edit_wl_start" placeholder="YYYY-MM-DD HH:MM" disabled>
                </div>
                <div class = 'col-md-6'>
                    <label for = 'edit_wl_end'><span class="required-mark">*</span>Completion date and time (EST):</label>
                    <input type="text" class = 'form-control' id = 'edit_wl_end' name="edit_wl_end" placeholder="YYYY-MM-DD HH:MM" disabled>
                </div>
            </div>
            <br>
            <div class = 'form-row'>
                <div class = 'col-md-6'>
                    <label for = 'edit_wl_app_list'><span class="required-mark">*</span>Workload:</label>
                    <select class = 'form-control' id = 'edit_wl_app_list' name = 'edit_wl_app_list' disabled>
                    </select>
                </div>
                <div class = 'col-md-6'>
                    <label for = 'edit_wl_det'><span class="required-mark">*</span>Task details:</label>
                    <input type="text" class = 'form-control' id = 'edit_wl_det' name="edit_wl_det" disabled></input>
                </div>
            </div>
            <br>
            <div class = 'form-row'>
                <div class = 'col-md-6'>
                    <label for = 'edit_wl_status'><span class="required-mark">*</span>Status list:</label>
                    <select class = 'form-control' id = 'edit_wl_status' name = 'edit_wl_status' disabled>
                    </select>
                </div>
            </div>
            <br>
            <div class = 'form-row'>
                <button id = 'submit_edit_wl' type = 'button' class="btn btn-outline-primary btn-lg">Submit</button>
            </div>
        <br>
        </form>
    </div>
    
</body>
<script type="text/javascript" src="js/get.js"></script>
<script type="text/javascript" src="js/script.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$('#edit_wl_start').datetimepicker({
							
		});
		$('#edit_wl_end').datetimepicker({
			
		});
	})
</script>
</html>
