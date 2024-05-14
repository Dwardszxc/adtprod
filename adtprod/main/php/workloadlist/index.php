<!--Panel for Issue reported List-->
<div role = 'tabpanel' class = 'tab-pane fade show container' id = 'div_issue' aria-labelledby = 'div_issue-tab'>
	<br>
	<form id = 'app_form'>
		<div class = 'form-row'>
			<div class = 'col-md-6'>
				<label for = 'issue_name'><span class = 'required-mark'>*</span>Workload name:</label>
				<div class="input-group mb-3">
					<input type="text" id ='workload_name' class="form-control" placeholder="Enter workload name" aria-describedby="basic-addon2">
					<div class="input-group-append">
    					<button id = 'put_workload' class="btn btn-outline-primary" type="button">Put to list</button>
    					<button id = 'remove_workload' class="btn btn-outline-danger" type="button">Remove issue</button>
  					</div>
				</div>	
			</div>
		</div>
		<div class = 'form-row'>
			<div class = 'col-md-6'>
				<label for = 'workload_list'>Workload list</label>
				<select multiple class = 'form-control' id = 'workload_list'>
					
				</select>
			</div>
		</div>
		<br>
	</form>
</div>