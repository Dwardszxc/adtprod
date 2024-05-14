<?php
    include('connection/conn.php');
    include('check_session.php');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="img/icon.png">
	<title>Ticket and CAP Tool</title>
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
    <script src="https://unpkg.com/gijgo@1.9.11/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.11/css/gijgo.min.css" rel="stylesheet" type="text/css" />
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
    <script src="js/script.js" type="text/javascript"></script>
    <script src="js/get.js" type="text/javascript"></script>
    <link href='css/style.css' rel='stylesheet'/>
</head>
<body>
	<br>
	<div class = 'container login'>
		<br>
		<nav class="navbar navbar-expand-lg navbar-dark nb">
			<a class="navbar-brand" href="javascript:void(0)" onclick="window.location.reload()"><span class="navbar-brand mb-0 h1">ITSM Ticket and RAP Tool - Prov Infra</span></a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        	</button>
        	<div class="collapse navbar-collapse" id="navbarSupportedContent">
        		<ul class="navbar-nav mr-auto">
        			<li class="nav-item dropdown">
        				<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            
                        <?php
                            echo $_SESSION['USER_NAME'];
                        ?>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="logout.php">Logout</a>
                        </div>
        			</li>
        		</ul>
        	</div>
		</nav>
		<br>
		<ul id="clothing-nav" class="nav nav-pills nav-fill nav-tabs" role="tablist">
			<?php
				if ($_SESSION['USER_ROLE'] == 'TC')
				{
					echo "<li class = 'nav-item'> \n";
						echo "<a class = 'nav-link active' href = '#div_app' role = 'tab' id = 'div_app-tab' data-toggle = 'tab' aria-controls = 'div_app'>Application List</a>";
					echo "</li>";
					echo "<li class = 'nav-item'> \n";
						echo "<a class = 'nav-link' href = '#div_task' role = 'tab' id = 'div_task-tab' data-toggle = 'tab' aria-controls = 'div_task'>Task List</a>";
					echo "</li> \n";
					echo "<li class = 'nav-item'> \n";
						echo "<a class = 'nav-link' href = '#div_stat' role = 'tab' id = 'div_stat-tab' data-toggle = 'tab' aria-controls = 'div_stat'>Status List</a>";
					echo "</li>";
					echo "<li class = 'nav-item'> \n";
						echo "<a class = 'nav-link' href = '#div_issue' role = 'tab' id = 'div_issue-tab' data-toggle = 'tab' aria-controls = 'div_issue'>Issue List</a>";
					echo "</li>";
					echo "<li class = 'nav-item'> \n";
						echo "<a class = 'nav-link' href = '#div_prod' role = 'tab' id = 'div_prod-tab' data-toggle = 'tab' aria-controls = 'div_prod'>Pull-up Productivity</a>";
					echo "</li>";

				}
				elseif ($_SESSION['USER_ROLE'] == "USER")
				{
					echo "<li class = 'nav-item'> \n";
						echo "<a class = 'nav-link active' href = '#div_itsm' role = 'tab' id = 'div_itsm-tab' data-toggle = 'tab' aria-controls = 'div_itsm'>ITSM Ticket</a>";
					echo "</li> \n";
					echo "<li class = 'nav-item'> \n";
						echo "<a class = 'nav-link' href = '#div_nuremedy' role = 'tab' id = 'div_nuremedy-tab' data-toggle = 'tab' aria-controls = 'div_nuremedy'>RAP (Release, Availability and Problem Management)</a>";
					echo "</li> \n";
				}
			?>
		</ul>
		<div id = 'clothing-nav-content' class = 'tab-content'>
			<?php
				if ($_SESSION['USER_ROLE'] == "TC")
				{
					include 'php/prod/index.php';
					include 'php/applist/index.php';
					include 'php/tasklist/index.php';
					include 'php/statuslist/index.php';
					include 'php/issuelist/index.php';
				}
				elseif ($_SESSION['USER_ROLE'] == "USER")
				{
					include 'php/itsm/index.php';
					include 'php/cap/index.php';
				}
			?>
		</div>
	</div>
</body>
</html>
<script type="text/javascript">
	$(document).ready(function(){
		$('#cap_start').datetimepicker({
			uiLibrary: 'bootstrap4',
			isRTL: true,
		    dateFormat: "yyyy-mm-dd",
		    timeFormat:  "hh:mm:ss"								
		});
		$('#cap_end').datetimepicker({
			uiLibrary: 'bootstrap4',
			isRTL: true,
		    dateFormat: "yyyy-mm-dd",
		    timeFormat:  "hh:mm:ss"
		});
		$('#itsm_inc_date').datepicker({
			uiLibrary: 'bootstrap4',
		    format: "yyyy-mm-dd"
		});
	})
</script>