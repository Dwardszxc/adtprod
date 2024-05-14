<!--Panel for Productivity-->
<div role = 'tabpanel' class = 'tab-pane fade show container' id = 'div_prod' aria-labelledby = 'div_prod-tab'>
	<br>
	<form id = 'app_form'>
		<div class = 'form-row'>
			<div class = 'col-md-4'>
				<label for = 'prod_year'><span class = 'required-mark'>*</span>Year:</label>
				<select class = 'form-control' id = 'prod_year'>
					<option value = '2022'>2022</option>
					<option value = '2023'>2023</option>
					<option value = '2024'>2024</option>
					<option value = '2025'>2025</option>
					<option value = '2026'>2026</option>	
				</select>
			</div>
			<div class = 'col-md-4'>
				<label for = 'prod_month'><span class = 'required-mark'>*</span>Month:</label>
				<select class = 'form-control' id = 'prod_month'>
					<option value = '1'>January</option>
					<option value = '2'>February</option>
					<option value = '3'>March</option>
					<option value = '4'>April</option>
					<option value = '5'>May</option>
					<option value = '6'>June</option>
					<option value = '7'>July</option>
					<option value = '8'>August</option>
					<option value = '9'>September</option>
					<option value = '10'>October</option>
					<option value = '11'>November</option>
					<option value = '12'>December</option>
				</select>
			</div>
			<div class = 'col-md-4'>
				<label for = 'prod_member'><span class = 'required-mark'>*</span>Member:</label>
				<select class = 'form-control' id = 'prod_member'>
					
				</select>
			</div>
		</div>
		<br>
		<div class = 'col-md-4'>
			<div class = 'btn-group'>
        		<button id = 'prod_submit' type = 'button' class="btn btn-outline-primary btn-lg">Generate</button>
        		<button id = 'prod_clear' type = 'button' class="btn btn-outline-danger btn-lg">Clear</button>
        	</div>
		</div>
		<br>
		<table class="table table-striped table-bordered" id = 'prod_table' width="100%">
        	<thead>
        		<tr>
					<th style="width:10%;">Name</th>
					<th style="width:10%;">Total Tickets</th>
					<th style="width:10%;">Total Ticket Time</th>
					<th style="width:10%;">Total Tasks</th>
					<th style="width:10%;">Total Workload Time</th>
					<th style="width:10%;">Total Tasks (50%)</th>
					<th style="width:10%;">Entries Prod</th>
					<th style="width:10%;">Entries QOS</th>
        		</tr>
        	</thead>
        </table>
        <br>
        <table class="table table-striped table-bordered" id = 'prod_table2' width="100%">
        	<thead>
        		<tr>
					<th style="width:10%;">Name</th>
					<th style="width:10%;">Total Prod Time (50%)</th>
					<th style="width:10%;">Monthly Prod (Actual)</th>
					<th style="width:10%;">Total Productivity %</th>
					<th style="width:10%;">Prod QOS</th>
					<th style="width:10%;">QOS Grade</th>
					<th style="width:10%;">QOS</th>
        		</tr>
        	</thead>
        </table>
	</form>
	<br>	
</div>